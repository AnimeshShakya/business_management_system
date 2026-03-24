<?php

namespace Modules\BookingModule\Http\Controllers\Api\V1\Provider;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\BookingModule\Entities\Booking;
use Modules\BookingModule\Entities\BookingDetail;
use Modules\BookingModule\Entities\BookingIgnore;
use Modules\BookingModule\Entities\BookingRepeat;
use Modules\BookingModule\Entities\BookingRepeatDetails;
use Modules\BookingModule\Entities\BookingRepeatHistory;
use Modules\BookingModule\Entities\BookingScheduleHistory;
use Modules\BookingModule\Entities\BookingStatusHistory;
use Modules\BookingModule\Http\Traits\BookingTrait;
use Modules\CartModule\Entities\Cart;
use Modules\ProviderManagement\Entities\SubscribedService;
use Modules\ServiceManagement\Entities\Service;
use Modules\UserManagement\Entities\UserAddress;
use Rap2hpoutre\FastExcel\FastExcel;
use function PHPUnit\Framework\isEmpty;

class BookingController extends Controller
{

    private Booking $booking;
    private BookingStatusHistory $bookingStatusHistory;
    private BookingScheduleHistory $bookingScheduleHistory;
    private $subscribedSubCategories;
    private BookingDetail $bookingDetail;
    private BookingIgnore $bookingIgnore;
    private BookingRepeat $bookingRepeat;
    private BookingRepeatDetails $bookingRepeatDetail;
    private BookingRepeatHistory $bookingRepeatHistory;

    use BookingTrait;

    public function __construct(Booking $booking, BookingRepeat $bookingRepeat, BookingRepeatDetails $bookingRepeatDetail, BookingStatusHistory $bookingStatusHistory, BookingScheduleHistory $bookingScheduleHistory, SubscribedService $subscribedService, BookingDetail $bookingDetail, BookingIgnore $bookingIgnore, BookingRepeatHistory $bookingRepeatHistory)
    {
        $this->booking = $booking;
        $this->bookingStatusHistory = $bookingStatusHistory;
        $this->bookingScheduleHistory = $bookingScheduleHistory;
        $this->bookingDetail = $bookingDetail;
        $this->bookingIgnore = $bookingIgnore;
        $this->bookingRepeat = $bookingRepeat;
        $this->bookingRepeatDetail = $bookingRepeatDetail;
        $this->bookingRepeatHistory = $bookingRepeatHistory;
        try {
            $this->subscribedSubCategories = $subscribedService->where(['provider_id' => auth('api')->user()->provider->id])
                ->where(['is_subscribed' => 1])->pluck('sub_category_id')->toArray();
        } catch (\Exception $exception) {
            $this->subscribedSubCategories = $subscribedService->pluck('sub_category_id')->toArray();
        }
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'booking_status' => 'required|in:' . implode(',', array_column(BOOKING_STATUSES, 'key')) . ',all',
            'from_date' => 'date',
            'to_date' => 'date',
            'sub_category_ids' => 'array',
            'sub_category_ids.*' => 'uuid',
            'category_ids' => 'array',
            'category_ids.*' => 'uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $providerId = $request->user()->provider->id;
        $maxBookingAmount = business_config('max_booking_amount', 'booking_setup')->live_values;

        //status wise bookings count
        $status_wise_bookings_count = $this->booking
            ->where('provider_id', $request->user()->provider->id)
            ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                $query->where('provider_id', $providerId);
            })
            ->when($request['service_type'] != 'all', function ($query) use ($request) {
                return $query->ofRepeatBookingStatus($request['service_type'] === 'repeat' ? 1 : ($request['service_type'] === 'regular' ? 0 : null));
            })
            ->select('booking_status', DB::raw('count(*) as total'))
            ->groupBy('booking_status')
            ->get();

        $bookings_count = collect(BOOKING_STATUSES)->mapWithKeys(function ($item) use ($status_wise_bookings_count) {
            $total = $status_wise_bookings_count->where('booking_status', $item['key'])->first();
            return [$item['key'] => $total ? $total->total : 0];
        })->toArray();

        $serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0);
        $serviceLocations = getProviderSettings(providerId: $providerId, key: 'service_location', type: 'provider_config') ?? ['customer'];

        $bookings_count['pending'] = $this->booking
            ->providerPendingBookings($request->user()->provider, $maxBookingAmount)
            ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                $query->where('provider_id', $providerId);
            })
            ->when($request['service_type'] != 'all', function ($query) use ($request) {
                return $query->ofRepeatBookingStatus($request['service_type'] === 'repeat' ? 1 : ($request['service_type'] === 'regular' ? 0 : null));
            })
            ->when($serviceAtProviderPlace == 1, function ($query) use ($serviceLocations) {
                $query->whereIn('service_location', $serviceLocations);
            })
            ->count();

        $bookings_count['accepted'] = $this->booking
            ->providerAcceptedBookings($request->user()->provider->id, $maxBookingAmount)
            ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                $query->where('provider_id', $providerId);
            })
            ->when($request['service_type'] != 'all', function ($query) use ($request) {
                return $query->ofRepeatBookingStatus($request['service_type'] === 'repeat' ? 1 : ($request['service_type'] === 'regular' ? 0 : null));
            })
            ->count();

        $serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0);
        $serviceLocations = getProviderSettings(providerId: $providerId, key: 'service_location', type: 'provider_config') ?? ['customer'];


        //bookings list
        $bookings = $this->booking
            ->with(['customer', 'subCategory:id,name', 'booking_offline_payments' => function ($query) {
                    $query->first() ?? [];
            }])
            ->when(!in_array($request['booking_status'], ['pending', 'all']), function ($query) use ($providerId, $request, $maxBookingAmount) {
                $query->ofBookingStatus($request['booking_status'])
                    ->where('provider_id', $providerId)
                    ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                        $query->where('provider_id', $providerId);
                    })
                    ->when($request['booking_status'] == 'accepted', function ($query) use ($providerId, $request, $maxBookingAmount) {
                        $query->providerAcceptedBookings($request->user()->provider->id, $maxBookingAmount)
                            ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                                $query->where('provider_id', $providerId);
                            });
                    });
            })
            ->when($request['booking_status'] == 'all', function ($query) use ($providerId, $request, $maxBookingAmount, $serviceAtProviderPlace, $serviceLocations) {

                $query->where(function ($query) use ($providerId) {
                    $query->where('provider_id', $providerId)
                        ->whereNotIn('booking_status', ['pending'])
                        ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                            $query->where('provider_id', $providerId);
                        });
                })
                    ->orWhere(function ($query) use ($providerId, $request, $maxBookingAmount, $serviceAtProviderPlace, $serviceLocations) {
                        $query->providerPendingBookings($request->user()->provider, $maxBookingAmount)
                            ->when($serviceAtProviderPlace == 1, function ($query) use ($serviceLocations) {
                                $query->whereIn('service_location', $serviceLocations);
                            });
                    });
            })
            ->when($request['booking_status'] == 'pending', function ($query) use ($providerId, $request, $maxBookingAmount, $serviceAtProviderPlace, $serviceLocations) {
                $query->providerPendingBookings($request->user()->provider, $maxBookingAmount)
                    ->whereDoesntHave('ignores', function ($query) use ($providerId) {
                        $query->where('provider_id', $providerId);
                    })->when($serviceAtProviderPlace == 1, function ($query) use ($serviceLocations) {
                        $query->whereIn('service_location', $serviceLocations);
                    });
            })
            ->when($request['service_type'] != 'all', function ($query) use ($request) {
                return $query->ofRepeatBookingStatus($request['service_type'] === 'repeat' ? 1 : ($request['service_type'] === 'regular' ? 0 : null));
            })
            ->search(base64_decode($request['string']), ['readable_id'])
            ->filterByDateRange($request['from_date'], $request['to_date'])
            ->filterBySubcategoryIds($request['sub_category_ids'])
            ->filterByCategoryIds($request['category_ids'])
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

        foreach ($bookings as $booking) {
            if ($booking->repeat->isNotEmpty()) {
                $sortedRepeats = $booking->repeat->sortBy(function ($repeat) {
                    $parts = explode('-', $repeat->readable_id);
                    $suffix = end($parts);
                    return $this->readableIdToNumber($suffix);
                });
                $booking->repeats = $sortedRepeats->values()->toArray();
            }
            unset($booking->repeat);
        }

        return response()->json(response_formatter(DEFAULT_200, [
            'bookings_count' => $bookings_count,
            'bookings' => $bookings,
        ]), 200);
    }

