<?php

use Illuminate\Support\Facades\Route;
use Modules\BookingModule\Http\Controllers\Web\Admin\BookingController;
use Modules\BookingModule\Http\Controllers\Web\Provider\BookingController as ProviderBookingController;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::any('list', [BookingController::class, 'index'])->name('list');
        Route::any('list/verification', [BookingController::class, 'bookingVerificationList'])->name('list.verification');
        Route::any('list/verification/download', [BookingController::class, 'downloadBookingVerificationList'])->name('list.verification.download');
        Route::any('list/offline-payment', [BookingController::class, 'bookingOfflinePaymentList'])->name('offline.payment');
        Route::get('check', [BookingController::class, 'checkBooking'])->name('check');
        Route::get('details/{id}', [BookingController::class, 'details'])->name('details');
        Route::get('repeat-details/{id}', [BookingController::class, 'repeatDetails'])->name('repeat_details');
        Route::get('repeat-single-details/{id}', [BookingController::class, 'repeatSingleDetails'])->name('repeat_single_details');
        Route::get('status-update/{id}', [BookingController::class, 'statusUpdate'])->name('status_update');
        Route::get('up-coming-booking-cancel/{id}', [BookingController::class, 'upComingBookingCancel'])->name('up_coming_booking_cancel');
        Route::get('verification-status-update/{id}', [BookingController::class, 'verificationUpdate'])->name('verification_status_update');
        Route::post('verification-status/{id}', [BookingController::class, 'verificationStatus'])->name('verification-status');
        Route::get('payment-update/{id}', [BookingController::class, 'paymentUpdate'])->name('payment_update');
        Route::any('schedule-update/{id}', [BookingController::class, 'scheduleUpdate'])->name('schedule_update');
        Route::any('up-coming-booking-schedule-update/{id}', [BookingController::class, 'upComingBookingScheduleUpdate'])->name('up_coming_booking_schedule_update');
        Route::put('serviceman-update/{id}', [BookingController::class, 'servicemanUpdate'])->name('serviceman_update');
        Route::post('service-address-update/{id}', [BookingController::class, 'serviceAddressUpdate'])->name('service_address_update');
        Route::any('download', [BookingController::class, 'download'])->name('download');
        Route::any('invoice/{id}', [BookingController::class, 'invoice'])->name('invoice');
        Route::any('single-repeat-invoice/{id}', [BookingController::class, 'fullBookingSingleInvoice'])->name('single_invoice');
        Route::any('full-repeat-invoice/{id}', [BookingController::class, 'fullBookingInvoice'])->name('full_repeat_invoice');
        Route::any('customer-fullbooking-single-invoice/{id}/{lang}', [BookingController::class, 'customerFullBookingSingleInvoice'])->withoutMiddleware('admin');
        Route::any('customer-fullbooking-invoice/{id}/{lang}', [BookingController::class, 'customerFullBookingInvoice'])->withoutMiddleware('admin');
        Route::any('provider-fullbooking-single-invoice/{id}/{lang}', [BookingController::class, 'providerFullBookingSingleInvoice'])->withoutMiddleware('admin');
        Route::any('provider-fullbooking-invoice/{id}/{lang}', [BookingController::class, 'providerFullBookingInvoice'])->withoutMiddleware('admin');
        Route::any('serviceman-fullbooking-single-invoice/{id}/{lang}', [BookingController::class, 'servicemanFullBookingSingleInvoice'])->withoutMiddleware('admin');
        Route::any('customer-invoice/{id}/{lang}', [BookingController::class, 'customerInvoice'])->withoutMiddleware('admin');
        Route::any('provider-invoice/{id}/{lang}', [BookingController::class, 'providerInvoice'])->withoutMiddleware('admin');
        Route::any('serviceman-invoice/{id}/{lang}', [BookingController::class, 'servicemanInvoice'])->withoutMiddleware('admin');

        Route::any('switch-payment-method/{id}', [BookingController::class, 'switchPaymentMethod'])->name('switch-payment-method');
        Route::any('offline-payment/verify', [BookingController::class, 'verifyOfflinePayment'])->name('offline-payment.verify');

        Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
            Route::put('update-booking-service', [BookingController::class, 'updateBookingService'])->name('update_booking_service');
            Route::put('update-repeat-booking-service', [BookingController::class, 'updateRepeatBookingService'])->name('update_repeat_booking_service');
            Route::get('ajax-get-service-info', [BookingController::class, 'ajaxGetServiceInfo'])->name('ajax-get-service-info');
            Route::get('ajax-get-variation', [BookingController::class, 'ajaxGetVariant'])->name('ajax-get-variant');
        });

        Route::get('rebooking/details/{id}', [BookingController::class, 'reBookingDetails'])->name('rebooking.details');
        Route::get('rebooking/ongoing/{id}', [BookingController::class, 'reBookingOngoing'])->name('rebooking.ongoing');

        Route::post('change-service-location/{id}', [BookingController::class, 'changeServiceLocation'])->name('change-service-location');
        Route::post('repeat-change-service-location/{id}', [BookingController::class, 'repeatChangeServiceLocation'])->name('repeat.change-service-location');
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider']], function () {

    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::any('list', [ProviderBookingController::class, 'index'])->name('list');
        Route::get('check', [ProviderBookingController::class, 'checkBooking'])->name('check');
        Route::get('details/{id}', [ProviderBookingController::class, 'details'])->name('details');
        Route::get('repeat-details/{id}', [ProviderBookingController::class, 'repeatDetails'])->name('repeat_details');
        Route::get('repeat-single-details/{id}', [ProviderBookingController::class, 'repeatSingleDetails'])->name('repeat_single_details');
        Route::get('request-accept/{booking_id}', [ProviderBookingController::class, 'requestAccept'])->name('accept');
        Route::get('request-ignore/{booking_id}', [ProviderBookingController::class, 'requestIgnore'])->name('ignore');
        Route::any('status-update/{id}', [ProviderBookingController::class, 'statusUpdate'])->name('status_update');
        Route::any('payment-update/{id}', [ProviderBookingController::class, 'paymentUpdate'])->name('payment_update');
        Route::any('schedule-update/{id}', [ProviderBookingController::class, 'scheduleUpdate'])->name('schedule_update');
        Route::put('serviceman-update/{id}', [ProviderBookingController::class, 'servicemanUpdate'])->name('serviceman_update');
        Route::put('service-address-update/{id}', [BookingController::class, 'serviceAddressUpdate'])->name('service_address_update');
        Route::get('up-coming-booking-cancel/{id}', [ProviderBookingController::class, 'upComingBookingCancel'])->name('up_coming_booking_cancel');
        Route::any('up-coming-booking-schedule-update/{id}', [ProviderBookingController::class, 'upComingBookingScheduleUpdate'])->name('up_coming_booking_schedule_update');
        Route::any('download', [ProviderBookingController::class, 'download'])->name('download');
        Route::any('invoice/{id}', [ProviderBookingController::class, 'invoice'])->name('invoice');
        Route::any('single-repeat-invoice/{id}', [ProviderBookingController::class, 'fullBookingSingleInvoice'])->name('single_invoice');
        Route::any('full-repeat-invoice/{id}', [ProviderBookingController::class, 'fullBookingInvoice'])->name('full_repeat_invoice');
        Route::post('evidence-photos-upload/{id}', [ProviderBookingController::class, 'evidencePhotosUpload'])->name('evidence_photos_upload');
        Route::get('otp/resend', [ProviderBookingController::class, 'resendOtp'])->name('otp.resend');

        Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
            Route::put('update-booking-service', [ProviderBookingController::class, 'updateBookingService'])->name('update_booking_service');
            Route::put('update-repeat-booking-service', [ProviderBookingController::class, 'updateRepeatBookingService'])->name('update_repeat_booking_service');
            Route::get('ajax-get-service-info', [ProviderBookingController::class, 'ajaxGetServiceInfo'])->name('ajax-get-service-info');
            Route::get('ajax-get-variation', [ProviderBookingController::class, 'ajaxGetVariant'])->name('ajax-get-variant');
        });

        Route::post('change-service-location/{id}', [ProviderBookingController::class, 'changeServiceLocation'])->name('change-service-location');
        Route::post('repeat-change-service-location/{id}', [ProviderBookingController::class, 'repeatChangeServiceLocation'])->name('repeat.change-service-location');
        Route::get('calendar-view', [ProviderBookingController::class, 'calendarView'])->name('calendar.view');
        Route::get('calendar-events', [ProviderBookingController::class, 'calendarEvents'])->name('calendar.events');
        Route::get('calendar-events/bookings', [ProviderBookingController::class, 'getCalendarBookingList'])->name('calendar.events.bookings');
    });
});
