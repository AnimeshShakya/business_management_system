<?php

use Illuminate\Support\Facades\Route;
use Modules\PromotionManagement\Http\Controllers\Web\Admin\DiscountController;
use Modules\PromotionManagement\Http\Controllers\Web\Admin\CouponController;
use Modules\PromotionManagement\Http\Controllers\Web\Admin\CampaignController;
use Modules\PromotionManagement\Http\Controllers\Web\Admin\AdvertisementsController;
use Modules\PromotionManagement\Http\Controllers\Web\Admin\BannerController;
use Modules\PromotionManagement\Http\Controllers\Web\Admin\PushNotificationController;
use Modules\PromotionManagement\Http\Controllers\Web\Provider\AdvertisementsController as ProviderAdvertisementsController;



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {

    Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
        Route::any('create', [DiscountController::class, 'create'])->name('create');
        Route::any('list', [DiscountController::class, 'index'])->name('list');
        Route::post('store', [DiscountController::class, 'store'])->name('store');
        Route::get('edit/{id}', [DiscountController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [DiscountController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [DiscountController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [DiscountController::class, 'destroy'])->name('delete');
        Route::any('download', [DiscountController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function () {
        Route::any('create', [CouponController::class, 'create'])->name('create');
        Route::any('list', [CouponController::class, 'index'])->name('list');
        Route::post('store', [CouponController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CouponController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CouponController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [CouponController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [CouponController::class, 'destroy'])->name('delete');
        Route::any('download', [CouponController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'campaign', 'as' => 'campaign.'], function () {
        Route::any('create', [CampaignController::class, 'create'])->name('create');
        Route::any('list', [CampaignController::class, 'index'])->name('list');
        Route::post('store', [CampaignController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CampaignController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CampaignController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [CampaignController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [CampaignController::class, 'destroy'])->name('delete');
        Route::any('download', [CampaignController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'advertisements', 'as' => 'advertisements.'], function () {
        Route::get('ads-create', [AdvertisementsController::class, 'AdsCreate'])->name('ads-create');
        Route::get('ads-list', [AdvertisementsController::class, 'AdsList'])->name('ads-list');
        Route::post('ads-store', [AdvertisementsController::class, 'AdsStore'])->name('ads-store');
        Route::get('new-ads-request', [AdvertisementsController::class, 'newAdsRequest'])->name('new-ads-request');
        Route::get('details/{id}', [AdvertisementsController::class, 'details'])->name('details');
        Route::delete('delete/{id}', [AdvertisementsController::class, 'destroy'])->name('delete');
        Route::any('status-update/{id}/{type}', [AdvertisementsController::class, 'statusUpdate'])->name('status-update');
        Route::any('download', [AdvertisementsController::class, 'download'])->name('download');
        Route::get('payment-update/{id}', [AdvertisementsController::class, 'paymentUpdate'])->name('payment-update');
        Route::get('dates-update/{id}', [AdvertisementsController::class, 'datesUpdate'])->name('dates-update');
        Route::any('set-priority/{id}', [AdvertisementsController::class, 'setPriority'])->name('set-priority');
        Route::get('edit/{id}', [AdvertisementsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [AdvertisementsController::class, 'update'])->name('update');
        Route::get('re-submit/{id}', [AdvertisementsController::class, 'reSubmit'])->name('re-submit');
        Route::post('store-re-submit/{id}', [AdvertisementsController::class, 'storeReSubmit'])->name('store-re-submit');
    });

    Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
        Route::any('create', [BannerController::class, 'create'])->name('create');
        Route::post('store', [BannerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BannerController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [BannerController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [BannerController::class, 'destroy'])->name('delete');
        Route::any('download', [BannerController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'push-notification', 'as' => 'push-notification.'], function () {
        Route::any('create', [PushNotificationController::class, 'create'])->name('create');
        Route::post('store', [PushNotificationController::class, 'store'])->name('store');
        Route::get('edit/{id}', [PushNotificationController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [PushNotificationController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [PushNotificationController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [PushNotificationController::class, 'destroy'])->name('delete');
        Route::any('download', [PushNotificationController::class, 'download'])->name('download');
        Route::get('resend/{id}', [PushNotificationController::class, 'resendNotification'])->name('resend');
    });

});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider']], function () {

    Route::group(['prefix' => 'advertisements', 'as' => 'advertisements.', 'middleware' => 'subscription:advertisement'], function () {
        Route::any('ads-create', [ProviderAdvertisementsController::class, 'AdsCreate'])->name('ads-create');
        Route::any('ads-list', [ProviderAdvertisementsController::class, 'AdsList'])->name('ads-list');
        Route::post('ads-store', [ProviderAdvertisementsController::class, 'AdsStore'])->name('ads-store');
        Route::any('download', [ProviderAdvertisementsController::class, 'download'])->name('download');
        Route::get('details/{id}', [ProviderAdvertisementsController::class, 'details'])->name('details');
        Route::get('edit/{id}', [ProviderAdvertisementsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProviderAdvertisementsController::class, 'update'])->name('update');
        Route::any('status-update/{id}/{type}', [ProviderAdvertisementsController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [ProviderAdvertisementsController::class, 'destroy'])->name('delete');
        Route::get('re-submit/{id}', [ProviderAdvertisementsController::class, 'reSubmit'])->name('re-submit');
        Route::post('store-re-submit/{id}', [ProviderAdvertisementsController::class, 'storeReSubmit'])->name('store-re-submit');
    });

});

