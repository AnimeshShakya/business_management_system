<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerModule\Http\Controllers\Api\V1\Customer\CustomerController;
use Modules\CustomerModule\Http\Controllers\Api\V1\Admin\CustomerController as AdminCustomerController;
use Modules\CustomerModule\Http\Controllers\Api\V1\Customer\SubscribeNewsletterController;
use Modules\CustomerModule\Http\Controllers\Api\V1\Customer\ConfigController;
use  Modules\CustomerModule\Http\Controllers\Api\V1\Customer\AddressController;


Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Api\V1\Admin','middleware'=>['auth:api']], function () {
//    Route::resource('customer', 'CustomerController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'customer', 'as' => 'customer.',], function () {
        Route::put('status/update', [AdminCustomerController::class, 'statusUpdate']);
        Route::delete('delete', [AdminCustomerController::class, 'destroy']);

        Route::group(['prefix' => 'data', 'as' => 'data.',], function () {
            Route::get('overview/{id}', [AdminCustomerController::class, 'overview']);
            Route::get('bookings/{id}', [AdminCustomerController::class, 'bookings']);
            Route::get('reviews/{id}', [AdminCustomerController::class, 'reviews']);

            Route::post('store-address', [AdminCustomerController::class, 'storeAddress']);
            Route::get('edit-address/{id}', [AdminCustomerController::class, 'editAddress']);
            Route::put('update-address/{id}', [AdminCustomerController::class, 'updateAddress']);
            Route::delete('delete/{id}', [AdminCustomerController::class, 'destroyAddress']);
        });

    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Api\V1\Customer'], function () {

    Route::post('fcm-subscribe-to-topic', [CustomerController::class, 'fcmSubscribeToTopic']);

    Route::group(['prefix' => 'config'], function () {
        Route::get('/', [ConfigController::class, 'configuration']);
        Route::get('pages', [ConfigController::class, 'pages']);
        Route::get('page-details/{key}', [ConfigController::class, 'pageDetails']);
        Route::get('get-zone-id', [ConfigController::class, 'getZone']);
        Route::get('place-api-autocomplete', [ConfigController::class, 'placeApiAutocomplete']);
        Route::get('distance-api', [ConfigController::class, 'distanceApi']);
        Route::get('place-api-details', [ConfigController::class, 'placeApiDetails']);
        Route::get('geocode-api', [ConfigController::class, 'geocodeApi']);
    });

    Route::resource('address', 'AddressController', ['only' => ['index', 'store', 'edit', 'update', 'destroy']])->withoutMiddleware(['api:auth']);

    Route::withoutMiddleware(['api:auth'])->group(function () {
        Route::get('/address', [AddressController::class, 'index']);
        Route::post('/address', [AddressController::class, 'store']);
        Route::get('/address/{address}/edit', [AddressController::class, 'edit']);
        Route::put('/address/{address}', [AddressController::class, 'update']);
        Route::delete('/address/{address}', [AddressController::class, 'destroy']);
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('info', [CustomerController::class, 'index']);
        Route::put('update/profile',[CustomerController::class, 'updateProfile']);
        Route::put('update/fcm-token',[CustomerController::class, 'updateFcmToken']);
        Route::delete('remove-account', [CustomerController::class, 'removeAccount']);

        Route::post('loyalty-point/wallet-transfer', [CustomerController::class, 'transferLoyaltyPointToWallet']);
        Route::get('wallet-transaction', [CustomerController::class, 'walletTransaction']);
        Route::get('loyalty-point-transaction', [CustomerController::class, 'loyaltyPointTransaction']);
    });

    Route::post('change-language', [CustomerController::class, 'changeLanguage']);
    Route::post('error-link', [CustomerController::class, 'errorLink']);

    Route::post('subscribe-newsletter', [SubscribeNewsletterController::class, 'subscribeNewsletter'])->name('subscribe-newsletter');

});

