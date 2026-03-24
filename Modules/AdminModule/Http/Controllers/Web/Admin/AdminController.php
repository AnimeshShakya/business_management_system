<?php

namespace Modules\AdminModule\Http\Controllers\Web\Admin;

use App\Traits\UploadSizeHelperTrait;
use Carbon\Carbon;
use Modules\AdminModule\Traits\AdminMenuWithRoutes;
use function auth;
use function view;
use function bcrypt;
use function response;
use function file_uploader;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function response_formatter;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Modules\UserManagement\Entities\User;
use Modules\BookingModule\Entities\Booking;
use Illuminate\Contracts\Support\Renderable;
use Modules\AdminModule\Services\AdvanceSearch;
use Modules\ServiceManagement\Entities\Service;
use Modules\TransactionModule\Entities\Account;
use Illuminate\Contracts\Foundation\Application;
use Modules\ChattingModule\Entities\ChannelList;
use Modules\ProviderManagement\Entities\Provider;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\TransactionModule\Entities\Transaction;
use Modules\AdminModule\Entities\RouteSearchHistory;
use Modules\BookingModule\Entities\BookingDetailsAmount;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AdminController extends Controller
{
    use AdminMenuWithRoutes;
    protected Provider $provider;
    protected Account $account;
    protected Booking $booking;
    protected Service $service;
    protected User $user;
    protected Transaction $transaction;
    protected ChannelList $channelList;
    protected BookingDetailsAmount $booking_details_amount;
    protected $advanceSearchService;
    use AuthorizesRequests;
    use UploadSizeHelperTrait;
    public function __construct(ChannelList $channelList, Provider $provider, Service $service, Account $account, Booking $booking, User $user, Transaction $transaction, BookingDetailsAmount $booking_details_amount, AdvanceSearch $advanceSearchService)
    {
        $this->provider = $provider;
        $this->service = $service;
        $this->account = $account;
        $this->booking = $booking;
        $this->user = $user;
        $this->transaction = $transaction;
        $this->channelList = $channelList;
        $this->booking_details_amount = $booking_details_amount;
        $this->advanceSearchService = $advanceSearchService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Transaction $transaction
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function dashboard(Request $request, Transaction $transaction): View|Factory|Application
    {
        $baseQuery = BookingDetailsAmount::whereHas('booking', function ($query) use ($request) {
            $query->ofBookingStatus('completed');
        })->orWhereHas('repeat', function ($subQuery) {
            $subQuery->ofBookingStatus('completed');
        });
        //->sum('admin_commission');
        $admin_commission = $baseQuery->sum('admin_commission');
        $discount_by_admin = $baseQuery->sum('discount_by_admin');
        $coupon_discount_by_admin = $baseQuery->sum('coupon_discount_by_admin');
        $campaign_discount_by_admin = $baseQuery->sum('campaign_discount_by_admin');

        $commission_earning = $admin_commission - $discount_by_admin - $coupon_discount_by_admin - $campaign_discount_by_admin;

        $fee_amounts = $this->transaction->where('trx_type', TRX_TYPE['received_extra_fee'])->sum('credit');
        $subscription_amounts = $this->transaction->whereIn('trx_type', ['subscription_purchase', 'subscription_renew', 'subscription_shift'])->sum('credit');

        $data = [];
        $data[] = ['top_cards' => [
            'total_commission_earning' => $commission_earning ?? 0,
            'total_fee_earning' => $fee_amounts ?? 0,
            'total_subscription_earning' => $subscription_amounts ?? 0,
            'total_system_earning' => $this->account->sum('received_balance') + $this->account->sum('total_withdrawn'),
            'total_customer' => $this->user->where(['user_type' => 'customer'])->count(),
            'total_provider' => $this->provider->where(['is_approved' => 1])->count(),
            'total_services' => $this->service->count()
        ]];

        $total_earning = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request) {
                $query->ofBookingStatus('completed');
            })->orWhereHas('repeat', function ($subQuery) {
                $subQuery->ofBookingStatus('completed');
            })->get()->sum('admin_commission');

        $data[] = ['admin_total_earning' => $total_earning];

        $recent_transactions = $this->transaction
            ->with(['booking'])
            ->whereMonth('created_at', now()->month)
            ->latest()
            ->take(5)
            ->get();
        $data[] = [
            'recent_transactions' => $recent_transactions,
            'this_month_trx_count' => $transaction
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count()
        ];

        $bookings = $this->booking->with(['detail.service' => function ($query) {
            $query->select('id', 'name', 'thumbnail');
        }])
            ->where('booking_status', 'pending')
            ->take(5)->latest()->get();
        $data[] = ['bookings' => $bookings];

        $top_providers = $this->provider
            ->withCount(['reviews'])
            ->with(['owner', 'reviews'])
            ->ofApproval(1)
            ->take(5)->orderBy('avg_rating', 'DESC')->get();
        $data[] = ['top_providers' => $top_providers];

        $zone_wise_bookings = $this->booking
            ->with(['zone' => function ($query) {
                $query->withoutGlobalScope('translate');
            }])
            ->whereHas('zone', function ($query) {
                $query->ofStatus(1)->withoutGlobalScope('translate');
            })
            ->whereMonth('created_at', now()->month)
            ->select('zone_id', DB::raw('count(*) as total'))
            ->groupBy('zone_id')
            ->get();
        $data[] = ['zone_wise_bookings' => $zone_wise_bookings, 'total_count' => $this->booking->count()];

        $year = session()->has('dashboard_earning_graph_year') ? session('dashboard_earning_graph_year') : date('Y');
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request, $year) {
                $query->whereYear('created_at', '=', $year)->ofBookingStatus('completed');
            })->orWhereHas('repeat', function ($subQuery) {
                $subQuery->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(admin_commission) as admin_commission'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $fee_amounts = $this->transaction
            ->whereIn('trx_type', [
                TRX_TYPE['received_extra_fee'],
                TRX_TYPE['subscription_purchase'],
                TRX_TYPE['subscription_renew'],
                TRX_TYPE['subscription_shift']
            ])
            ->select(
                DB::raw('sum(credit) as fee'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $all_earnings = [];
        if (empty($amounts) && !empty($fee_amounts)) {
            foreach ($fee_amounts as $key => $fee) {
                $all_earnings[$key] = $fee;
                if (!array_key_exists('fee', $all_earnings[$key])) {
                    $all_earnings[$key]['fee'] = 0;
                }
            }
        } else {
            foreach ($amounts as $amount) {
                foreach ($fee_amounts as $key => $fee) {
                    if ($amount['month'] == $fee['month']) {
                        $all_earnings[$key] = array_merge($amount, $fee);
                    }
                    if (!isset($all_earnings[$key])) {
                        $all_earnings[$key] = $amount;
                    }
                    if (!array_key_exists('fee', $all_earnings[$key])) {
                        $all_earnings[$key]['fee'] = 0;
                    }
                }
            }
        }

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($all_earnings as $key => $item) {
                if (isset($item['month']) && $item['month'] == $month) {
                    $admin_commission = $item['admin_commission'] ?? 0;
                    $itemFee = $item['fee'] ?? 0;

                    $chart_data['total_earning'][] = with_decimal_point($admin_commission + $itemFee);
                    $chart_data['commission_earning'][] = with_decimal_point($admin_commission);
                    $found = 1;
                    break;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
                $chart_data['commission_earning'][] = with_decimal_point(0);
            }
        }

        return view('adminmodule::dashboard', compact('data', 'chart_data'));
    }


    public function component()
    {
        return view("adminmodule::component");
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function updateDashboardEarningGraph(Request $request): JsonResponse
    {
        $year = $request['year'];
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request, $year) {
                $query->whereYear('created_at', '=', $year)->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(admin_commission) as admin_commission'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $fee_amounts = $this->transaction
            ->whereYear('created_at', '=', $year)
            ->whereIn('trx_type', [
                TRX_TYPE['received_extra_fee'],
                TRX_TYPE['subscription_purchase'],
                TRX_TYPE['subscription_renew'],
                TRX_TYPE['subscription_shift']
            ])
            ->select(
                DB::raw('sum(credit) as fee'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $all_earnings = [];
        foreach ($amounts as $amount) {
            foreach ($fee_amounts as $key => $fee) {
                if ($amount['month'] == $fee['month']) {
                    $all_earnings[$key] = array_merge($amount, $fee);
                }
                if (!isset($all_earnings[$key])) {
                    $all_earnings[$key] = $amount;
                }
                if (!array_key_exists('fee', $all_earnings[$key])) {
                    $all_earnings[$key]['fee'] = 0;
                }
            }
        }

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($all_earnings as $key => $item) {
                if ($item['month'] == $month) {
                    $chart_data['total_earning'][] = with_decimal_point($item['admin_commission'] + $item['fee']);
                    $chart_data['commission_earning'][] = with_decimal_point($item['admin_commission']);
                    $found = 1;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
                $chart_data['commission_earning'][] = with_decimal_point(0);
            }
        }

        session()->put('dashboard_earning_graph_year', $request['year']);

        return response()->json($chart_data);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if (in_array($request->user()->user_type, ADMIN_USER_TYPES)) {
            $user = $this->user->where(['id' => auth('api')->id()])->with(['roles'])->first();
            return response()->json(response_formatter(DEFAULT_200, $user), 200);
        }
        return response()->json(response_formatter(DEFAULT_403), 401);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(Request $request): JsonResponse
    {
        if (in_array($request->user()->user_type, ADMIN_USER_TYPES)) {
            return response()->json(response_formatter(DEFAULT_200, auth('api')->user()), 200);
        }
        return response()->json(response_formatter(DEFAULT_403), 401);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function profileInfo(Request $request): Renderable
    {
        return view('adminmodule::admin.profile-update');
    }

    /**
     * Modify provider information
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $check = $this->validateUploadedFile($request, ['profile_image']);
        if ($check !== true) {
            return $check;
        }

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'profile_image' => 'image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
            'password' => '',
            'confirm_password' => !is_null($request->password) ? 'required|same:password' : '',
        ]);

        $user = $this->user->find($request->user()->id);
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->last_name = $request->last_name;
        if ($request->has('profile_image')) {
            $user->profile_image = file_uploader('user/profile_image/', APPLICATION_IMAGE_FORMAT, $request->profile_image, $user->profile_image);
        }
        if (!is_null($request->password)) {
            $user->password = bcrypt($request->confirm_password);
        }
        $user->save();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function getUpdatedData(Request $request): JsonResponse
    {
        $message = $this->channelList->wherehas('channelUsers', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id)->where('is_read', 0);
        })->count();

        return response()->json([
            'status' => 1,
            'data' => [
                'message' => $message
            ]
        ]);
    }

    private function routeFullUrl($uri)
    {
        $fullURL = url($uri);
        if ($uri == 'admin/booking/list/verification') {
            $fullURL = url($uri) . '?booking_status=pending&type=pending';
        }
        if ($uri == 'admin/booking/list') {
            $fullURL = url($uri) . '?booking_status=pending';
        }
        if ($uri == 'admin/configuration/get-notification-setting') {
            $fullURL = url($uri) . '?type=customers';
        }
        if ($uri == 'admin/customer/settings') {
            $fullURL = url($uri) . '?web_page=loyalty_point';
        }
        if ($uri == 'admin/chat/index') {
            $fullURL = url($uri) . '?user_type=customer';
        }
        return $fullURL;
    }

    public function searchRouting(Request $request)
    {
        $searchKeyword = $request->input('search');
       $formattedRoutes = $this->advanceSearchService->pageSearchList($searchKeyword,"admin");
        $menuSearchResults = [];
        if (!empty($searchKeyword)) {
            $menuSearchResults = $this->advanceSearchService->searchMenuList($searchKeyword,"admin");
        }
        $modelSearchResults = $this->advanceSearchService->searchModelList($searchKeyword,"admin");
        $allRoutes = $this->advanceSearchService->sortByPriority($formattedRoutes, $modelSearchResults, $menuSearchResults, $searchKeyword);
        return response()->json([
            'keyword' => $searchKeyword,
            'result' => $allRoutes,
            'htmlView' => view('adminmodule::admin._advance_search', [
                'result' => $allRoutes,
                'keyword' => $searchKeyword,
                'recent' => false,
            ])->render()
        ]);
    }

    /**
     * @return array{routeName: string, URI: array|string|string[], fullRoute: string}
     */
    private function filterRoute($model, $route, $type = null, $name = null, $prefix = null): array
    {
        $uri = $route->uri();
        $routeName = $route->getName();
        $formattedRouteName = ucwords(str_replace(['.', '_'], ' ', Str::afterLast($routeName, '.')));
        $uriWithParameter = str_replace('{id}', $model->id, $uri);
        $fullURL = url('/') . '/' . $uriWithParameter;
        if ($type == 'booking') {
            $fullURL = url('/') . '/' . $uriWithParameter . '?web_page=details';
        }
        if ($type == 'customer') {
            $fullURL = $formattedRouteName == 'Detail' ? $fullURL . '?web_page=overview' : $fullURL;
        }
        if ($type == 'provider') {
            $fullURL = $formattedRouteName == 'Details' ? $fullURL . '?web_page=overview' : $fullURL;
        }

        $routeName = $prefix ? $prefix . ' ' . $formattedRouteName : $formattedRouteName;
        $routeName = $name ? $routeName . ' - (' . $name . ')' : $routeName;

        return [
            'page_title' => $routeName ?? '',
            'page_title_value' => $routeName ?? '',
            'key' => base64_encode($uri),
            'uri' => $uriWithParameter ?? '',
            'full_route' => $fullURL ?? '',
            'type' => $model->getTable(),
            'priority' => 3,
        ];

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeClickedRoute(Request $request): RedirectResponse
    {
        $userId = auth()->id();
        $userType = auth()->user()->user_type;
        $response = $request['response'];

        if (is_string($response)) {
            $response = json_decode($response, true);
        }
        $clickedRoute = RouteSearchHistory::updateOrCreate(
            [
                'user_id' => $userId,
                'user_type' => $userType,
                'route_uri' => $request['uri'],
            ],
            [
                'route_name' => $request['page_title_value'],
                'route_uri' =>  $request['uri'],
                'route_full_url' => $request['route_full_url'],
                'keyword' =>  $request['keyword'],
                'response' => $response,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $clickedRoute->touch();

        $userClickCount = RouteSearchHistory::where('user_id', $userId)->where('user_type', $userType)->count();

        if ($userClickCount >= 15) {
            RouteSearchHistory::where('user_id', $userId)->where('user_type', $userType)->orderBy('created_at', 'asc')->first()->delete();
        }

        $redirectUrl = $request['route_full_url'];
        $separator = (parse_url($redirectUrl, PHP_URL_QUERY) ? '&' : '?');
        $redirectUrl .= $separator . 'keyword=' . urlencode($request['keyword']);
        return redirect($redirectUrl);

    }



    public function recentSearch(): JsonResponse
    {
        $userId = auth()->id();
        $userType = auth()->user()->user_type;
        $recentSearches = RouteSearchHistory::where('user_id', $userId)
            ->where('user_type', $userType)
            ->orderBy('updated_at', 'desc')
            ->limit(15)
            ->get();
        $formattedResult = collect($recentSearches)->map(function ($item) {
            return [
                'page_title_value' => $item['route_name'],
                'page_title' => $item['route_name'],
                'uri' => $item['route_uri'],
                'full_route' => $item['route_full_url'],
                'keyword' => $item['keyword'],
                'response' => $item['response'],

            ];
        });
        $result = $this->advanceSearchService->getSortRecentSearchByType($formattedResult);

        return response()->json([
            'keyword' => '',
            'result' => $result,
            'htmlView' => view('adminmodule::admin._advance_search', [
                'result' => $result,
                'recent' => count($result) > 0 ? true : false,
                'keyword' => '',
            ])->render()
        ]);
    }

    public function refreshSetupGuideUI(): JsonResponse
    {
        $setup = getSetupGuideSteps('admin_panel', auth()->user());

        return response()->json([
            'percentage' => $setup['percentage'],
            'unchecked_keys' => collect($setup['steps'])
                ->where('checked', false)
                ->pluck('key')
                ->values(),
            'unchecked_count' => collect($setup['steps'])
                ->where('checked', false)
                ->count(),
            'steps' => $setup['steps'],
            'all_completed' => collect($setup['steps'])
                ->every(fn ($step) => $step['checked']),
        ]);

    }
}
