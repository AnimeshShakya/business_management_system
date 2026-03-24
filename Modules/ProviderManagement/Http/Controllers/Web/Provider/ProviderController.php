<?php

namespace Modules\ProviderManagement\Http\Controllers\Web\Provider;

use App\Traits\UploadSizeHelperTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Modules\AdminModule\Entities\RouteSearchHistory;
use Modules\AdminModule\Services\AdvanceSearch;
use Modules\BidModule\Entities\IgnoredPost;
use Modules\BidModule\Entities\Post;
use Modules\BookingModule\Entities\Booking;
use Modules\BookingModule\Entities\BookingDetailsAmount;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\BusinessSettingsModule\Entities\PackageSubscriber;
use Modules\ChattingModule\Entities\ChannelList;
use Modules\PromotionManagement\Entities\PushNotification;
use Modules\ProviderManagement\Entities\BankDetail;
use Modules\ProviderManagement\Entities\Provider;
use Modules\ProviderManagement\Entities\ProvidersWithdrawMethodsData;
use Modules\ProviderManagement\Entities\SubscribedService;
use Modules\ReviewModule\Entities\Review;
use Modules\ServiceManagement\Entities\Service;
use Modules\TransactionModule\Entities\Account;
use Modules\TransactionModule\Entities\Transaction;
use Modules\TransactionModule\Entities\WithdrawalMethod;
use Modules\UserManagement\Entities\Serviceman;
use Modules\UserManagement\Entities\User;
use Modules\ZoneManagement\Entities\Zone;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;


class ProviderController extends Controller
{
    use UploadSizeHelperTrait;

    private $provider, $account, $user, $push_notification, $serviceman;
    private $subscribedService;
    private Booking $booking;
    private Zone $zone;
    private Review $review;
    private Transaction $transaction;
    private ChannelList $channelList;
    protected WithdrawalMethod $withdrawal_method;

    private SubscribedService $subscribed_service;
    private BankDetail $bank_detail;
    protected BusinessSettings $business_settings;
    protected BookingDetailsAmount $booking_details_amount;
    protected SubscribedService $subscribedSubCategories;
    protected IgnoredPost $ignoredPost;
    protected Post $post;

    protected $messaging;

    protected $google_map;
    protected  $advanceSearchService;

    public function __construct(ChannelList $channelList, Transaction $transaction, SubscribedService $subscribedService, BankDetail $bankDetail, Provider $provider, Account $account, WithdrawalMethod $withdrawal_method, User $user, PushNotification $pushNotification, Serviceman $serviceman, Booking $booking, Zone $zone, Review $review, Service $service, SubscribedService $subscribed_service, BankDetail $bank_detail, BusinessSettings $business_settings, BookingDetailsAmount $booking_details_amount, IgnoredPost $ignoredPost, Post $post, AdvanceSearch $advanceSearchService)
    {
        $this->bank_detail = $bankDetail;
        $this->provider = $provider;
        $this->user = $user;
        $this->account = $account;
        $this->withdrawal_method = $withdrawal_method;
        $this->push_notification = $pushNotification;
        $this->serviceman = $serviceman;
        $this->subscribedService = $subscribedService;
        $this->google_map = business_config('google_map', 'third_party');
        $this->booking = $booking;
        $this->zone = $zone;
        $this->review = $review;
        $this->transaction = $transaction;
        $this->channelList = $channelList;
        $this->subscribed_sub_categories = $subscribedService;
        $this->ignoredPost = $ignoredPost;
        $this->post = $post;

        $this->subscribed_service = $subscribed_service;
        $this->bank_detail = $bank_detail;
        $this->business_settings = $business_settings;
        $this->booking_details_amount = $booking_details_amount;

        $this->messaging = app('firebase.messaging');
        $this->advanceSearchService = $advanceSearchService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function getUpdatedData(Request $request): JsonResponse
    {
        $subscribed = $this->subscribed_sub_categories->where(['provider_id' => $request->user()->provider->id])
            ->where(['is_subscribed' => 1])
            ->pluck('sub_category_id')->toArray();

        $booking = $this->booking
            ->whereIn('sub_category_id', $subscribed)
            ->where('zone_id', $request->user()->provider->zone_id)
            ->where('is_checked', 0)->count();
        $notificationCount = $this->push_notification->whereJsonContains('zone_ids', $request->user()->provider->zone_id)->whereJsonContains('to_users', 'provider-admin')->count();
        $notifications = $this->push_notification->whereJsonContains('zone_ids', $request->user()->provider->zone_id)->whereJsonContains('to_users', 'provider-admin')->latest()->take(50)->get();
        $message = $this->channelList->wherehas('channelUsers', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id)->where('is_read', 0);
        })->count();