//    public function bookingCalendar(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'mode' => 'required|in:dayGridMonth,timeGridWeek,timeGridDay',
//            'month' => 'required_if:mode,dayGridMonth|integer|min:1|max:12',
//            'year'  => 'required_if:mode,dayGridMonth|integer|min:2000|max:2100',
//            'start_date' => 'required_if:mode,timeGridWeek|date',
//            'end_date'   => 'required_if:mode,timeGridWeek|date|after_or_equal:start_date',
//            'date' => 'required_if:mode,timeGridDay|date',
//            'filter_start_date' => 'nullable|date',
//            'filter_end_date'   => 'nullable|date|after_or_equal:filter_start_date',
//            'booking_status' => 'array',
//            'booking_status.*' => 'in:pending,accepted,ongoing,completed,canceled',
//            'booking_type' => 'nullable|in:all,regular,repeat',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
//        }
//
//        $providerId = $request->user()?->provider?->id;
//        $mode = $request->mode;
//
//        if ($request->filled('filter_start_date') && $request->filled('filter_end_date')) {
//
//            $sDate = Carbon::parse($request->filter_start_date)->startOfDay();
//            $eDate = Carbon::parse($request->filter_end_date)->endOfDay();
//
//        } else {
//
//            if ($mode === 'dayGridMonth') {
//
//                $sDate = Carbon::createFromDate($request->year, $request->month, 1)->startOfDay();
//                $eDate = Carbon::createFromDate($request->year, $request->month, 1)->endOfMonth()->endOfDay();
//
//            } elseif ($mode === 'timeGridWeek') {
//
//                $sDate = Carbon::parse($request->start_date)->startOfDay();
//                $eDate = Carbon::parse($request->end_date)->endOfDay();
//
//            } else { // timeGridDay
//
//                $sDate = Carbon::parse($request->date)->startOfDay();
//                $eDate = Carbon::parse($request->date)->endOfDay();
//            }
//        }
//
//        $bookings = Booking::where('provider_id', $providerId)
//            ->where(function ($q) use ($sDate, $eDate) {
//
//                // Regular bookings
//                $q->where(function ($q1) use ($sDate, $eDate) {
//                    $q1->where('is_repeated', 0)
//                        ->whereBetween('service_schedule', [$sDate, $eDate]);
//                })
//
//                    // Repeat bookings (date from repeat table)
//                    ->orWhere(function ($q2) use ($sDate, $eDate) {
//                        $q2->where('is_repeated', 1)
//                            ->whereHas('repeat', function ($qr) use ($sDate, $eDate) {
//                                $qr->whereBetween('service_schedule', [$sDate, $eDate]);
//                            });
//                    });
//            })
//            ->when($request->filled('booking_status'), function ($q) use ($request) {
//                $q->whereIn('booking_status', (array) $request->booking_status);
//            })
//            ->when(
//                $request->filled('booking_type') && $request->booking_type !== 'all',
//                fn ($q) => $q->where('is_repeated', $request->booking_type === 'repeat' ? 1 : 0)
//            )
//            ->with('repeat')
//            ->get();
//
//        foreach ($bookings as $booking) {
//
//            if ($booking->is_repeated && $booking->repeat->isNotEmpty()) {
//
//                $nextService = $booking->repeat
//                    ->whereIn('booking_status', ['ongoing', 'accepted', 'pending'])
//                    ->sortBy('service_schedule')
//                    ->first();
//
//                $booking->nextService = $nextService;
//                $booking->lastRepeat  = $booking->repeat->sortBy('service_schedule')->last();
//
//            } else {
//                $booking->nextService = null;
//                $booking->lastRepeat  = null;
//            }
//
//            // Unified schedule used everywhere
//            $booking->effective_service_schedule =
//                $booking->is_repeated
//                    ? ($booking->nextService?->service_schedule ?? $booking->lastRepeat?->service_schedule)
//                    : $booking->service_schedule;
//        }
//
//
//        $groups = [];
//
//        foreach ($bookings as $booking) {
//            if (!$booking->effective_service_schedule) {
//                continue;
//            }
//
//            $dt = Carbon::parse($booking->service_schedule);
//
//            if ($mode === 'dayGridMonth') {
//
//                $key = $dt->format('Y-m-d');
//
//                $startDate = $dt->format('Y-m-d');
//                $endDate   = $startDate;
//
//                $startHour = null;
//                $endHour   = null;
//
//            } else {
//
//                $key = $dt->format('Y-m-d H:00');
//
//                $startDate = $dt->format('Y-m-d');
//                $endDate   = $startDate;
//
//                $startHour = $dt->format('H:00:00');
//                $endHour   = $dt->copy()->addHour()->format('H:00:00');
//            }
//
//            if (!isset($groups[$key])) {
//                $groups[$key] = [
//                    'count'           => 0,
//                    'start'           => $startDate,
//                    'end'             => $endDate,
//                    'start_hour_time' => $startHour,
//                    'end_hour_time'   => $endHour,
//                    'bookings'        => [],
//                ];
//            }
//
//            $groups[$key]['count']++;
//
//            $groups[$key]['bookings'][] = [
//                'id' => $booking->id,
//                'readable_id' => $booking->readable_id,
//                'is_repeated' => $booking->is_repeated,
//
//                'service_schedule' => $booking->effective_service_schedule,
//                'next_service_schedule' => $booking->nextService?->service_schedule,
//                'last_repeat_schedule'  => $booking->lastRepeat?->service_schedule,
//
//                'booking_status' => $booking->booking_status,
//                'service_location' => $booking->service_location ?? 'At your location',
//                'total_booking_amount' => $booking->total_booking_amount,
//                'created_at' => $booking->created_at,
//            ];
//        }
//
//        $events = [];
//
//        foreach ($groups as $group) {
//            $events[] = [
//                'mode'            => $mode,
//                'count'           => $group['count'],
//                'start'           => $group['start'],
//                'end'             => $group['end'],
//                'start_hour_time' => $group['start_hour_time'],
//                'end_hour_time'   => $group['end_hour_time'],
//                'bookings'        => $group['bookings'],
//            ];
//        }
//
//        return response()->json(
//            response_formatter(DEFAULT_200, [
//                'filter_start_date' => $request->filter_start_date,
//                'filter_end_date' => $request->filter_end_date,
//                'booking_type' => $request->booking_type,
//                'booking_status' => $request->booking_status,
//                $mode => $events,
//            ]), 200
//        );
//    }

    public function bookingCalendar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mode' => 'required|in:dayGridMonth,timeGridWeek,timeGridDay',
            'month' => 'required_if:mode,dayGridMonth|integer|min:1|max:12',
            'year'  => 'required_if:mode,dayGridMonth|integer|min:2000|max:2100',
            'start_date' => 'required_if:mode,timeGridWeek|date',
            'end_date'   => 'required_if:mode,timeGridWeek|date|after_or_equal:start_date',
            'date' => 'required_if:mode,timeGridDay|date',
            'filter_start_date' => 'nullable|date',
            'filter_end_date'   => 'nullable|date|after_or_equal:filter_start_date',
            'booking_status' => 'array',
            'booking_status.*' => 'in:pending,accepted,ongoing,completed,canceled',
            'booking_type' => 'nullable|in:all,regular,repeat',
        ]);

        if ($validator->fails()) {
            return response()->json(
                response_formatter(DEFAULT_400, null, error_processor($validator)),
                400
            );
        }

        $providerId = $request->user()?->provider?->id;
        $mode = $request->mode;

        /*
        |--------------------------------------------------------------------------
        | Resolve date range
        |--------------------------------------------------------------------------
        */
        if ($request->filled('filter_start_date') && $request->filled('filter_end_date')) {

            $sDate = Carbon::parse($request->filter_start_date)->startOfDay();
            $eDate = Carbon::parse($request->filter_end_date)->endOfDay();

        } else {

            if ($mode === 'dayGridMonth') {

                $sDate = Carbon::createFromDate($request->year, $request->month, 1)->startOfDay();
                $eDate = Carbon::createFromDate($request->year, $request->month, 1)->endOfMonth()->endOfDay();

            } elseif ($mode === 'timeGridWeek') {

                $sDate = Carbon::parse($request->start_date)->startOfDay();
                $eDate = Carbon::parse($request->end_date)->endOfDay();

            } else {

                $sDate = Carbon::parse($request->date)->startOfDay();
                $eDate = Carbon::parse($request->date)->endOfDay();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Load bookings
        |--------------------------------------------------------------------------
        */
        $bookings = Booking::where('provider_id', $providerId)
            ->where(function ($q) use ($sDate, $eDate) {

                $q->where(function ($q1) use ($sDate, $eDate) {
                    $q1->where('is_repeated', 0)
                        ->whereBetween('service_schedule', [$sDate, $eDate]);
                })

                    ->orWhere(function ($q2) use ($sDate, $eDate) {
                        $q2->where('is_repeated', 1)
                            ->whereHas('repeat', function ($qr) use ($sDate, $eDate) {
                                $qr->whereBetween('service_schedule', [$sDate, $eDate]);
                            });
                    });

            })
            ->when($request->filled('booking_status'), function ($q) use ($request) {
                $q->whereIn('booking_status', (array)$request->booking_status);
            })
            ->when(
                $request->filled('booking_type') && $request->booking_type !== 'all',
                fn ($q) => $q->where('is_repeated', $request->booking_type === 'repeat' ? 1 : 0)
            )
            ->with('repeat')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Expand bookings (repeat bookings → multiple calendar items)
        |--------------------------------------------------------------------------
        */
        $calendarItems = [];

        foreach ($bookings as $booking) {

            /*
            |--------------------------------------------------------------------------
            | REGULAR BOOKING
            |--------------------------------------------------------------------------
            */
            if (!$booking->is_repeated) {

                if (!$booking->service_schedule) continue;

                $calendarItems[] = [
                    'booking'  => $booking,
                    'schedule' => Carbon::parse($booking->service_schedule),
                    'repeat'   => null
                ];

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | REPEAT BOOKING
            |--------------------------------------------------------------------------
            */
            foreach ($booking->repeat as $repeat) {

                if (
                    $repeat->service_schedule < $sDate ||
                    $repeat->service_schedule > $eDate
                ) continue;

                if ($request->filled('booking_status')) {
                    if (!in_array($repeat->booking_status, (array)$request->booking_status)) {
                        continue;
                    }
                }

                $calendarItems[] = [
                    'booking'  => $booking,
                    'schedule' => Carbon::parse($repeat->service_schedule),
                    'repeat'   => $repeat
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Group calendar items
        |--------------------------------------------------------------------------
        */
        $groups = [];

        foreach ($calendarItems as $item) {

            $booking = $item['booking'];
            $dt = $item['schedule'];
            $repeat = $item['repeat'];

            if ($mode === 'dayGridMonth') {

                $key = $dt->format('Y-m-d');

                $startDate = $dt->format('Y-m-d');
                $endDate   = $startDate;

                $startHour = null;
                $endHour   = null;

            } else {

                $key = $dt->format('Y-m-d H:00');

                $startDate = $dt->format('Y-m-d');
                $endDate   = $startDate;

                $startHour = $dt->format('H:00:00');
                $endHour   = $dt->copy()->addHour()->format('H:00:00');
            }

            if (!isset($groups[$key])) {
                $groups[$key] = [
                    'count' => 0,
                    'start' => $startDate,
                    'end'   => $endDate,
                    'start_hour_time' => $startHour,
                    'end_hour_time'   => $endHour,
                    'bookings' => []
                ];
            }

            $groups[$key]['count']++;

            $groups[$key]['bookings'][] = [
                'id' => $booking->id,
                'readable_id' => $booking->readable_id,
                'is_repeated' => $booking->is_repeated,
                'service_schedule' => $dt,
                'booking_status' => $repeat?->booking_status ?? $booking->booking_status,
                'service_location' => $booking->service_location ?? 'At your location',
                'total_booking_amount' => $booking->total_booking_amount,
                'created_at' => $booking->created_at
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Build response
        |--------------------------------------------------------------------------
        */
        $events = [];

        foreach ($groups as $group) {

            $events[] = [
                'mode' => $mode,
                'count' => $group['count'],
                'start' => $group['start'],
                'end'   => $group['end'],
                'start_hour_time' => $group['start_hour_time'],
                'end_hour_time'   => $group['end_hour_time'],
                'bookings' => $group['bookings']
            ];
        }

        return response()->json(
            response_formatter(DEFAULT_200, [
                'filter_start_date' => $request->filter_start_date,
                'filter_end_date'   => $request->filter_end_date,
                'booking_type'      => $request->booking_type,
                'booking_status'    => $request->booking_status,
                $mode               => $events,
            ]),
            200
        );
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \OpenSpout\Common\Exception\IOException
     * @throws \OpenSpout\Common\Exception\InvalidArgumentException
     * @throws \OpenSpout\Common\Exception\UnsupportedTypeException
     * @throws \OpenSpout\Writer\Exception\WriterNotOpenedException
     */
    public function download(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_status' => 'required|in:all,' . implode(',', array_column(BOOKING_STATUSES, 'key')),
            'zone_ids' => 'array',
            'from_date' => 'date',
            'to_date' => 'date',
            'sub_category_ids' => 'array',
            'sub_category_ids.*' => 'uuid',
            'category_ids' => 'array',
            'category_ids.*' => 'uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $bookings = $this->booking->where('provider_id', $request->user()->id)
            ->when($request['booking_status'] != 'all', function ($query) use ($request) {
                $query->ofBookingStatus($request['booking_status']);
            })->when($request->has('zone_ids'), function ($query) use ($request) {
                $query->whereIn('zone_id', $request['zone_ids']);
            })->when($request->has('from_date') && $request->has('to_date'), function ($query) use ($request) {
                $query->whereBetween('created_at', [$request['from_date'], $request['to_date']]);
            })->when($request->has('sub_category_ids'), function ($query) use ($request) {
                $query->whereIn('sub_category_id', [$request['sub_category_ids']]);
            })->when($request->has('category_ids'), function ($query) use ($request) {
                $query->whereIn('category_id', [$request['category_ids']]);
            })
            ->latest()->get();

        if (!Storage::disk('public')->exists('/download')) {
            Storage::disk('public')->makeDirectory('/download');
        }
        return response()->json(response_formatter(DEFAULT_200, ['download_link' => (new FastExcel($bookings))->export('storage/app/public/download/bookings-' . date('Y-m-d') . '-' . rand(1000, 99999) . '.xlsx')]), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $provider_id = $request->user()->provider->id;
        $booking = $this->booking->with([
            'detail.service', 'schedule_histories.user', 'status_histories.user', 'customer',
            'provider', 'zone', 'serviceman.user', 'booking_partial_payments', 'booking_offline_payments',
            'repeat.detail.service', 'repeat.repeatHistories'
        ])->where(function ($query) use ($provider_id, $request) {
            return $query->where(function ($query) use ($provider_id) {
                $query->where('provider_id', $provider_id)
                    ->orWhereHas('repeat', function ($subQuery) use ($provider_id) {
                        $subQuery->where('provider_id', $provider_id);
                    });
            })->orWhereNull('provider_id');
        })->where(['id' => $id])->first();

        if (isset($booking)) {
            $booking->service_address = $booking->service_address_location != null ? json_decode($booking->service_address_location) : $booking->service_address;

            $offlinePayment = $booking->booking_offline_payments?->first();
            unset($booking->booking_offline_payments);

            if ($offlinePayment) {
                $booking->booking_offline_payment_method = $offlinePayment->method_name;
                $booking->booking_offline_payment = collect($offlinePayment->customer_information)->map(function ($value, $key) {
                    return ["key" => $key, "value" => $value];
                })->values()->all();
            }

            if ($booking->repeat->isNotEmpty()) {
                $repeatHistoryCollection = $booking->repeat->flatMap(function ($repeat) {
                    return $repeat->repeatHistories->map(function ($history) {
                        $history->log_details = json_decode($history->log_details);
                        return $history;
                    });
                });

                $booking['repeatHistory'] = $repeatHistoryCollection->toArray();
                $sortedRepeats = $booking->repeat->sortBy(function ($repeat) {
                    $parts = explode('-', $repeat->readable_id);
                    $suffix = end($parts);
                    return $this->readableIdToNumber($suffix);
                });
                $booking['repeats'] = $sortedRepeats->values()->toArray();

                $nextService = collect($booking['repeats'])->firstWhere('booking_status', 'ongoing');
                if (!$nextService) {
                    $nextService = collect($booking['repeats'])->firstWhere('booking_status', 'accepted');
                }

                $booking['nextService'] = $nextService;
                $booking['time'] = max(collect($booking['repeats'])->pluck('service_schedule')->flatten()->toArray());
                $booking['startDate'] = min(collect($booking['repeats'])->pluck('service_schedule')->flatten()->toArray());
                $booking['endDate'] = max(collect($booking['repeats'])->pluck('service_schedule')->flatten()->toArray());
                $booking['totalCount'] = count($booking['repeats']);
                $booking['bookingType'] = $booking['repeats'][0]['booking_type'];

                if ($booking['bookingType'] == 'weekly') {
                    $booking['weekNames'] = collect($booking['repeats'])
                        ->pluck('service_schedule')
                        ->map(function ($schedule) {
                            return \Carbon\Carbon::parse($schedule)->format('l');
                        })
                        ->unique()
                        ->sort()
                        ->values()
                        ->toArray();
                }

                $booking['completedCount'] = collect($booking['repeats'])->where('booking_status', 'completed')->count();
                $booking['canceledCount'] = collect($booking['repeats'])->where('booking_status', 'canceled')->count();

                unset($booking->repeat);

                $booking['repeats'] = array_map(function ($repeat) {
                    if (isset($repeat['repeat_histories'])) {
                        unset($repeat['repeat_histories']);
                    }
                    return $repeat;
                }, $booking['repeats']);
            }

            return response()->json(response_formatter(DEFAULT_200, $booking), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function singleDetails(Request $request, string $id): JsonResponse
    {
        $booking = $this->bookingRepeat->with([
            'detail.service', 'scheduleHistories.user', 'statusHistories.user', 'booking.customer', 'booking.provider', 'serviceman.user'
        ])->where(function ($query) use ($request) {
            return $query->where('provider_id', $request->user()->provider->id)->orWhereNull('provider_id');
        })->where(['id' => $id])->first();

        if (isset($booking)) {
            $booking->booking->service_address = $booking->booking->service_address_location != null ? json_decode($booking->booking->service_address_location) : $booking->booking->service_address;
            return response()->json(response_formatter(DEFAULT_200, $booking), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function requestAccept(Request $request, string $bookingId): JsonResponse
    {
        $booking = $this->booking->where('id', $bookingId)->first();

        if (isset($booking)) {

            $provider = $request->user()->provider;

            if ($provider?->is_suspended == 1 && business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values) {
                return response()->json(DEFAULT_SUSPEND_200, 404);
            }

            if ($booking->booking_status == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_CANCELED_200), 200);
            }

            $nextBookingEligibility = nextBookingEligibility($provider->id);
            if (!$nextBookingEligibility) {
                return response()->json(response_formatter(BOOKING_LIMIT_END), 200);
            }

            $booking->provider_id = $request->user()->provider->id;
            $booking->booking_status = 'accepted';

            $bookingStatusHistory = $this->bookingStatusHistory;
            $bookingStatusHistory->booking_id = $bookingId;
            $bookingStatusHistory->changed_by = $request->user()->id;
            $bookingStatusHistory->booking_status = 'accepted';

            DB::transaction(function () use ($bookingStatusHistory, $booking, $request) {
                $booking->save();
                $bookingStatusHistory->save();

                if ($booking->repeat->isNotEmpty()) {
                    foreach ($booking->repeat as $repeat) {
                        $repeat->provider_id = $request->user()->provider->id;
                        $repeat->booking_status = 'accepted';
                        $repeat->save();

                        $repeatBookingStatusHistory = new $this->bookingStatusHistory;
                        $repeatBookingStatusHistory->booking_id = 0;
                        $repeatBookingStatusHistory->booking_repeat_id = $repeat->id;
                        $repeatBookingStatusHistory->changed_by = $request->user()->id;
                        $repeatBookingStatusHistory->booking_status = 'accepted';
                        $repeatBookingStatusHistory->save();
                    }
                }
            });

            return response()->json(response_formatter(BOOKING_STATUS_UPDATE_SUCCESS_200), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function requestIgnore(Request $request, string $bookingId): JsonResponse
    {
        $providerId = $request->user()->provider->id;
        $booking = $this->booking->where('id', $bookingId)->first();
        $repeatBookings = $this->bookingRepeat->where('booking_id', $bookingId)->get();

        if (isset($booking)) {

            $ignoreList = $this->bookingIgnore->where('booking_id', $bookingId)->where('provider_id', $providerId)->first();
            if ($ignoreList) {
                return response()->json(response_formatter(BOOKING_ALREADY_IGNORED_200), 200);
            }

            $bookingIgnore = $this->bookingIgnore;
            $bookingIgnore->booking_id = $bookingId;
            $bookingIgnore->provider_id = $providerId;

            if (!empty($booking->provider_id)) {
                $booking->provider_id = null;

                $fcmToken = $booking?->customer?->fcm_token ?? null;
                $repeatOrRegular = $booking?->is_repeated ? 'repeat' : 'regular';
                $languageKey = $booking?->customer?->current_language_key;
                if (!is_null($fcmToken)) {
                    $notification = isNotificationActive(null, 'booking', 'notification', 'user');
                    if ($notification) {
                        device_notification($fcmToken, "Booking ignore by provider", null, null, $booking->id, 'booking_ignored', null, null, null, null, $repeatOrRegular);
                    }
                }
            }


            DB::transaction(function () use ($bookingIgnore, $booking, $repeatBookings) {
                $bookingIgnore->save();
                $booking->save();

                foreach ($repeatBookings as $repeatBooking) {
                    $repeatBooking->provider_id = null;
                    $repeatBooking->save();
                }
            });

            return response()->json(response_formatter(BOOKING_IGNORE_SUCCESS_200), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function singleBookingCancel(Request $request, string $repeatId): JsonResponse
    {
        $providerId = $request->user()->provider->id;
        $booking = $this->bookingRepeat->where('id', $repeatId)->where('provider_id', $providerId)->first();

        if (isset($booking)) {
            $statusCheck = $booking->booking_status == 'canceled';
            if ($statusCheck) {
                return response()->json(response_formatter(BOOKING_ALREADY_CANCELED_200), 200);
            }

            if ($booking->extra_fee > 0) {

                $repeats = $this->booking->where('id', $booking->booking_id)->first();
                $sortedRepeats = $repeats->repeat->sortBy(function ($repeat) {
                    $parts = explode('-', $repeat->readable_id);
                    $suffix = end($parts);
                    return $this->readableIdToNumber($suffix);
                });

                $repeats['repeats'] = $sortedRepeats->values()->toArray();

                $nextService = collect($repeats['repeats'])
                    ->where('booking_status', 'ongoing')
                    ->skip(1)
                    ->first();

                if (!$nextService) {
                    $nextService = collect($repeats['repeats'])
                        ->where('booking_status', 'accepted')
                        ->skip(1)
                        ->first();
                }

                if (!$nextService) {
                    $nextService = collect($repeats['repeats'])
                        ->where('booking_status', 'pending')
                        ->skip(1)
                        ->first();
                }

                if (isset($nextService)) {
                    $nextServiceId = $nextService['id'];
                    $nextServiceFee = $this->bookingRepeat->where('id', $nextServiceId)->first();
                    $nextServiceFee->extra_fee = $booking->extra_fee;
                    $nextServiceFee->total_booking_amount += $booking->extra_fee;
                    $nextServiceFee->save();

                    $booking->total_booking_amount -= $booking->extra_fee;
                    $booking->extra_fee = 0;
                }
            }

            DB::transaction(function () use ($booking) {
                $booking->booking_status = 'canceled';
                $booking->save();
            });

            return response()->json(response_formatter(DEFAULT_200), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function statusUpdate(Request $request, string $bookingId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_status' => 'required|in:' . implode(',', array_column(BOOKING_STATUSES, 'key')),
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->where('id', $bookingId)->where(function ($query) use ($request) {
            return $query->where('provider_id', $request->user()->provider->id)->orWhereNull('provider_id');
        })->first();

        if (isset($booking)) {

            if ($booking->payment_method == 'offline_payment' && $booking->is_paid == 0 && in_array($request->booking_status, ['ongoing', 'completed'])) {
                if ($booking->booking_offline_payments->isEmpty()) {
                    return response()->json(response_formatter(UPDATE_FAILED_FOR_OFFLINE_PAYMENT_VERIFICATION_200), 200);
                }
                if ($booking->booking_offline_payments->isNotEmpty() && $booking->booking_offline_payments?->first()?->payment_status != 'approved') {
                    return response()->json(response_formatter(UPDATE_FAILED_FOR_OFFLINE_PAYMENT_VERIFICATION_200), 200);
                }
            }

            $evidence_photos = [];
            if ($request['booking_status'] == 'completed') {
                if (business_config('booking_otp', 'booking_setup')?->live_values == 1 && $booking->booking_otp != $request['booking_otp']) {
                    return response()->json(response_formatter(OTP_VERIFICATION_FAIL_403), 200);
                }

                if ($request->has('evidence_photos')) {
                    foreach ($request->evidence_photos as $image) {
                        $imageName = file_uploader('booking/evidence/', APPLICATION_IMAGE_FORMAT, $image);
                        $evidence_photos[] = ['image' => $imageName, 'storage' => getDisk()];
                    }
                }

                if ($booking->payment_method == 'offline_payment' && !$booking->is_paid) {
                    return response()->json(response_formatter(UPDATE_FAILED_FOR_OFFLINE_PAYMENT_VERIFICATION_200), 200);
                }
            }

            if ($booking->booking_status == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_CANCELED_200), 200);
            }

            if ($booking->booking_status == 'ongoing' && $request['booking_status'] == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_ONGOING), 200);
            }

            if ($booking->booking_status == 'completed' && $request['booking_status'] == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_COMPLETED), 200);
            }

            if ($booking->payment_method != 'cash_after_service' && $request['booking_status'] == 'canceled' && $booking->additional_charge > 0) {
                return response()->json(response_formatter(BOOKING_ALREADY_EDITED), 200);
            }

            $booking->booking_status = $request['booking_status'];
            $booking->evidence_photos = $evidence_photos;

            $bookingStatusHistory = $this->bookingStatusHistory;
            $bookingStatusHistory->booking_id = $bookingId;
            $bookingStatusHistory->changed_by = $request->user()->id;
            $bookingStatusHistory->booking_status = $request['booking_status'];

            if ($booking->isDirty('booking_status')) {
                DB::transaction(function () use ($bookingStatusHistory, $booking) {
                    $booking->save();
                    $bookingStatusHistory->save();
                });

                return response()->json(response_formatter(BOOKING_STATUS_UPDATE_SUCCESS_200, $booking), 200);
            }
            return response()->json(response_formatter(NO_CHANGES_FOUND), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function singleBookingStatusUpdate(Request $request, string $repeatId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_status' => 'required|in:' . implode(',', array_column(BOOKING_STATUSES, 'key')),
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->bookingRepeat->where('id', $repeatId)->where(function ($query) use ($request) {
            return $query->where('provider_id', $request->user()->provider->id)->orWhereNull('provider_id');
        })->first();

        if (isset($booking)) {
            $evidence_photos = [];
            if ($request['booking_status'] == 'completed') {
                if (business_config('booking_otp', 'booking_setup')?->live_values == 1 && $booking->booking_otp != $request['booking_otp']) {
                    return response()->json(response_formatter(OTP_VERIFICATION_FAIL_403), 200);
                }

                if ($request->has('evidence_photos')) {
                    foreach ($request->evidence_photos as $image) {
                        $imageName = file_uploader('booking/evidence/', APPLICATION_IMAGE_FORMAT, $image);
                        $evidence_photos[] = ['image' => $imageName, 'storage' => getDisk()];
                    }
                }
            }

            if ($booking->booking_status == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_CANCELED_200), 200);
            }

            if ($booking->booking_status == 'ongoing' && $request['booking_status'] == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_ONGOING), 200);
            }

            if ($booking->booking_status == 'completed' && $request['booking_status'] == 'canceled') {
                return response()->json(response_formatter(BOOKING_ALREADY_COMPLETED), 200);
            }

            if ($booking->payment_method != 'cash_after_service' && $request['booking_status'] == 'canceled' && $booking->additional_charge > 0) {
                return response()->json(response_formatter(BOOKING_ALREADY_EDITED), 200);
            }

            $booking->booking_status = $request['booking_status'];
            $booking->evidence_photos = $evidence_photos;

            $bookingStatusHistory = $this->bookingStatusHistory;
            $bookingStatusHistory->booking_id = $booking->booking_id;
            $bookingStatusHistory->booking_repeat_id = $repeatId;
            $bookingStatusHistory->changed_by = $request->user()->id;
            $bookingStatusHistory->booking_status = $request['booking_status'];

            if ($request['booking_status'] == 'canceled' && $booking->extra_fee > 0) {

                $repeats = $this->booking->where('id', $booking->booking_id)->first();
                $sortedRepeats = $repeats->repeat->sortBy(function ($repeat) {
                    $parts = explode('-', $repeat->readable_id);
                    $suffix = end($parts);
                    return $this->readableIdToNumber($suffix);
                });

                $repeats['repeats'] = $sortedRepeats->values()->toArray();

                $nextService = collect($repeats['repeats'])
                    ->where('booking_status', 'ongoing')
                    ->skip(1)
                    ->first();

                if (!$nextService) {
                    $nextService = collect($repeats['repeats'])
                        ->where('booking_status', 'accepted')
                        ->skip(1)
                        ->first();
                }

                if (!$nextService) {
                    $nextService = collect($repeats['repeats'])
                        ->where('booking_status', 'pending')
                        ->skip(1)
                        ->first();
                }

                if (isset($nextService)) {
                    $nextServiceId = $nextService['id'];
                    $nextServiceFee = $this->bookingRepeat->where('id', $nextServiceId)->first();
                    $nextServiceFee->extra_fee = $booking->extra_fee;
                    $nextServiceFee->total_booking_amount += $booking->extra_fee;
                    $nextServiceFee->save();

                    $booking->total_booking_amount -= $booking->extra_fee;
                    $booking->extra_fee = 0;
                }
            }

            if ($booking->isDirty('booking_status')) {
                DB::transaction(function () use ($bookingStatusHistory, $booking) {

                    $booking->save();
                    $bookingStatusHistory->save();

                    $fullBooking = $this->bookingRepeat->where('booking_id', $booking->booking_id)->get();
                    $allInactive = $fullBooking->every(function ($repeat) {
                        return !in_array($repeat->booking_status, ['pending', 'accepted', 'ongoing']);
                    });

                    if ($allInactive) {
                        $booking->booking->booking_status = 'completed';
                        $booking->booking->is_paid = 1;
                        $booking->booking->save();
                    }

                    if (in_array($booking->booking_status, ['ongoing', 'completed', 'canceled'])) {
                        if ($booking->booking->booking_status != 'ongoing' && $booking->booking->booking_status != 'completed' && $booking->booking->booking_status != 'canceled') {
                            $booking->booking->booking_status = 'ongoing';
                            $booking->booking->save();
                        }
                    }
                });

                return response()->json(response_formatter(BOOKING_STATUS_UPDATE_SUCCESS_200, $booking), 200);
            }
            return response()->json(response_formatter(NO_CHANGES_FOUND), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function assignServiceman(Request $request, string $bookingId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'serviceman_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }
        if ($request->booking_type == 'repeat') {
            $booking = $this->bookingRepeat->where('id', $bookingId)->where('provider_id', $request->user()->provider->id)->first();
        } else {
            $booking = $this->booking->where('id', $bookingId)->where('provider_id', $request->user()->provider->id)->first();
        }

        if (isset($booking)) {
            $booking->serviceman_id = $request['serviceman_id'];
            $booking->save();
            return response()->json(response_formatter(SERVICEMAN_ASSIGN_SUCCESS_200, $booking), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function scheduleUpdate(Request $request, string $bookingId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'schedule' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->where('id', $bookingId)->where(function ($query) use ($request) {
            return $query->where('provider_id', $request->user()->provider->id);
        })->first();

        if (isset($booking)) {
            $booking->service_schedule = $request['schedule'];

            $bookingScheduleHistory = $this->bookingScheduleHistory;
            $bookingScheduleHistory->booking_id = $bookingId;
            $bookingScheduleHistory->booking_id = $bookingId;
            $bookingScheduleHistory->changed_by = $request->user()->id;
            $bookingScheduleHistory->booking_repeat_id = $request['schedule'];

            DB::transaction(function () use ($bookingScheduleHistory, $booking) {
                $booking->save();
                $bookingScheduleHistory->save();
            });

            return response()->json(response_formatter(SERVICE_SCHEDULE_UPDATE_200, $booking), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function notificationSend(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking
            ->with(['customer'])
            ->where('id', $request['booking_id'])
            ->where(function ($query) use ($request) {
                return $query->where('provider_id', $request->user()->provider->id);
            })
            ->first();

        $bookingRepeat = $this->bookingRepeat
            ->where('id', $request['booking_id'])
            ->where(function ($query) use ($request) {
                return $query->where('provider_id', $request->user()->provider->id);
            })
            ->first();

        if (!isset($booking)) {
            if ($bookingRepeat) {
                $fcmToken = $bookingRepeat?->booking?->customer?->fcm_token;
                $title = get_push_notification_message('otp', 'customer_notification', $bookingRepeat?->booking?->customer?->current_language_key) . ' ' . $bookingRepeat->booking_otp;

                if ($fcmToken) {
                    device_notification($fcmToken, $title, null, null, $bookingRepeat->id, 'booking', null, $bookingRepeat?->booking?->customer?->id, null, null, 'repeat');
                    return response()->json(response_formatter(NOTIFICATION_SEND_SUCCESSFULLY_200), 200);

                } else {
                    return response()->json(response_formatter(NOTIFICATION_SEND_FAILED_200), 200);
                }
            }
            return response()->json(response_formatter(DEFAULT_404), 404);
        }

        $fcmToken = $booking?->customer?->fcm_token;
        $title = get_push_notification_message('otp', 'customer_notification', $booking?->customer?->current_language_key) . ' ' . $booking->booking_otp;

        if ($fcmToken) {
            device_notification($fcmToken, $title, null, null, $booking->id, 'booking', null, $booking?->customer?->id);
            return response()->json(response_formatter(NOTIFICATION_SEND_SUCCESSFULLY_200), 200);

        } else {
            return response()->json(response_formatter(NOTIFICATION_SEND_FAILED_200), 200);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getServiceInfo(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'zone_id' => 'required|uuid',
            'service_info' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }


        $data = [];


        foreach (json_decode($request['service_info'], true) as $item) {
            $service = Service::active()
                ->where('id', $item['service_id'])
                ->with(['category.category_discount', 'category.campaign_discount', 'service_discount'])
                ->with(['variations' => fn($query) => $query->where('variant_key', $item['variant_key'])->where('zone_id', $request['zone_id'])])
                ->first();

            if (!isset($service)) return response()->json(response_formatter(DEFAULT_404, $data), 404);

            $quantity = $item['quantity'];
            $variationPrice = $service?->variations[0]?->price;

            $basicDiscount = basic_discount_calculation($service, $variationPrice * $quantity);
            $campaignDiscount = campaign_discount_calculation($service, $variationPrice * $quantity);
            $subTotal = round($variationPrice * $quantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;

            $tax = round((($variationPrice * $quantity - $applicableDiscount) * $service['tax']) / 100, 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $data[] = collect([
                'service_id' => $service->id,
                'service_name' => $service->name,
                'variant_key' => $service?->variations[0]?->variant_key,
                'quantity' => $item['quantity'],
                'service_cost' => $variationPrice,
                'total_discount_amount' => $basicDiscount + $campaignDiscount,
                'coupon_code' => null,
                'tax_amount' => round($tax, 2),
                'total_cost' => round($subTotal - $basicDiscount - $campaignDiscount + $tax, 2),
                'zone_id' => $request['zone_id']
            ]);
        }

        return response()->json(response_formatter(DEFAULT_200, $data), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateBooking(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|uuid',
            'service_info' => 'required',
            'payment_status' => 'nullable|in:0,1',
            'serviceman_id' => 'nullable',
            'booking_status' => 'nullable|in:' . implode(',', array_column(BOOKING_STATUSES, 'key')),
            'service_schedule' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking
            ->with('detail')
            ->where('id', $request['booking_id'])
            ->where(function ($query) use ($request) {
                return $query->where('provider_id', $request->user()->provider->id)->orWhereNull('provider_id');
            })->first();

        if (!is_null($request['payment_status'])) $booking->is_paid = $request['payment_status'];
        if (!is_null($request['serviceman_id'])) $booking->serviceman_id = $request['serviceman_id'];
        if (!is_null($request['booking_status'])) $booking->booking_status = $request['booking_status'];
        if (!is_null($request['service_schedule'])) $booking->service_schedule = $request['service_schedule'];
        $booking->save();

        $providerEditAccess = (boolean)business_config('provider_can_edit_booking', 'provider_config')?->live_values;
        $request['service_info'] = collect(json_decode($request['service_info'], true));
        $serviceInfoValidated = $request['service_info']?->first()['quantity'] ?? null;

        if ($providerEditAccess && $serviceInfoValidated) {
            $existingServices = $this->bookingDetail->where('booking_id', $request['booking_id'])->get();
            foreach ($existingServices as $item) {
                if (!$request['service_info']->where('service_id', $item->service_id)->where('variant_key', $item->variant_key)->first()) {
                    $request['service_info']->push([
                        'service_id' => $item->service_id,
                        'variant_key' => $item->variant_key,
                        'quantity' => 0,
                    ]);
                }
            }


            foreach ($request['service_info'] as $key => $item) {
                $existingService = $this->bookingDetail
                    ->where('booking_id', $request['booking_id'])
                    ->where('service_id', $item['service_id'])
                    ->where('variant_key', $item['variant_key'])
                    ->first();

                if (!$existingService) {
                    $request['service_id'] = $item['service_id'];
                    $request['variant_key'] = $item['variant_key'];
                    $request['quantity'] = $item['quantity'];
                    $this->addNewBookingService($request);

                } else if ($existingService && $item['quantity'] == 0) {
                    $request['service_id'] = $item['service_id'];
                    $request['variant_key'] = $item['variant_key'];
                    $request['quantity'] = $item['quantity'];

                    $this->remove_service_from_booking($request);

                } else if ($existingService && $existingService->quantity < $item['quantity']) {
                    $request['service_id'] = $item['service_id'];
                    $request['variant_key'] = $item['variant_key'];
                    $request['old_quantity'] = $existingService->quantity;
                    $request['new_quantity'] = (int)$item['quantity'];
                    $this->increase_service_quantity_from_booking($request);

                } else if ($existingService && $existingService->quantity > $item['quantity']) {
                    $request['service_id'] = $item['service_id'];
                    $request['variant_key'] = $item['variant_key'];
                    $request['old_quantity'] = $existingService->quantity;
                    $request['new_quantity'] = (int)$item['quantity'];

                    $this->decrease_service_quantity_from_booking($request);

                }
            }
        }
        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateBookingRepeat(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|uuid',
            'booking_repeat_id' => 'nullable',
            'service_info' => 'required',
            'payment_status' => 'nullable|in:0,1',
            'serviceman_id' => 'nullable',
            'booking_status' => 'nullable|in:' . implode(',', array_column(BOOKING_STATUSES, 'key')),
            'service_schedule' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        if (empty($request->input('booking_repeat_id'))) {
            $findRepeatId = $this->booking->with('repeat')->where('id', $request->input('booking_id'))->first();

            if ($findRepeatId && $findRepeatId->repeat->isNotEmpty()) {
                $sortedRepeats = $findRepeatId->repeat->sortBy('readable_id');

                $repeatId = $sortedRepeats->firstWhere('booking_status', 'ongoing')?->id;

                if (!$repeatId) {
                    $repeatId = $sortedRepeats->firstWhere('booking_status', 'accepted')?->id;
                }

                $request->merge(['booking_repeat_id' => $repeatId]);
            }
        }

        $booking = $this->bookingRepeat
            ->with('detail')
            ->where('id', $request['booking_repeat_id'])
            ->where(function ($query) use ($request) {
                return $query->where('provider_id', $request->user()->provider->id)->orWhereNull('provider_id');
            })->first();

        if (!is_null($request['payment_status'])) $booking->is_paid = $request['payment_status'];
        if (!is_null($request['serviceman_id'])) $booking->serviceman_id = $request['serviceman_id'];
        if (!is_null($request['booking_status'])) $booking->booking_status = $request['booking_status'];
        if (!is_null($request['service_schedule'])) $booking->service_schedule = $request['service_schedule'];
        $booking->save();

        $providerEditAccess = (boolean)business_config('provider_can_edit_booking', 'provider_config')?->live_values;
        $request['service_info'] = collect(json_decode($request['service_info'], true));
        $serviceInfoValidated = $request['service_info']?->first()['quantity'] ?? null;

        if ($providerEditAccess && $serviceInfoValidated) {
            $totalOldQuantity = 0;
            $totalNewQuantity = 0;
            $updateQuantity = [];

            foreach ($request['service_info'] as $key => $item) {
                $existingService = $this->bookingRepeatDetail
                    ->where('booking_repeat_id', $request['booking_repeat_id'])
                    ->where('service_id', $item['service_id'])
                    ->where('variant_key', $item['variant_key'])
                    ->first();

                if ($existingService) {
                    $totalOldQuantity += $existingService->quantity;

                    if ($existingService->quantity < $item['quantity']) {
                        $request['service_id'] = $item['service_id'];
                        $request['variant_key'] = $item['variant_key'];
                        $request['old_quantity'] = $existingService->quantity;
                        $request['new_quantity'] = (int)$item['quantity'];

                        $this->increase_service_quantity_from_booking_repeat($request);
                    } else if ($existingService->quantity > $item['quantity']) {
                        $request['service_id'] = $item['service_id'];
                        $request['variant_key'] = $item['variant_key'];
                        $request['old_quantity'] = $existingService->quantity;
                        $request['new_quantity'] = (int)$item['quantity'];

                        $this->decrease_service_quantity_from_booking_repeat($request);
                    }

                    $totalNewQuantity += (int)$item['quantity'];
                    $updateQuantity[] = [
                        'service_id' => $item['service_id'],
                        'quantity' => (int)$item['quantity'],
                        'variant_key' => $item['variant_key'],
                        'service_name' => $existingService->service_name,
                        'service_cost' => $existingService->service_cost,
                    ];
                }
            }

            if ($request['next_all_booking_change'] == 1) {
                $mainBooking = $this->booking->where('id', $request['booking_id'])->first();
                $sourceRepeatBooking = $this->bookingRepeat->where('id', $request['booking_repeat_id'])->first();
                $serviceFee = 0;

                if (Str::endsWith($sourceRepeatBooking->readable_id, '-A') && !Str::endsWith($sourceRepeatBooking->readable_id, '-AA')) {
                    $serviceFee = $sourceRepeatBooking->extra_fee;
                }

                $targetRepeatBookings = $this->bookingRepeat
                    ->where('booking_id', $request['booking_id'])
                    ->whereIn('booking_status', ['accepted', 'ongoing'])
                    ->where('id', '!=', $sourceRepeatBooking ? $sourceRepeatBooking->id : null)
                    ->orderBy('readable_id')
                    ->get();

                if ($sourceRepeatBooking) {

                    $targetRepeatBookingsWithSource = new Collection($targetRepeatBookings->toArray());

                    $targetRepeatBookingsWithSource->push($sourceRepeatBooking);
                    $sortedReadableIds = $targetRepeatBookingsWithSource->pluck('readable_id')->sort()->values();
                    $minReadableId = $sortedReadableIds->first();
                    $maxReadableId = $sortedReadableIds->last();

                    if ($totalOldQuantity != $totalNewQuantity) {
                        foreach ($updateQuantity as $key => $update) {
                            $existService = $this->bookingRepeatDetail
                                ->where('booking_repeat_id', $request['booking_repeat_id'])
                                ->where('service_id', $update['service_id'])
                                ->first();

                            if ($existService) {
                                $updateQuantity[$key]['discount_amount'] = $existService->discount_amount;
                                $updateQuantity[$key]['tax_amount'] = $existService->tax_amount;
                                $updateQuantity[$key]['total_cost'] = $existService->total_cost;
                                $updateQuantity[$key]['repeat_details_id'] = $existService->id;
                            }
                        }
                        $bookingRepeatHistory = $this->bookingRepeatHistory;
                        $bookingRepeatHistory->booking_id = $request['booking_id'];
                        $bookingRepeatHistory->booking_repeat_id = $request['booking_repeat_id'];
                        $bookingRepeatHistory->old_quantity = $totalOldQuantity;
                        $bookingRepeatHistory->new_quantity = $totalNewQuantity;
                        $bookingRepeatHistory->is_multiple = $request['next_all_booking_change'] ? 1 : 0;
                        $bookingRepeatHistory->readable_id = "$minReadableId - $maxReadableId";
                        $bookingRepeatHistory->log_details = json_encode($updateQuantity);
                        $bookingRepeatHistory->total_booking_amount = $sourceRepeatBooking->total_booking_amount - $serviceFee;
                        $bookingRepeatHistory->total_tax_amount = $sourceRepeatBooking->total_tax_amount;
                        $bookingRepeatHistory->total_discount_amount = $sourceRepeatBooking->total_discount_amount;
                        $bookingRepeatHistory->extra_fee = $sourceRepeatBooking->extra_fee;
                        $bookingRepeatHistory->save();
                    }

                    foreach ($targetRepeatBookings as $targetBooking) {
                        $targetBooking->total_booking_amount = $sourceRepeatBooking->total_booking_amount - $serviceFee;
                        $targetBooking->total_tax_amount = $sourceRepeatBooking->total_tax_amount;
                        $targetBooking->total_discount_amount = $sourceRepeatBooking->total_discount_amount;
                        $targetBooking->total_campaign_discount_amount = $sourceRepeatBooking->total_campaign_discount_amount;
                        $targetBooking->save();
                    }

                    foreach ($sourceRepeatBooking->detail as $sourceDetail) {
                        foreach ($targetRepeatBookings as $targetBooking) {
                            foreach ($targetBooking->detail as $targetDetail) {
                                $targetDetail->quantity = $sourceDetail->quantity;
                                $targetDetail->tax_amount = $sourceDetail->tax_amount;
                                $targetDetail->total_cost = $sourceDetail->total_cost;
                                $targetDetail->discount_amount = $sourceDetail->discount_amount;
                                $targetDetail->campaign_discount_amount = $sourceDetail->campaign_discount_amount;
                                $targetDetail->overall_coupon_discount_amount = 0;
                                $targetDetail->save();
                            }
                        }
                    }

                    foreach ($sourceRepeatBooking->details_amounts as $sourceAmount) {
                        foreach ($targetRepeatBookings as $targetBooking) {
                            foreach ($targetBooking->details_amounts as $targetAmount) {
                                $targetAmount->service_quantity = $sourceAmount->service_quantity;
                                $targetAmount->service_tax = $sourceAmount->service_tax;
                                $targetAmount->coupon_discount_by_admin = 0;
                                $targetAmount->coupon_discount_by_provider = 0;
                                $targetAmount->discount_by_admin = $sourceAmount->discount_by_admin;
                                $targetAmount->discount_by_provider = $sourceAmount->discount_by_provider;
                                $targetAmount->campaign_discount_by_admin = $sourceAmount->campaign_discount_by_admin;
                                $targetAmount->campaign_discount_by_provider = $sourceAmount->campaign_discount_by_provider;
                                $targetAmount->save();
                            }
                        }
                    }
                }


                $mainBooking->total_booking_amount = $targetRepeatBookings->sum('total_booking_amount') + $sourceRepeatBooking->total_booking_amount;
                $mainBooking->total_tax_amount = $targetRepeatBookings->sum('total_tax_amount') + $sourceRepeatBooking->total_tax_amount;
                $mainBooking->total_discount_amount = $targetRepeatBookings->sum('total_discount_amount') + $sourceRepeatBooking->total_discount_amount;
                $mainBooking->total_campaign_discount_amount = $targetRepeatBookings->sum('total_campaign_discount_amount') + $sourceRepeatBooking->total_campaign_discount_amount;
                $mainBooking->save();

            } else {
                $mainBooking = $this->booking->where('id', $request['booking_id'])->first();
                $sourceRepeatBooking = $this->bookingRepeat->where('id', $request['booking_repeat_id'])->first();
                $repeatBooking = $this->bookingRepeat->where('booking_id', $request['booking_id'])->get();

                $mainBooking->total_booking_amount = $repeatBooking->sum('total_booking_amount');
                $mainBooking->total_tax_amount = $repeatBooking->sum('total_tax_amount');
                $mainBooking->total_discount_amount = $repeatBooking->sum('total_discount_amount');
                $mainBooking->total_campaign_discount_amount = $repeatBooking->sum('total_campaign_discount_amount');
                $mainBooking->save();

                if ($totalOldQuantity != $totalNewQuantity) {
                    foreach ($updateQuantity as $key => $update) {
                        $existService = $this->bookingRepeatDetail
                            ->where('booking_repeat_id', $request['booking_repeat_id'])
                            ->where('service_id', $update['service_id'])
                            ->first();

                        if ($existService) {
                            $updateQuantity[$key]['discount_amount'] = $existService->discount_amount;
                            $updateQuantity[$key]['tax_amount'] = $existService->tax_amount;
                            $updateQuantity[$key]['total_cost'] = $existService->total_cost;
                            $updateQuantity[$key]['repeat_details_id'] = $existService->id;
                        }
                    }

                    $bookingRepeatHistory = $this->bookingRepeatHistory;
                    $bookingRepeatHistory->booking_id = $request['booking_id'];
                    $bookingRepeatHistory->booking_repeat_id = $request['booking_repeat_id'];
                    $bookingRepeatHistory->old_quantity = $totalOldQuantity;
                    $bookingRepeatHistory->new_quantity = $totalNewQuantity;
                    $bookingRepeatHistory->is_multiple = $request['next_all_booking_change'] ? 1 : 0;
                    $bookingRepeatHistory->readable_id = $booking->readable_id;
                    $bookingRepeatHistory->log_details = json_encode($updateQuantity);
                    $bookingRepeatHistory->total_booking_amount = $sourceRepeatBooking->total_booking_amount;
                    $bookingRepeatHistory->total_tax_amount = $sourceRepeatBooking->total_tax_amount;
                    $bookingRepeatHistory->total_discount_amount = $sourceRepeatBooking->total_discount_amount;
                    $bookingRepeatHistory->extra_fee = $sourceRepeatBooking->extra_fee;
                    $bookingRepeatHistory->save();
                }
            }
        }
        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeService(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|uuid',
            'service_id' => 'required|uuid',
            'variant_key' => 'required',
            'zone_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->with('detail')
            ->where('id', $request['booking_id'])
            ->where(fn($query) => $query->where('provider_id', $request->user()->provider->id)->orWhereNull('provider_id'))
            ->first();

        if ($booking?->detail->count() < 2) {
            return response()->json(response_formatter(DEFAULT_400), 400);
        }

        $this->remove_service_from_booking($request);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    public function changeServiceLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|uuid',
            'booking_repeat_id' => 'nullable|uuid',
            'service_location' => 'required|in:provider,customer',
            'service_address' => 'required_if:service_location,customer',
            'next_all_booking_change' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        // Fetch the main booking
        $booking = $this->booking->find($request->booking_id);

        if (!$booking) {
            return response()->json(response_formatter(DEFAULT_400, null, [['error_code' => 'data', 'message' => translate('Booking not found')]]), 400);
        }

        $serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'provider_config'))->live_values ?? 0);

        if ($serviceAtProviderPlace == 0 && $request->service_location == 'provider') {
            return response()->json(response_formatter(DEFAULT_400, null, [['error_code' => 'data', 'message' => translate('Cannot switch to provider when provider service location is off')]]), 400);
        }

        if ($request->service_location == 'customer') {
            $serviceAddress = json_decode($request->service_address, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $error = [[
                    "error_code" => "data",
                    "message" => translate('Invalid address format')
                ]];
                return response()->json(response_formatter(DEFAULT_400, null, $error), 400);
            }

            $updateData = [
                'service_location' => 'customer',
                'service_address_location' => $serviceAddress
            ];
        } else {
            $updateData = [
                'service_location' => 'provider',
            ];
        }

        // If `booking_repeat_id` is provided, update the repeat booking
        if (!empty($request->booking_repeat_id)) {
            $repeatBooking = $this->bookingRepeat->find($request->booking_repeat_id);
            if ($repeatBooking) {
                $repeatBooking->update($updateData);
            }
        }

        $booking->update($updateData);

        if ($request->next_all_booking_change == 1) {
            $this->bookingRepeat
                ->where('booking_id', $booking->id)
                ->whereIn('booking_status', ['accepted', 'ongoing'])
                ->where('id', '!=', $booking->id)
                ->update($updateData);
        } else {
            if ($booking->repeat->isNotEmpty()) {
                $sortedRepeats = $booking->repeat->sortBy(function ($repeat) {
                    $parts = explode('-', $repeat->readable_id);
                    $suffix = end($parts);
                    return $this->readableIdToNumber($suffix);
                });

                // Keep original collection for update
                $booking['repeats'] = $sortedRepeats->values()->toArray();

                // Work with the original model collection
                $sortedModelRepeats = $sortedRepeats->values();

                $nextService = $sortedModelRepeats->firstWhere('booking_status', 'ongoing')
                    ?? $sortedModelRepeats->firstWhere('booking_status', 'accepted')
                    ?? $sortedModelRepeats->firstWhere('booking_status', 'pending');

                if ($nextService) {
                    $nextService->update($updateData);
                }
            }
        }

        $user = $booking?->customer;
        $repeatOrRegular = $booking?->is_repeated ? 'repeat' : 'regular';
        if (isset($user) && $user?->fcm_token && $user?->is_active) {
            try {
                device_notification($user?->fcm_token, translate('service location updated'), null, null, $booking->id, 'booking', null, null, null, null, $repeatOrRegular);
            } catch (\Exception $exception) {
                //
            }
        }

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

}
