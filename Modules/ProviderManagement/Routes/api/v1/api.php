<?php

use Illuminate\Support\Facades\Route;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Customer\FavoriteProviderController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Customer\ProviderController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\ConfigController as ProviderConfigController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\Report\BookingReportController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\Report\BusinessReportController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\Report\TransactionReportController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\TimeScheduleController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\ProviderController as ProviderProviderController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\ServiceController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\AccountController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Provider\WithdrawController;
use Modules\ProviderManagement\Http\Controllers\Api\V1\Admin\ProviderController as AdminProviderController;



Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Api\V1\Provider'], function () {
    Route::post('forgot-password', [ProviderProviderController::class, 'forgotPassword']);
    Route::post('otp-verification', [ProviderProviderController::class, 'otpVerification']);
    Route::put('reset-password', [ProviderProviderController::class, 'resetPassword']);
    Route::post('change-language', [ProviderProviderController::class, 'changeLanguage']);
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {
    Route::get('/', [ProviderProviderController::class, 'index']);
    Route::get('dashboard', [ProviderProviderController::class, 'dashboard']);
    Route::get('dashboard/earning', [ProviderProviderController::class, 'earningStatistics']);
    Route::get('get-bank-details', [ProviderProviderController::class, 'getBankDetails']);
    Route::put('update-bank-details', [ProviderProviderController::class, 'updateBankDetails']);

    Route::get('config', [ProviderConfigController::class, 'config'])->withoutMiddleware(['auth:api']);
    Route::get('config/page-details/{key}', [ProviderConfigController::class, 'pageDetails'])->withoutMiddleware('auth:api');

    Route::get('info', [ProviderProviderController::class, 'index']);
    Route::get('adjust', [ProviderProviderController::class, 'adjust']);
    Route::get('notifications', [ProviderProviderController::class, 'notifications']);
    Route::put('update/fcm-token', [ProviderProviderController::class, 'updateFcmToken']);
    Route::put('update/profile', [ProviderProviderController::class, 'updateProfile']);
    Route::put('update/password', [ProviderProviderController::class, 'updatePassword']);
    Route::post('update/tutorial', [ProviderProviderController::class, 'updateTutorial']);
    Route::get('config/get-routes', [ProviderConfigController::class, 'getRoutes']);
    Route::delete('delete', [ProviderProviderController::class, 'deleteProvider']);
    Route::get('transaction', [ProviderProviderController::class, 'transaction']);
    Route::get('subscribed/sub-categories', [ProviderProviderController::class, 'subscribedSubCategories']);

    Route::group(['prefix' => 'service', 'as' => 'service.',], function () {
        Route::post('update-subscription', [ServiceController::class, 'updateSubscription']);
    });

    Route::group(['prefix' => 'account', 'as' => 'account.',], function () {
        Route::get('overview', [AccountController::class, 'overview']);
        Route::get('account-edit', [AccountController::class, 'accountEdit']);
        Route::put('account-update', [AccountController::class, 'accountUpdate']);
        Route::get('commission-info', [AccountController::class, 'commissionInfo']);
    });

//    Route::resource('withdraw', 'WithdrawController', ['only' => ['index', 'store']]);
    Route::get('/withdraw', [WithdrawController::class, 'index']);
    Route::post('/withdraw', [WithdrawController::class, 'store']);

    Route::group(['prefix' => 'payment-information', 'as' => 'payment-information.'], function () {
        Route::get('index', [WithdrawController::class, 'paymentInformationIndex'])->name('index');
        Route::post('store', [WithdrawController::class, 'paymentInformationStore'])->name('store');
        Route::get('edit/{id}', [WithdrawController::class, 'paymentInformationEdit'])->name('edit');
        Route::post('update/{id}', [WithdrawController::class, 'paymentInformationUpdate'])->name('update');
        Route::get('status-update/{id}', [WithdrawController::class, 'paymentInformationStatusUpdate'])->name('status-update');
        Route::get('default-status-update/{id}', [WithdrawController::class, 'paymentInformationDefaultStatusUpdate'])->name('default-status-update');
        Route::delete('delete/{id}', [WithdrawController::class, 'paymentInformationDelete'])->name('delete');
    });

    Route::get('review', [ProviderProviderController::class, 'review']);

    Route::get('available-time-schedule', [TimeScheduleController::class, 'getAvailableTimeSchedule']);
    Route::put('available-time-schedule', [TimeScheduleController::class, 'setAvailableTimeSchedule']);

    //REPORT
    Route::group(['prefix' => 'report', 'namespace' => 'Report'], function () {
        //Transaction Report
        Route::post('transaction', [TransactionReportController::class, 'getTransactionReport']);
        Route::post('transaction/download', [TransactionReportController::class, 'downloadTransactionReport']);

        //Booking Report
        Route::post('booking', [BookingReportController::class, 'getBookingReport']);
        Route::post('booking/download', [BookingReportController::class, 'getBookingReportDownload']);

        //Business Report
        Route::group(['prefix' => 'business', 'as' => 'business.'], function () {
            Route::post('overview', [BusinessReportController::class, 'getBusinessOverviewReport']);
            Route::post('earning', [BusinessReportController::class, 'getBusinessEarningReport']);
            Route::post('expense', [BusinessReportController::class, 'getBusinessExpenseReport']);
        });
    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Api\V1\Customer'], function () {
    Route::group(['prefix' => 'provider', 'as' => 'provider.'], function () {
        Route::post('list', [ProviderController::class, 'getProviderList']);
        Route::get('list-by-sub-category', [ProviderController::class, 'getProviderListBySubCategory']);
    });

    Route::group(['prefix' => 'favorite', 'as' => 'favorite.', 'middleware' => ['auth:api']], function () {
        Route::get('provider-list', [FavoriteProviderController::class, 'list']);
        Route::post('provider', [FavoriteProviderController::class, 'store']);
        Route::post('provider-destroy/{provider_id}', [FavoriteProviderController::class, 'destroy']);
    });

    Route::get('provider-details', [ProviderController::class, 'getProviderDetails']);

    Route::post('available-provider', [ProviderController::class, 'getAvailableProvider']);
    Route::post('available-service', [ProviderController::class, 'getAvailableService']);
    Route::post('rebooking-information', [ProviderController::class, 'rebookingInformation']);
});

//admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
   // Route::resource('provider', 'ProviderController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'provider', 'as' => 'provider.',], function () {
        Route::get('data/overview/{user_id}', [AdminProviderController::class, 'overview']);
        Route::put('settings/update/{provider_id}', [AdminProviderController::class, 'settingsUpdate']);

        Route::put('status/update', [AdminProviderController::class, 'statusUpdate']);
        Route::delete('delete', [AdminProviderController::class, 'destroy']);
        Route::delete('remove-image', [AdminProviderController::class, 'removeImage']);

        Route::get('data/reviews/{provider_id}', [AdminProviderController::class, 'reviews']);
        Route::get('data/requests', [AdminProviderController::class, 'providerRequest']);
        Route::get('data/requests/search', [AdminProviderController::class, 'searchRequest']);
        Route::get('data/serviceman/list/{provider_id}', [AdminProviderController::class, 'servicemanList']);

        Route::get('data/bookings/{provider_id}', [AdminProviderController::class, 'bookings']);
        Route::get('subscribed/sub-categories/{provider_id}', [AdminProviderController::class, 'subscribedSubCategories']);
        Route::put('update-subscription/sub-categories/{provider_id}', [AdminProviderController::class, 'updateSubscription']);
    });
});