        //bidding_service_request
        $ignoredPosts = IgnoredPost::where('provider_id', auth()->user()->provider->id)->pluck('post_id')->toArray();
        $biddingPostValidity = (int)(business_config('bidding_post_validity', 'bidding_system'))->live_values;

        $unchecked_posts = Post::whereNotIn('id', $ignoredPosts)
            ->whereIn('sub_category_id', $subscribed)
            ->where('zone_id', $request->user()->provider->zone_id)
            ->where('is_checked', 0)
            ->whereBetween('created_at', [Carbon::now()->subDays($biddingPostValidity), Carbon::now()])
            ->latest()
            ->get();

        $post = $unchecked_posts->first();

        //find distance
        $coordinates = auth()->user()->provider->coordinates ?? null;
        $distance = null;
        if (!is_null($coordinates) && isset($post) && $post->service_address) {
            $distance = get_distance(
                [$coordinates['latitude'] ?? null, $coordinates['longitude'] ?? null],
                [$post->service_address?->lat, $post->service_address?->lon]
            );
            $distance = ($distance) ? number_format($distance, 2) . ' km' : null;
        }

        return response()->json([
            'status' => 1,
            'data' => [
                'booking' => $booking,
                'notification_count' => $notificationCount,
                'notification_template' => view('providermanagement::provider.partials._notifications', compact('notifications'))->render(),
                'message' => $message,
                'unchecked_posts' => $unchecked_posts->count(),
                'post_content' => $post ? view('providermanagement::provider.partials._bidding_service_request', compact('post', 'distance'))->render() : null
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Transaction $transaction
     * @param SubscribedService $subscribedService
     * @param Serviceman $serviceman
     * @return Renderable
     */
    public function dashboard(Request $request, Transaction $transaction, SubscribedService $subscribedService, Serviceman $serviceman): Renderable
    {
        $notification = $this->push_notification->whereJsonContains('zone_ids', $request->user()->provider->zone_id)->get()->count();
        session()->put('notification_count', $notification);

        $data = [];

        $maxBookingAmount = (business_config('max_booking_amount', 'booking_setup'))->live_values;

        //top_cards
        $account = $this->account->where('user_id', $request->user()->id)->first();
        $data[] = ['top_cards' => [
            'total_earning' => $account['received_balance'] + $account['total_withdrawn'],
            'total_subscribed_services' => $this->subscribedService->where('provider_id', $request->user()->provider->id)
                ->with(['sub_category'])
                ->whereHas('category', function ($query) {
                    $query->where('is_active', 1);
                })->whereHas('sub_category', function ($query) {
                    $query->where('is_active', 1);
                })
                ->ofStatus(1)
                ->count(),
            'total_service_man' => $this->serviceman->where(['provider_id' => $request->user()->provider->id])->count(),
            'total_booking_served' => $request->user()->provider->bookings('completed')->count()
        ]];

        //provider total earning
        $totalEarning = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request) {
                $query->where('provider_id', $request->user()->provider->id)
                    ->ofBookingStatus('completed');
            })
            ->get()->sum('provider_earning');

        $data[] = ['provider_total_earning' => $totalEarning];


        //booking_stats
        $bookingOverview = DB::table('bookings')->where('provider_id', $request->user()->provider->id)
            ->select('booking_status', DB::raw('count(*) as total'))
            ->groupBy('booking_status')
            ->get();
        $totalBookings = $this->booking->where('provider_id', $request->user()->provider->id)->count();
        $data[] = ['booking_stats' => $bookingOverview, 'total_bookings' => $totalBookings];


        //recent_bookings
        $subCategoryIds = $this->subscribed_service->where('provider_id', $request->user()->provider->id)->ofSubscription(1)->pluck('sub_category_id')->toArray();
        $recent_bookings = $this->booking->with(['detail.service' => function ($query) {
            $query->select('id', 'name', 'thumbnail');
        }])
            ->whereIn('sub_category_id', $subCategoryIds)
            ->when($maxBookingAmount > 0, function ($query) use ($maxBookingAmount, $request) {
                if (!$request->user()?->provider?->is_suspended || !business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values) {
                    $query->where(function ($query) use ($maxBookingAmount) {
                        $query->where('payment_method', 'cash_after_service')
                            ->where(function ($query) use ($maxBookingAmount) {
                                $query->where('is_verified', 1)
                                    ->orWhere('total_booking_amount', '<=', $maxBookingAmount);
                            })
                            ->orWhere('payment_method', '<>', 'cash_after_service');
                    });
                } else {
                    $query->whereNull('id');
                }
            })
            ->where('booking_status', 'pending')
            ->where('zone_id', $request->user()->provider->zone_id)
            ->latest()
            ->take(5)
            ->get();
        $data[] = ['recent_bookings' => $recent_bookings];

        //my_subscriptions
        $subscriptions = $subscribedService
            ->with(['sub_category'])
            ->withCount(['services', 'completed_booking'])
            ->where(['provider_id' => $request->user()->provider->id])
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })->whereHas('sub_category', function ($query) {
                $query->where('is_active', 1);
            })
            ->ofStatus(1)
            ->take(5)->get();

