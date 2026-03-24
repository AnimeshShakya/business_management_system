<?php

use Illuminate\Support\Facades\Route;
use Modules\ServicemanModule\Http\Controllers\Api\V1\Serviceman\ConfigController as ServicemanConfigController;
use Modules\ServicemanModule\Http\Controllers\Api\V1\Provider\ServicemanController as ServicemanProviderController;
use Modules\ServicemanModule\Http\Controllers\Api\V1\Serviceman\ServicemanController;

//provider routes
Route::group(['prefix' => 'provider', 'as' => 'provider', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {

    //serviceman
    Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.'], function () {
        Route::get('/', [ServicemanProviderController::class, 'index']);
        Route::post('/', [ServicemanProviderController::class, 'store']);
        Route::get('{id}/edit', [ServicemanProviderController::class, 'edit']);
        Route::put('{id}', [ServicemanProviderController::class, 'update']);
        Route::get('{id}', [ServicemanProviderController::class, 'show']);

        Route::delete('delete', [ServicemanProviderController::class, 'destroy']);
        Route::put('status/update', [ServicemanProviderController::class, 'changeActiveStatus']);
    });

});

//customer section
Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.', 'namespace' => 'Api\V1\Serviceman'], function () {

    Route::post('forgot-password', [ServicemanController::class, 'forgotPassword']);
    Route::post('otp-verification', [ServicemanController::class, 'otpVerification']);
    Route::put('reset-password', [ServicemanController::class, 'resetPassword']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('dashboard', [ServicemanController::class, 'dashboard']);
        Route::get('dashboard/booking-statistics', [ServicemanController::class, 'bookingStatistics']);

        Route::group(['prefix' => 'config'], function () {
            Route::get('/', [ServicemanConfigController::class, 'configuration'])->withoutMiddleware(['auth:api']);
            Route::get('page-details/{key}', [ServicemanConfigController::class, 'pageDetails'])->withoutMiddleware('auth:api');

            Route::get('get-zone-id', [ServicemanConfigController::class, 'getZone']);
            Route::get('place-api-autocomplete', [ServicemanConfigController::class, 'placeApiAutocomplete']);
            Route::get('distance-api', [ServicemanConfigController::class, 'distanceApi']);
            Route::get('place-api-details', [ServicemanConfigController::class, 'placeApiDetails']);
            Route::get('geocode-api', [ServicemanConfigController::class, 'geocodeApi']);
            Route::get('get-routes', [ServicemanConfigController::class, 'getRoutes']);
        });

        Route::get('info', [ServicemanController::class, 'index']);
        Route::put('update/profile', [ServicemanController::class, 'updateProfile']);
        Route::put('update/fcm-token', [ServicemanController::class, 'updateFcmToken']);
        Route::get('push-notifications', [ServicemanController::class, 'pushNotifications']);

        Route::group(['prefix' => 'profile', 'middleware' => ['auth:api']], function () {
            Route::put('info', [ServicemanController::class, 'profileInfo']);
            Route::put('change-password', [ServicemanController::class, 'changePassword']);
        });
    });

    Route::post('change-language', [ServicemanController::class, 'changeLanguage']);
});

