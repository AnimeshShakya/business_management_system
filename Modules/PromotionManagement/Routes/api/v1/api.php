<?php

use Illuminate\Support\Facades\Route;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Customer\CouponController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Admin\DiscountController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Admin\CouponController as AdminCouponController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Admin\CampaignController as AdminCampaignController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Admin\BannerController as AdminBannerController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Admin\PushNotificationController as AdminPushNotificationController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Customer\BannerController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Customer\CampaignController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Customer\AdvertisementsController;
use Modules\PromotionManagement\Http\Controllers\Api\V1\Provider\AdvertisementsController as ProviderAdvertisementsController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Route::resource('discount', 'DiscountController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'discount', 'as' => 'discount.',], function () {
        Route::put('status/update', [DiscountController::class, 'statusUpdate']);
        Route::delete('delete', [DiscountController::class, 'destroy']);
    });

//    Route::resource('coupon', 'CouponController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'coupon', 'as' => 'coupon.',], function () {
        Route::get('config', [AdminCouponController::class, 'config']);
        Route::put('status/update', [AdminCouponController::class, 'statusUpdate']);
        Route::delete('delete', [AdminCouponController::class, 'destroy']);
    });

//    Route::resource('campaign', 'CampaignController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'campaign', 'as' => 'campaign.',], function () {
        Route::put('status/update', [AdminCampaignController::class, 'statusUpdate']);
        Route::delete('delete', [AdminCampaignController::class, 'destroy']);
    });

//    Route::resource('banner', 'BannerController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'banner', 'as' => 'banner.',], function () {
        Route::put('status/update', [AdminBannerController::class, 'statusUpdate']);
        Route::delete('delete', [AdminBannerController::class, 'destroy']);
    });

//    Route::resource('push-notification', 'PushNotificationController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::group(['prefix' => 'push-notification', 'as' => 'push-notification.',], function () {
        Route::put('status/update', [AdminPushNotificationController::class, 'statusUpdate']);
        Route::delete('delete', [AdminPushNotificationController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Api\V1\Customer'], function () {
    Route::group(['prefix' => 'banner', 'as' => 'banner.',], function () {
        Route::get('/', [BannerController::class, 'index']);
    });

    Route::group(['prefix' => 'notification', 'as' => 'notification.',], function () {
        Route::get('/', 'NotificationController@index');
    });

//    Route::resource('coupon', 'CouponController', ['only' => ['index']]);
    Route::prefix('coupon')->as('coupon.')->group(function () {
        Route::get('/', [CouponController::class, 'index']);
        Route::get('remove', [CouponController::class, 'removeCoupon']);
        Route::post('apply', [CouponController::class, 'applyCoupon']);
        Route::get('applicable', [CouponController::class, 'applicable']);
    });

//    Route::resource('campaign', 'CampaignController', ['only' => ['index']]);
    Route::group(['prefix' => 'campaign', 'as' => 'campaign.', 'middleware' => ['auth:api']], function () {
        Route::get('/', [CampaignController::class, 'index'])->withoutMiddleware('auth:api');
        Route::get('data/items', [CampaignController::class, 'campaignItems'])->withoutMiddleware('auth:api');
    });

    Route::group(['prefix' => 'advertisements', 'as' => 'advertisements.'], function () {
        Route::get('ads-list', [AdvertisementsController::class, 'AdsList']);
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'advertisements', 'as' => 'advertisements.'], function () {
        Route::get('ads-list', [ProviderAdvertisementsController::class, 'AdsList']);
        Route::post('ads-store', [ProviderAdvertisementsController::class, 'AdsStore']);
        Route::get('details/{id}', [ProviderAdvertisementsController::class, 'details']);
        Route::get('edit/{id}', [ProviderAdvertisementsController::class, 'edit']);
        Route::put('update/{id}', [ProviderAdvertisementsController::class, 'update']);
        Route::any('status-update/{id}/{type}', [ProviderAdvertisementsController::class, 'statusUpdate']);
        Route::delete('delete/{id}', [ProviderAdvertisementsController::class, 'destroy']);
        Route::post('store-re-submit/{id}', [ProviderAdvertisementsController::class, 'storeReSubmit']);
    });
});
