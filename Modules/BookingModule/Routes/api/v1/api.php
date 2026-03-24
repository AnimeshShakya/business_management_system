<?php

use Illuminate\Support\Facades\Route;
use Modules\BookingModule\Http\Controllers\Api\V1\Customer\BookingController;
use Modules\BookingModule\Http\Controllers\Api\V1\Provider\BookingController as ProviderBookingController;
use Modules\BookingModule\Http\Controllers\Api\V1\Serviceman\BookingController as ServicemanBookingController;
use Modules\BookingModule\Http\Controllers\Api\V1\Admin\BookingController as AdminBookingController;

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Api\V1\Customer', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::get('/{booking_id}', [BookingController::class, 'show']);
        Route::get('single/{booking_id}', [BookingController::class, 'singleDetails']);
        Route::post('request/send', [BookingController::class, 'placeRequest'])->middleware('hitLimiter')->withoutMiddleware('auth:api');
        Route::put('status-update/{booking_id}', [BookingController::class, 'statusUpdate']);
        Route::post('single-repeat-cancel/{repeat_id}', [BookingController::class, 'singleBookingCancel']);
        Route::post('track/{readable_id}', [BookingController::class, 'track'])->withoutMiddleware('auth:api');
        Route::post('store-offline-payment-data', [BookingController::class, 'storeOfflinePaymentData'])->withoutMiddleware('auth:api');
        Route::post('switch-payment-method', [BookingController::class, 'switchPaymentMethod'])->withoutMiddleware('auth:api');
    });
});
Route::any('digital-payment-booking-response', [BookingController::class, 'digitalPaymentBookingResponse']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::post('/', [AdminBookingController::class, 'index']);
        Route::get('{id}', [AdminBookingController::class, 'show']);
        Route::put('status-update/{booking_id}', [AdminBookingController::class, 'status_update']);
        Route::put('schedule-update/{booking_id}', [AdminBookingController::class, 'schedule_update']);
        Route::get('data/download', [AdminBookingController::class, 'download']);
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::post('/', [ProviderBookingController::class, 'index']);
        Route::get('{id}', [ProviderBookingController::class, 'show']);
        Route::get('single/{id}', [ProviderBookingController::class, 'singleDetails']);
        Route::put('request-accept/{booking_id}', [ProviderBookingController::class, 'requestAccept']);
        Route::post('request-ignore/{booking_id}', [ProviderBookingController::class, 'requestIgnore']);
        Route::post('single-repeat-cancel/{repeat_id}', [ProviderBookingController::class, 'singleBookingCancel']);
        Route::put('single-repeat-status-update/{repeat_id}', [ProviderBookingController::class, 'singleBookingStatusUpdate']);
        Route::put('status-update/{booking_id}', [ProviderBookingController::class, 'statusUpdate']);
        Route::put('schedule-update/{booking_id}', [ProviderBookingController::class, 'scheduleUpdate']);
        Route::put('assign-serviceman/{booking_id}', [ProviderBookingController::class, 'assignServiceman']);
        Route::get('data/download', [ProviderBookingController::class, 'download']);
        Route::get('opt/notification-send', [ProviderBookingController::class, 'notificationSend']);
        Route::get('service/info', [ProviderBookingController::class, 'getServiceInfo']);
        Route::put('service/edit/update-booking', [ProviderBookingController::class, 'updateBooking']);
        Route::put('repeat/service/edit/update-booking', [ProviderBookingController::class, 'updateBookingRepeat']);
        Route::put('service/edit/remove-service', [ProviderBookingController::class, 'removeService']);
        Route::post('change-service-location', [ProviderBookingController::class, 'changeServiceLocation']);
        Route::get('calendar/view', [ProviderBookingController::class, 'bookingCalendar']);

    });
});


Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.', 'namespace' => 'Api\V1\Serviceman', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::put('status-update/{booking_id}', [ServicemanBookingController::class, 'statusUpdate']);
        Route::put('single-repeat-status-update/{booking_id}', [ServicemanBookingController::class, 'singleBookingStatusUpdate']);
        Route::put('payment-status-update/{booking_id}', [ServicemanBookingController::class, 'paymentStatusUpdate']);
        Route::get('list', [ServicemanBookingController::class, 'bookingList']);
        Route::get('detail/{id}', [ServicemanBookingController::class, 'bookingDetails']);
        Route::get('single/detail/{id}', [ServicemanBookingController::class, 'singleBookingDetails']);
        Route::get('opt/notification-send', [ServicemanBookingController::class, 'notificationSend']);
        Route::get('service/info', [ServicemanBookingController::class, 'getServiceInfo']);
        Route::put('service/edit/update-booking', [ServicemanBookingController::class, 'updateBooking']);
        Route::put('repeat/service/edit/update-booking', [ServicemanBookingController::class, 'updateBookingRepeat']);
        Route::put('service/edit/remove-service', [ServicemanBookingController::class, 'removeService']);
    });
});