        $data[] = ['subscriptions' => $subscriptions];


        //serviceman_list
        $servicemanList = $this->serviceman->whereHas('user', function ($q) {
            $q->ofStatus(1);
        })->with(['user'])
            ->where(['provider_id' => $request->user()->provider->id])
            ->latest()
            ->take(5)->get();

        $data[] = ['serviceman_list' => $servicemanList];

        //recent transactions
        $recentTransactions = $this->transaction->where(['to_user_id' => $request->user()->id])->where('credit', '>', 0)
            ->with(['booking'])
            ->latest()
            ->take(5)
            ->get();

        $data[] = [
            'recent_transactions' => $recentTransactions,
            'this_month_trx_count' => $transaction->where(['to_user_id' => $request->user()->id])
                ->where('credit', '>', 0)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count()
        ];

        //customize booking

        $subCategories = $this->subscribedService
            ->where(['provider_id' => $request->user()->provider->id])
            ->where(['is_subscribed' => 1])->pluck('sub_category_id')->toArray();

        $ignoredPosts = $this->ignoredPost->where('provider_id', $request->user()->provider->id)->pluck('post_id')->toArray();
        $biddingPostValidity = (int)(business_config('bidding_post_validity', 'bidding_system'))->live_values;
        $posts = $this->post
            ->with(['addition_instructions', 'service', 'category', 'sub_category', 'booking', 'customer'])
            ->where('is_booked', 0)
            ->whereNotIn('id', $ignoredPosts)
            ->whereIn('sub_category_id', $subCategories)
            ->where('zone_id', $request->user()->provider->zone_id)
            ->whereBetween('created_at', [Carbon::now()->subDays($biddingPostValidity), Carbon::now()])
            ->when(true, function ($query) use ($request) {
                if($request->user()?->provider?->service_availability && (!$request->user()?->provider?->is_suspended || !business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values)){
                    $query->whereDoesntHave('bids', function ($query) use ($request) {
                        $query->where('provider_id', $request->user()->provider->id);
                    });
                }else{
                    $query->whereNull('id');
                }
            })
            ->latest()
            ->take(5)->get();

        $data[] = ['customized_bookings' => $posts];


