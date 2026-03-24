<?php

namespace Modules\BookingModule\Http\Controllers\Api\V1\Serviceman;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\BookingModule\Entities\Booking;
use Modules\BookingModule\Entities\BookingDetail;
use Modules\BookingModule\Entities\BookingRepeat;
use Modules\BookingModule\Entities\BookingRepeatDetails;
use Modules\BookingModule\Entities\BookingRepeatHistory;
use Modules\BookingModule\Entities\BookingScheduleHistory;
use Modules\BookingModule\Entities\BookingStatusHistory;
use Modules\BookingModule\Http\Traits\BookingTrait;
use Modules\ServiceManagement\Entities\Service;

class BookingController extends Controller
{

    private Booking $booking;
    private BookingStatusHistory $bookingStatusHistory;
    private BookingDetail $bookingDetail;
    private BookingRepeat $bookingRepeat;
    private BookingRepeatDetails $bookingRepeatDetail;
    private BookingRepeatHistory $bookingRepeatHistory;

    use BookingTrait;

    public function __construct(Booking $booking, BookingStatusHistory $bookingStatusHistory, BookingDetail $bookingDetail, BookingRepeat $bookingRepeat, BookingRepeatDetails $bookingRepeatDetail, BookingRepeatHistory $bookingRepeatHistory)
    {
        $this->booking = $booking;
        $this->bookingStatusHistory = $bookingStatusHistory;
        $this->bookingDetail = $bookingDetail;
        $this->bookingRepeat = $bookingRepeat;
        $this->bookingRepeatDetail = $bookingRepeatDetail;
        $this->bookingRepeatHistory = $bookingRepeatHistory;
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
            'booking_status' => 'required|in:all,' . implode(',', array_column(BOOKING_STATUSES, 'key')),
            'booking_otp' => ((business_config('booking_otp', 'booking_setup'))->live_values == 1 && $request->booking_status == 'completed') ? 'required' : 'nullable',
            'evidence_photos' => 'nullable|array',
            'evidence_photos.*' => 'image|max:'. uploadMaxFileSizeInKB('image') .'|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key')),
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->where('id', $bookingId)->where(['serviceman_id' => $request->user()->serviceman->id])->first();
        $bookingStatus = $request->booking_status;

        if (isset($booking)) {

            if ($booking->payment_method == 'offline_payment' && $booking->is_paid == 0 && in_array($request->booking_status, ['ongoing', 'completed'])) {
                if ($booking->booking_offline_payments->isEmpty()) {
                    return response()->json(response_formatter(UPDATE_FAILED_FOR_OFFLINE_PAYMENT_VERIFICATION_200), 200);
                }
                if ($booking->booking_offline_payments->isNotEmpty() && $booking->booking_offline_payments?->first()?->payment_status != 'approved'){
                    return response()->json(response_formatter(UPDATE_FAILED_FOR_OFFLINE_PAYMENT_VERIFICATION_200), 200);
                }
            }

            $evidencePhotos = [];
            if ($bookingStatus == 'completed' && (business_config('booking_otp', 'booking_setup'))?->live_values == 1) {
                if ($booking->booking_otp != $request['booking_otp']) {
                    return response()->json(response_formatter(OTP_VERIFICATION_FAIL_403), 200);
                }
            }

            if ($bookingStatus == 'completed' && (business_config('service_complete_photo_evidence', 'booking_setup'))?->live_values == 1) {
                if ($request->has('evidence_photos')) {
                    foreach ($request->evidence_photos as $image) {
                        $imageName = file_uploader('booking/evidence/', APPLICATION_IMAGE_FORMAT, $image);
                        $evidencePhotos[] = ['image'=>$imageName, 'storage'=> getDisk()];
                    }
                }
            }

            if($booking->payment_method != 'cash_after_service' && $request['booking_status'] == 'canceled' && $booking->additional_charge > 0){
                return response()->json(response_formatter(BOOKING_ALREADY_EDITED), 200);
            }

            $booking->booking_status = $request['booking_status'];
            $booking->evidence_photos = $evidencePhotos;

            $bookingStatusHistory = $this->bookingStatusHistory;
            $bookingStatusHistory->booking_id = $bookingId;
            $bookingStatusHistory->changed_by = $request->user()->id;
            $bookingStatusHistory->booking_status = $request['booking_status'];

            DB::transaction(function () use ($bookingStatusHistory, $booking) {
                $booking->save();
                $bookingStatusHistory->save();
            });

            return response()->json(response_formatter(BOOKING_STATUS_UPDATE_SUCCESS_200, $booking), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }
    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function singleBookingStatusUpdate(Request $request, string $bookingId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_status' => 'required|in:all,' . implode(',', array_column(BOOKING_STATUSES, 'key')),
            'booking_otp' => ((business_config('booking_otp', 'booking_setup'))->live_values == 1 && $request->booking_status == 'completed') ? 'required' : 'nullable',
            'evidence_photos' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->bookingRepeat->where('id', $bookingId)->where(['serviceman_id' => $request->user()->serviceman->id])->first();
        $bookingStatus = $request->booking_status;

        if (isset($booking)) {

            $evidencePhotos = [];
            if ($bookingStatus == 'completed' && (business_config('booking_otp', 'booking_setup'))?->live_values == 1) {
                if ($booking->booking_otp != $request['booking_otp']) {
                    return response()->json(response_formatter(OTP_VERIFICATION_FAIL_403), 200);
                }
            }

            if ($bookingStatus == 'completed' && (business_config('service_complete_photo_evidence', 'booking_setup'))?->live_values == 1) {
                if ($request->has('evidence_photos')) {
                    foreach ($request->evidence_photos as $image) {
                        $imageName = file_uploader('booking/evidence/', APPLICATION_IMAGE_FORMAT, $image);
                        $evidencePhotos[] = ['image'=>$imageName, 'storage'=> getDisk()];
                    }
                }
            }

            $booking->booking_status = $request['booking_status'];
            $booking->evidence_photos = $evidencePhotos;

            $bookingStatusHistory = $this->bookingStatusHistory;
            $bookingStatusHistory->booking_id = 0;
            $bookingStatusHistory->changed_by = $request->user()->id;
            $bookingStatusHistory->booking_status = $request['booking_status'];
            $bookingStatusHistory->booking_repeat_id = $bookingId;

            if ($request['booking_status'] == 'canceled' && $booking->extra_fee > 0){

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

                if (isset($nextService)){
                    $nextServiceId = $nextService['id'];
                    $nextServiceFee = $this->bookingRepeat->where('id', $nextServiceId)->first();
                    $nextServiceFee->extra_fee = $booking->extra_fee;
                    $nextServiceFee->total_booking_amount += $booking->extra_fee;
                    $nextServiceFee->save();

                    $booking->total_booking_amount -= $booking->extra_fee;
                    $booking->extra_fee = 0;
                }
            }

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
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Show the specified resource.
     * @param Request $request
     * @param string $bookingId
     * @return JsonResponse
     */
    public function paymentStatusUpdate(Request $request, string $bookingId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'payment_status' => 'required|in:paid,unpaid'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $booking = $this->booking->where('id', $bookingId)->where(['serviceman_id' => $request->user()->serviceman->id])->first();
        if (isset($booking)) {
            $booking->is_paid = $request['payment_status'] == 'paid' ? 1 : 0;
            $booking->save();
            return response()->json(response_formatter(PAYMENT_STATUS_UPDATE_SUCCESS_200, $booking), 200);
        }

        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function bookingDetails(Request $request, string $id): JsonResponse
    {
        $booking = $this->booking->with([
            'detail.service', 'schedule_histories.user', 'status_histories.user', 'customer', 'provider', 'zone', 'serviceman.user', 'booking_partial_payments'
        ])->where(function ($query) use ($request) {
            return $query->where('serviceman_id', $request->user()->serviceman->id)->orWhereNull('provider_id');
        })->where(['id' => $id])->first();

        if (isset($booking)) {
            $booking->service_address = $booking->service_address_location != null ? json_decode($booking->service_address_location) : $booking->service_address;

            $offlinePayment = $booking->booking_offline_payments?->first()?->customer_information;
            unset($booking->booking_offline_payments);

            if ($offlinePayment) {
                $booking->booking_offline_payment = collect($offlinePayment)->map(function ($value, $key) {
                    return ["key" => $key, "value" => $value];
                })->values()->all();
            }

            return response()->json(response_formatter(DEFAULT_200, [
                'booking' => $booking,
                'provider_serviceman_can_cancel_booking' => (int)provider_config('provider_serviceman_can_cancel_booking', 'serviceman_config', $booking->provider_id)?->live_values,
                'provider_serviceman_can_edit_booking' => (int)provider_config('provider_serviceman_can_edit_booking', 'serviceman_config', $booking->provider_id)?->live_values,
            ]), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function singleBookingDetails(Request $request, string $id): JsonResponse
    {
        $booking = $this->bookingRepeat->with([
            'detail.service', 'scheduleHistories.user', 'statusHistories.user', 'booking.service_address', 'booking.customer', 'booking.provider', 'serviceman.user'
        ])->where(function ($query) use ($request) {
            return $query->where('serviceman_id', $request->user()->serviceman->id)->orWhereNull('provider_id');
        })->where(['id' => $id])->first();

        if (isset($booking)) {
            return response()->json(response_formatter(DEFAULT_200, [
                'booking' => $booking,
                'provider_serviceman_can_cancel_booking' => (int)provider_config('provider_serviceman_can_cancel_booking', 'serviceman_config', $booking->provider_id)?->live_values,
                'provider_serviceman_can_edit_booking' => (int)provider_config('provider_serviceman_can_edit_booking', 'serviceman_config', $booking->provider_id)?->live_values,
            ]), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function bookingList(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'booking_status' => 'required|in:all,' . implode(',', array_column(BOOKING_STATUSES, 'key')),
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicemanId = auth('api')->user()->serviceman->id;

        $bookings = $this->booking->with(['subCategory:id,name', 'repeat'])
            ->where(function ($query) use ($servicemanId) {
                $query->where('serviceman_id', $servicemanId)
                    ->orWhereHas('repeat', function ($subQuery) use ($servicemanId) {
                        $subQuery->where('serviceman_id', $servicemanId);
                    });
            })
            ->when($request['booking_status'] != 'all', function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('booking_status', $request['booking_status'])
                        ->orWhereHas('repeat', function ($repeatQuery) use ($request) {
                            $repeatQuery->where('booking_status', $request['booking_status']);
                        });
                });
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])
            ->withPath('');

            foreach ($bookings as $booking) {
                if ($booking->repeat->isNotEmpty()) {
                    $filteredRepeats = $booking->repeat->where('serviceman_id', $servicemanId)->sortBy('readable_id');
                    $booking->repeats = $filteredRepeats->values()->toArray();
                }
                unset($booking->repeat);
            }

        return response()->json(response_formatter(DEFAULT_200, $bookings), 200);

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
                return $query->where('serviceman_id', $request->user()->serviceman->id);
            })
            ->first();

        $bookingRepeat = $this->bookingRepeat
            ->where('id', $request['booking_id'])
            ->where(function ($query) use ($request) {
                return $query->where('serviceman_id', $request->user()->serviceman->id);
            })
            ->first();

        if (!isset($booking)) {
            if ($bookingRepeat){
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
        $title = translate('Your booking verification OTP is') . ' ' . $booking->booking_otp;

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
            ->where('serviceman_id', $request->user()->serviceman->id)
            ->first();

        if (!is_null($request['payment_status'])) $booking->is_paid = $request['payment_status'];
        if (!is_null($request['serviceman_id'])) $booking->serviceman_id = $request['serviceman_id'];
        if (!is_null($request['booking_status'])) $booking->booking_status = $request['booking_status'];
        if (!is_null($request['service_schedule'])) $booking->service_schedule = $request['service_schedule'];
        $booking->save();

        $editAccess = (boolean)provider_config('provider_serviceman_can_edit_booking', 'serviceman_config', $booking->provider_id)?->live_values;
        $request['service_info'] = collect(json_decode($request['service_info'], true));
        $serviceInfoValidated = $request['service_info']?->first()['quantity'] ?? null;

        if ($editAccess && $serviceInfoValidated) {
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
                return $query->where('serviceman_id', $request->user()->serviceman->id);
            })->first();

        if (!is_null($request['payment_status'])) $booking->is_paid = $request['payment_status'];
        if (!is_null($request['serviceman_id'])) $booking->serviceman_id = $request['serviceman_id'];
        if (!is_null($request['booking_status'])) $booking->booking_status = $request['booking_status'];
        if (!is_null($request['service_schedule'])) $booking->service_schedule = $request['service_schedule'];
        $booking->save();

        $editAccess = (boolean)provider_config('provider_serviceman_can_edit_booking', 'serviceman_config', $booking->provider_id)?->live_values;
        $request['service_info'] = collect(json_decode($request['service_info'], true));
        $serviceInfoValidated = $request['service_info']?->first()['quantity'] ?? null;

        if ($editAccess && $serviceInfoValidated) {
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

            if ($request['next_all_booking_change'] == 1){
                $mainBooking = $this->booking->where('id', $request['booking_id'])->first();
                $sourceRepeatBooking = $this->bookingRepeat->where('id', $request['booking_repeat_id'])->first();

                $targetRepeatBookings = $this->bookingRepeat
                    ->where('booking_id', $request['booking_id'])
                    ->whereIn('booking_status', ['accepted', 'ongoing'])
                    ->where('id', '!=', $sourceRepeatBooking ? $sourceRepeatBooking->id : null)
                    ->orderBy('readable_id')
                    ->get();

                if ($sourceRepeatBooking) {

                    $sortedReadableIds = $targetRepeatBookings->pluck('readable_id')->sort()->values();
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
                        $bookingRepeatHistory->total_booking_amount = $sourceRepeatBooking->total_booking_amount;
                        $bookingRepeatHistory->total_tax_amount = $sourceRepeatBooking->total_tax_amount;
                        $bookingRepeatHistory->total_discount_amount = $sourceRepeatBooking->total_discount_amount;
                        $bookingRepeatHistory->extra_fee = $sourceRepeatBooking->extra_fee;
                        $bookingRepeatHistory->save();
                    }

                    foreach ($targetRepeatBookings as $targetBooking) {
                        $targetBooking->total_booking_amount = $sourceRepeatBooking->total_booking_amount;
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


                $mainBooking->total_booking_amount = $targetRepeatBookings->sum('total_booking_amount');
                $mainBooking->total_tax_amount = $targetRepeatBookings->sum('total_tax_amount');
                $mainBooking->total_discount_amount = $targetRepeatBookings->sum('total_discount_amount');
                $mainBooking->total_campaign_discount_amount = $targetRepeatBookings->sum('total_campaign_discount_amount');
                $mainBooking->save();

            }else{
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
            ->where(fn($query) => $query->where('serviceman_id', $request->user()->serviceman->id)->orWhereNull('serviceman_id'))
            ->first();

        if ($booking?->detail->count() < 2) {
            return response()->json(response_formatter(DEFAULT_400), 400);
        }

        $this->remove_service_from_booking($request);

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }
}
