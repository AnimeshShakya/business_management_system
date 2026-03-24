<?php

use Illuminate\Support\Facades\Route;
use Modules\BusinessSettingsModule\Http\Controllers\Api\V1\Admin\ConfigurationController as AdminConfigurationController;
use Modules\BusinessSettingsModule\Http\Controllers\Api\V1\Admin\BusinessInformationController as AdminBusinessInformationController;
use Modules\BusinessSettingsModule\Http\Controllers\Api\V1\Provider\BusinessInformationController as ProviderBusinessInformationController;
use Modules\BusinessSettingsModule\Http\Controllers\Api\V1\Provider\ConfigurationController;
use Modules\BusinessSettingsModule\Http\Controllers\Api\V1\Provider\SubscriptionPackageController;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'business-settings'], function () {
        Route::get('get-business-information', [AdminBusinessInformationController::class, 'business_information_get']);
        Route::put('set-business-information', [AdminBusinessInformationController::class, 'business_information_set']);

        Route::get('get-service-setup', [AdminBusinessInformationController::class, 'service_setup_get']);
        Route::put('set-service-setup', [AdminBusinessInformationController::class, 'service_setup_set']);

        Route::get('get-pages-setup', [AdminBusinessInformationController::class, 'pages_setup_get']);
        Route::put('set-pages-setup', [AdminBusinessInformationController::class, 'pages_setup_set']);

        Route::get('get-notification-setting', [AdminConfigurationController::class, 'notification_settings_get']);
        Route::put('set-notification-setting', [AdminConfigurationController::class, 'notification_settings_set']);

        Route::get('get-email-config', [AdminConfigurationController::class, 'email_config_get']);
        Route::put('set-email-config', [AdminConfigurationController::class, 'email_config_set']);

        Route::get('get-third-party-config', [AdminConfigurationController::class, 'third_party_config_get']);
        Route::put('set-third-party-config', [AdminConfigurationController::class, 'third_party_config_set']);
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'business-settings'], function () {
        Route::get('get-business-settings', [ProviderBusinessInformationController::class, 'businessSettingsGet']);
        Route::put('set-business-settings', [ProviderBusinessInformationController::class, 'businessSettingsSet']);
    });
    Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function () {
        Route::get('transactions',  [SubscriptionPackageController::class, 'transactions']);

        Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
            Route::get('list',  [SubscriptionPackageController::class, 'index'])->withoutMiddleware('auth:api');
            Route::get('subscriber-details',  [SubscriptionPackageController::class, 'subscriber']);
            Route::post('renew',  [SubscriptionPackageController::class, 'renew']);
            Route::post('shift',  [SubscriptionPackageController::class, 'shift']);
            Route::post('purchase',  [SubscriptionPackageController::class, 'purchase']);
            Route::post('commission',  [SubscriptionPackageController::class, 'commission']);
            Route::post('cancel',  [SubscriptionPackageController::class, 'cancel']);
        });
    });

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function () {
        Route::get('get-notification-setting',  [ConfigurationController::class, 'notificationSettingsGet']);
        Route::post('update-notification-status',  [ConfigurationController::class, 'updateStatus']);
    });
});