        // Data for chart
        $year = session()->has('dashboard_earning_graph_year') ? session('dashboard_earning_graph_year') : date('Y');
        $amounts = $this->booking_details_amount
            ->whereHas('booking', function ($query) use ($request, $year) {
                $query->where('provider_id', $request->user()->provider->id)
                    ->whereYear('created_at', '=', $year)
                    ->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(provider_earning) as provider_earning'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($amounts as $key => $item) {
                if ($item['month'] == $month) {
                    $chart_data['total_earning'][] = with_decimal_point($item['provider_earning']);
                    $found = 1;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
            }
        }
        //chart data end

        $postCount = $this->post
            ->where('is_booked', 0)
            ->whereNotIn('id', $ignoredPosts)
            ->whereIn('sub_category_id', $subCategories)
            ->where('zone_id', $request->user()->provider->zone_id)
            ->whereBetween('created_at', [Carbon::now()->subDays($biddingPostValidity), Carbon::now()])
            ->when(true, function ($query) use ($request) {
                if($request->user()?->provider?->service_availability && (!$request->user()?->provider?->is_suspended || !business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values)){
                    $query->whereDoesntHave('bids', function ($query) use ($request) {
                        $query->where('provider_id', $request->user()->provider->id);
                    });
                }else{
                    $query->whereNull('id');
                }
            })
            ->latest()->count();

        $pendingBookingCount = $this->booking->where('booking_status', 'pending')
            ->whereIn('sub_category_id', $subCategories)
            ->when($maxBookingAmount > 0, function ($query) use ($maxBookingAmount) {
                $query->where(function ($query) use ($maxBookingAmount) {
                    $query->where('payment_method', 'cash_after_service')
                        ->where(function ($query) use ($maxBookingAmount) {
                            $query->where('is_verified', 1)
                                ->orWhere('total_booking_amount', '<=', $maxBookingAmount);
                        })
                        ->orWhere('payment_method', '<>', 'cash_after_service');
                });
            })
            ->where('zone_id', $request->user()->provider->zone_id)
            ->count();

        $booking_counts = [
            'normal_booking_count' => $pendingBookingCount,
            'post_count' => $postCount,
        ];

        return view('providermanagement::dashboard', compact('data', 'chart_data', 'booking_counts'));
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
                $query->where('provider_id', $request->user()->provider->id)
                    ->whereYear('created_at', '=', $year)
                    ->ofBookingStatus('completed');
            })
            ->select(
                DB::raw('sum(provider_earning) as provider_earning'),

                DB::raw('MONTH(created_at) month')
            )
            ->groupby('month')->get()->toArray();

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $found = 0;
            foreach ($amounts as $key => $item) {
                if ($item['month'] == $month) {
                    $chart_data['total_earning'][] = with_decimal_point($item['provider_earning']);
                    $found = 1;
                }
            }
            if (!$found) {
                $chart_data['total_earning'][] = with_decimal_point(0);
            }
        }
        //chart data end

        session()->put('dashboard_earning_graph_year', $request['year']);

        return response()->json($chart_data);
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function subscribedSubCategories(Request $request): Renderable
    {
        $keys = explode(' ', $request['search']);
        $status = $request['status'];
        $search = $request['search'];
        $queryParam = ['status' => $request['status'], 'search' => $request['search']];

        $subscribedSubCategories = $this->subscribedService->where('provider_id', $request->user()->provider->id)
            ->with(['category', 'sub_category' => function ($query) {
                return $query->withCount(['services' => function ($query) {
                    $query->ofStatus(1);
                }])->with(['services']);
            }])->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })->whereHas('sub_category', function ($query) {
                $query->where('is_active', 1);
            })
            ->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                $query->where('is_subscribed', ($request['status'] == 'subscribed' ? 1 : 0));
            })
            ->where(function ($query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhereHas('sub_category', function ($query) use ($key) {
                        $query->where('name', 'LIKE', '%' . $key . '%');
                    });
                }
            })
            ->paginate(pagination_limit())->appends($queryParam);

        return view('providermanagement::subscribedSubCategory', compact('subscribedSubCategories', 'status', 'search'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function statusUpdate(Request $request, $id): JsonResponse
    {
        $service = $this->subscribedService->where('id', $id)->first();
        $this->subscribedService->where('id', $id)->update(['is_subscribed' => !$service->is_subscribed]);

        return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return View|Factory|RedirectResponse|Application
     */
    public function accountInfo(Request $request)
    {
        $pageType = $request['page_type'] ?? 'overview';

        if ($pageType == 'overview') {
            $pageType = $request['page_type'];

            //payment gateways
            $isPublished = 0;
            try {
                $fullData = include('Modules/Gateways/Addon/info.php');
                $isPublished = $fullData['is_published'] == 1 ? 1 : 0;
            } catch (\Exception $exception) {
            }

            $paymentGateways = collect($this->getPaymentMethods())
                ->filter(function ($query) use ($isPublished) {
                    if (!$isPublished) {
                        return in_array($query['gateway'], array_column(PAYMENT_METHODS, 'key'));
                    } else return $query;
                })->map(function ($query) {
                    $query['label'] = ucwords(str_replace('_', ' ', $query['gateway']));
                    return $query;
                })->values();
            $provider = $this->provider->with('owner.account')->withCount(['bookings'])->where('user_id', $request->user()->id)->first();
            $bookingOverview = DB::table('bookings')->where('provider_id', $request->user()->provider->id)
                ->select('booking_status', DB::raw('count(*) as total'))
                ->groupBy('booking_status')
                ->get();

            $status = ['accepted', 'ongoing', 'completed', 'canceled'];
            $total = [];
            foreach ($status as $item) {
                if ($bookingOverview->where('booking_status', $item)->first() !== null) {
                    $total[] = $bookingOverview->where('booking_status', $item)->first()->total;
                } else {
                    $total[] = 0;
                }
            }

            //total earning
            $account = $this->account->where('user_id', $request->user()->id)->first();
            $totalEarning = $account['received_balance'] + $account['total_withdrawn'];

            //adjust &
            $withdrawRequestAmount = [
                'minimum' => (float)(business_config('minimum_withdraw_amount', 'business_information'))->live_values ?? null,
                'maximum' => (float)(business_config('maximum_withdraw_amount', 'business_information'))->live_values ?? null,
            ];

            $min = $withdrawRequestAmount['minimum'];
            $max = $withdrawRequestAmount['maximum'];

            $mid = round(($min + $max) / 2 / 10) * 10;
            $mid1 = round(($min + $mid) / 2 / 10) * 10;
            $mid2 = round(($mid + $max) / 2 / 10) * 10;
            $num4 = ceil($max / 10) * 10;

            if ($min == 0 && $max == 0) {
                $num5 = 0;
            } else {
                if ($min >= $max || $max - $min > 10000) {
                    $min = 1;
                    $max = 100; // Set reasonable range
                }

                $mid = round(($min + $max) / 2);
                $mid1 = round(($min + $mid) / 2);
                $mid2 = round(($mid + $max) / 2);
                $num4 = $max;

                $excluded = array_unique([$mid, $mid1, $mid2, $num4]);

                $step = 10; // Prevent excessive range
                $validValues = range($min, $max, $step);
                $validValues = array_filter($validValues, fn($value) => !in_array($value, $excluded));

                $num5 = empty($validValues) ? $min : $validValues[array_rand($validValues)];
            }

            $withdrawRequestAmount['random'] = array($mid, $mid1, $num5, $mid2, $num4);
            //end

            $account = $this->account->where('user_id', $request->user()->id)->first();
            $receivable = $account->account_receivable;
            $payable = $account->account_payable;

            if ($receivable > $payable) {
                $collectable_cash = $receivable - $payable ?? 0;
            } elseif ($payable > $receivable) {
                $collectable_cash = $payable - $receivable ?? 0;
            } else {
                $collectable_cash = 0;
            }

            $withdrawalMethods = $this->withdrawal_method->ofStatus(1)->get();
            $savedWithdrawMethods = ProvidersWithdrawMethodsData::where('provider_id', $request->user()->id)->ofStatus(1)->get();

            return view('providermanagement::provider.account.overview', compact('pageType', 'provider', 'total', 'totalEarning', 'paymentGateways', 'collectable_cash', 'withdrawalMethods', 'withdrawRequestAmount', 'savedWithdrawMethods'));

        } elseif ($pageType == 'commission-info') {

            $provider = $this->provider->where('user_id', $request->user()->id)->first();
            $commission = $provider->commission_status == 1 ? $provider->commission_percentage : (business_config('default_commission', 'business_information'))->live_values;
            return view('providermanagement::provider.account.commission', compact('pageType', 'provider', 'commission'));

        } elseif ($pageType == 'review') {
            $providerId = $request->user()->provider->id;
            $packageSubscriber = PackageSubscriber::where('provider_id', $providerId)->with('feature')->first();
            $search = $request->has('search') ? $request['search'] : '';
            $queryParam = ['search' => $search, 'page_type' => $request['page_type']];

            if ($packageSubscriber ){
                if (!in_array('review', $packageSubscriber?->feature?->pluck('feature')->toArray())) {
                    Toastr::error(translate('your_package_does_not_include_this_section'));
                    return redirect()->route('provider.dashboard');
                }
            }

            $provider = $this->provider->with('reviews')->where('user_id', $request->user()->id)->first();
            $reviews = $this->booking->with(['reviews.service'])
                ->when($request->has('search'), function ($query) use ($request) {
                    $keys = explode(' ', $request['search']);
                    $query->whereHas('reviews', function ($query) use ($keys) {
                        foreach ($keys as $key) {
                            $query->where('review_comment', 'LIKE', '%' . $key . '%')
                                ->orWhere('readable_id', 'LIKE', '%' . $key . '%');
                        }
                    });
                })
                ->whereHas('reviews', function ($query) use ($providerId) {
                    $query->where('provider_id', $providerId)->where('is_active', 1);
                })
                ->latest()
                ->paginate(pagination_limit())
                ->appends($queryParam);

            return view('providermanagement::provider.account.review', compact('pageType', 'reviews', 'search', 'provider'));

        } elseif ($pageType == 'promotional_cost') {
            $promotionalCostPercentage = $this->business_settings->where('settings_type', 'promotional_setup')->get();
            return view('providermanagement::provider.account.promotional-cost', compact('pageType', 'promotionalCostPercentage'));
        }

        Toastr::error(translate('no_data_found'));
        return back();
    }

    public function adjust(Request $request): RedirectResponse
    {
        $provider = Provider::where('user_id', $request->user()->id)->first();
        $account = $this->account->where('user_id', $request->user()->id)->first();
        $receivable = $account->account_receivable;
        $payable = $account->account_payable;

        if ($receivable == $payable) {

            withdrawRequestAcceptForAdjustTransaction($request->user()->id, $receivable);
            collectCashTransaction($provider->id, $payable);

            Toastr::success(translate('account_amount_adjusted_successfully'));
            return redirect()->route('provider.account_info', ['page_type' => 'overview']);
        }

        Toastr::error(translate(DEFAULT_204['message']));
        return back();
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function bankInfo(Request $request): Renderable
    {
        $provider = $this->provider->with('bank_detail')->where('user_id', $request->user()->id)->first();
        return view('providermanagement::bank-info', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateBankInfo(Request $request)
    {
        Validator::make($request->all(), [
            'bank_name' => 'required',
            'branch_name' => 'required',
            'acc_no' => 'required',
            'acc_holder_name' => 'required',
            'routing_number' => 'required',
        ]);

        $this->bank_detail::updateOrCreate(
            ['provider_id' => $request->user()->provider->id],
            [
                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,
                'acc_no' => $request->acc_no,
                'acc_holder_name' => $request->acc_holder_name,
                'routing_number' => $request->routing_number,
            ]
        );

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function availableServices(Request $request): Renderable
    {
        return view('providermanagement::available-services');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function profileInfo(Request $request): Renderable
    {
        $provider = $this->provider->with(['owner.addresses', 'zone'])->where('user_id', $request->user()->id)->first();
        $zones = $this->zone->ofStatus(1)->select('id', 'name')->get();
        $maxBookingAmount = business_config('max_booking_amount', 'booking_setup')->live_values;

        $ongoingBookings = $this->booking
            ->where('booking_status', 'ongoing')
            ->where('provider_id', $request->user()->provider->id)
            ->count();

        $acceptedBookings = $this->booking
            ->where('provider_id', $request->user()->provider->id)
            ->providerAcceptedBookings($request->user()->provider->id, $maxBookingAmount)
            ->count();

        $account = $this->account->where('user_id', $request->user()->id)->first();

        return view('providermanagement::profile-update', compact('provider', 'zones', 'acceptedBookings', 'ongoingBookings', 'account'));
    }

    /**
     * Modify provider information
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $check = $this->validateUploadedFile($request, ['logo']);
        if ($check !== true) {
            return $check;
        }

        Validator::make($request->all(), [
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'contact_person_email' => 'required',
            'zone_id' => 'required',

            'password' => isset($request->password) ? 'string|min:8' : '',
            'confirm_password' => isset($request->password) ? 'required|same:password' : '',

            'company_name' => 'required',
            'company_email' => 'required|email',
            'company_phone' => 'required',
            'company_address' => 'required',
            'logo' => 'image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),

            'latitude' => 'required',
            'longitude' => 'required',
        ])->validate();

        $provider = $this->provider::where('user_id', $request->user()->id)->first();
        $provider->company_name = $request->company_name;
        $provider->company_email = $request->company_email;
        $provider->company_phone = $request->company_phone;
        if ($request->has('logo')) {
            $provider->logo = file_uploader('provider/logo/', APPLICATION_IMAGE_FORMAT, $request->file('logo'), $provider->logo);
        }
        $provider->company_address = $request->company_address;

        $provider->contact_person_name = $request->contact_person_name;
        $provider->contact_person_phone = $request->contact_person_phone;
        $provider->contact_person_email = $request->contact_person_email;
        $provider->zone_id = $request['zone_id'];
        $provider->coordinates = [
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
        ];

        $owner = $this->user->where('id', $request->user()->id)->first();
       // $owner->first_name = $request->account_first_name;
       // $owner->last_name = $request->account_last_name;

        if (isset($request->password)) {
            $owner->password = bcrypt($request->password);
        }

        DB::transaction(function () use ($provider, $owner) {
            $owner->save();
            $provider->save();
        });

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function download(Request $request)
    {
        $keys = explode(' ', $request['search']);
        $items = $this->subscribedService->where('provider_id', $request->user()->provider->id)
            ->with(['sub_category' => function ($query) {
                return $query->withCount('services')->with(['services']);
            }])
            ->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                return $query->where('is_subscribed', (($request['status'] == 'subscribed') ? 1 : 0));
            })
            ->where(function ($query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhereHas('sub_category', function ($query) use ($key) {
                        $query->where('name', 'LIKE', '%' . $key . '%');
                    });
                }
            })->get();
        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }

    public function reviewsDownload(Request $request)
    {
        $items = $this->review->with(['booking'])
            ->when($request->has('search'), function ($query) use ($request) {
                $query->whereHas('booking', function ($query) use ($request) {
                    $keys = explode(' ', $request['search']);
                    foreach ($keys as $key) {
                        $query->orWhere('readable_id', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->where('provider_id', auth()->user()->provider->id)
            ->latest()
            ->get();
        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }

    private function getPaymentMethods(): array
    {
        // Check if the addon_settings table exists
        if (!Schema::hasTable('addon_settings')) {
            return [];
        }

        $methods = DB::table('addon_settings')->where('settings_type', 'payment_config')->get();
        $env = env('APP_ENV') == 'live' ? 'live' : 'test';
        $credentials = $env . '_values';

        $data = [];
        foreach ($methods as $method) {
            $gateway_image = getPaymentGatewayImageFullPath(key: $method->key_name, settingsType: $method->settings_type, defaultPath: 'public/assets/admin-module/img/placeholder.png');
            $credentialsData = json_decode($method->$credentials);
            $additional_data = json_decode($method->additional_data);
            if ($credentialsData->status == 1) {
                $data[] = [
                    'gateway' => $method->key_name,
                    'gateway_image' => $gateway_image
                ];
            }
        }
        return $data;
    }

    public function deleteProvider(Request $request): RedirectResponse
    {
        $provider = $this->provider::where('user_id', $request->user()->id)->first();
        if ($provider) {
            $provider->delete();
            $provider->owner->delete();
            Toastr::success(translate(DEFAULT_DELETE_200['message']));
            Auth::logout();
        }
        Toastr::success(translate(DEFAULT_204['message']));
        return back();
    }

    private function routeFullUrl($uri)
    {
        $fullURL = url($uri);
        if ($uri == 'provider/booking/post'){
            $fullURL = url($uri). '?type=all';
        }if ($uri == 'provider/chat/index'){
            $fullURL = url($uri). '?user_type=super_admin';
        }if ($uri == 'provider/withdraw'){
            $fullURL = url($uri). '?page_type=withdraw_transaction';
        }if ($uri == 'provider/serviceman/list'){
            $fullURL = url($uri). '?status=all';
        }

        return $fullURL;
    }

    public function searchRouting(Request $request):JsonResponse
    {
        $searchKeyword = $request->input('search');
        $formattedRoutes = $this->advanceSearchService->pageSearchList(keyword:  $searchKeyword, type:"provider", );
        $menuSearchResults = [];
        if (!empty($searchKeyword)) {
            $menuSearchResults = $this->advanceSearchService->searchMenuList($searchKeyword,"provider");
        }
        $modelSearchResults = $this->advanceSearchService->searchModelList(keyword:  $searchKeyword, type: "provider", user:$request->user());
        $allRoutes = $this->advanceSearchService->sortByPriority($formattedRoutes,  $menuSearchResults, $modelSearchResults, $searchKeyword);
        return response()->json([
            'keyword' => $searchKeyword,
            'result' => $allRoutes,
            'htmlView' => view('providermanagement::provider._advance_search', [
                'result' => $allRoutes,
                'keyword' => $searchKeyword,
                'recent' => false,
            ])->render()
        ]);
    }

    private function filterRoute($model, $route, ?string $type = null, ?string $name = null, ?string $prefix = null)
    {
        $uri = $route->uri();
        $routeName = $route->getName();
        $formattedRouteName = ucwords(str_replace(['.', '_'], ' ', Str::afterLast($routeName, '.')));
        $uriWithParameter = str_replace('{id}', $model->id, $uri);
        $fullURL = url('/') . '/' . $uriWithParameter;
        if ($type == 'booking'){
            $fullURL = url('/') . '/' . $uriWithParameter. '?web_page=details';
        }
        if ($type == 'customer'){
            $fullURL = $formattedRouteName == 'Detail' ? $fullURL. '?web_page=overview' : $fullURL;
        }

        $routeName = $prefix ? $prefix. ' '. $formattedRouteName : $formattedRouteName;
        $routeName = $name ? $routeName. ' - (' . $name. ')' : $routeName;

        $routeInfo = [
            'routeName' => $routeName,
            'URI' => $uriWithParameter,
            'fullRoute' => $fullURL,
        ];
        return $routeInfo;
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
            'htmlView' => view('providermanagement::provider._advance_search', [
                'result' => $result,
                'recent' => count($result) > 0 ? true : false,
                'keyword' => '',
            ])->render()
        ]);
    }

    public function setModalClosed(Request $request): JsonResponse
    {
        Session::put('modalClosed', true);
        return response()->json(['success' => true]);
    }

    public function subscribeToTopic(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'topic' => 'required|string',
        ]);
        $token = $request->input('token');
        $topic = $request->input('topic');
        try {
            if($this->messaging){
                $this->messaging->subscribeToTopic($topic, $token);
                return response()->json(['message' => 'Successfully subscribed to topic'], 200);
            }
            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function refreshSetupGuideUI(): JsonResponse
    {
        $setup = getSetupGuideSteps('provider_panel', auth()->user());

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
