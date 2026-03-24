<?php

use Illuminate\Support\Facades\Route;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\BusinessInformationController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\LandingPageController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\CronJobController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\LanguageController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\SEOSettingController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\LoginSetupController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\SubscriptionPackageController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\SubscriptionSettingsController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\SubscriberController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\ConfigurationController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Admin\PageAndMediaController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Provider\BusinessInformationController as ProviderBusinessInformationController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Provider\SubscriptionPackageController as ProviderSubscriptionPackageController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Provider\ConfigurationController as ProviderConfigurationController;
use Modules\BusinessSettingsModule\Http\Controllers\Web\Provider\WithdrawPaymentInformationController;

Route::group(['namespace' => 'Api\V1\Admin'], function () {
    Route::get('file-manager', 'FileManagerController@index');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {

    Route::get('lang/{locale}', 'LanguageController@lang')->name('lang');

    Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.'], function () {
        Route::post('maintenance-mode-setup', [BusinessInformationController::class, 'maintenanceModeSetup'])->name('maintenance-mode-setup');
        Route::get('maintenance-mode-status-update', [BusinessInformationController::class, 'maintenanceModeStatusUpdate'])->name('maintenance-mode-status-update');
        Route::get('ajax-currency-change', [BusinessInformationController::class, 'ajaxCurrencyChange'])->name('ajax-currency-change');

        Route::get('get-business-information', [BusinessInformationController::class, 'businessInformationGet'])->name('get-business-information');
        Route::put('set-business-information', [BusinessInformationController::class, 'businessInformationSet'])->name('set-business-information');

        Route::put('set-bidding-system', [BusinessInformationController::class, 'setBiddingSystem'])->name('set-bidding-system');
        Route::put('update-action-status', [BusinessInformationController::class, 'updateActionStatus'])->name('update-action-status');
        Route::put('set-promotion-setup', [BusinessInformationController::class, 'promotionSetupSet'])->name('set-promotion-setup');
        Route::put('set-customer-setup', [BusinessInformationController::class, 'customerSetup'])->name('set-customer-setup');
        Route::put('set-provider-setup', [BusinessInformationController::class, 'providerSetup'])->name('set-provider-setup');
        Route::put('set-business-model-setup', [BusinessInformationController::class, 'businessModelSetup'])->name('set-business-model-setup');
        Route::put('set-service-setup', [BusinessInformationController::class, 'serviceSetup'])->name('set-service-setup');
        Route::put('set-servicemen', [BusinessInformationController::class, 'servicemen'])->name('set-servicemen');
        Route::put('set-booking-setup', [BusinessInformationController::class, 'bookingSetupSet'])->name('set-booking-setup');

        //Gallery
        Route::get('get-gallery-setup/{storage_path?}', [BusinessInformationController::class, 'gallerySetupGet'])->name('get-gallery-setup');
        Route::post('/image-upload', [BusinessInformationController::class, 'galleryImageUpload'])->name('upload-gallery-image');
        Route::get('/image-download/{file_name}', [BusinessInformationController::class, 'galleryImageDownload'])->name('download-gallery-image');
        Route::delete('/delete/{file_path}', [BusinessInformationController::class, 'galleryImageRemove'])->name('remove-gallery-image');
        Route::get('download/public', [BusinessInformationController::class, 'downloadPublicDirectory'])->name('download.public');

        //database backup
        Route::get('get-database-backup', [BusinessInformationController::class, 'getDatabaseBackup'])->name('get-database-backup');
        Route::get('backup-database-backup', [BusinessInformationController::class, 'backupDatabase'])->name('backup-database-backup');
        Route::get('delete-database-backup/{file_name}', [BusinessInformationController::class, 'deleteDatabaseBackup'])->where('file_name', '.*')->name('delete-database-backup');
        Route::get('restore-database-backup/{file_name}', [BusinessInformationController::class, 'restoreDatabaseBackup'])->name('restore-database-backup');
        Route::get('download-database-backup/{file_name}', [BusinessInformationController::class, 'download'])->name('download-database-backup');
        Route::post('database-backup/update-binary-path', [BusinessInformationController::class, 'updateBinaryPath'])->name('database-backup.update-binary-path');

        Route::get('get-landing-information', [LandingPageController::class, 'getLandingInformation'])->name('get-landing-information');
        Route::put('set-landing-information', [LandingPageController::class, 'setLandingInformation'])->name('set-landing-information');
        Route::put('set-landing-feature', [LandingPageController::class, 'setLandingFeature'])->name('set-landing-feature');
        Route::put('set-landing-speciality', [LandingPageController::class, 'setLandingSpeciality'])->name('set-landing-speciality');
        Route::put('set-landing-testimonial', [LandingPageController::class, 'setLandingTestimonial'])->name('set-landing-testimonial');
        Route::delete('delete-landing-information/{page}/{id}', [LandingPageController::class, 'deleteLandingInformation'])->name('delete-landing-information');
        Route::delete('delete-landing-feature/{id}', [LandingPageController::class, 'deleteLandingFeature'])->name('delete-landing-feature');
        Route::delete('delete-landing-speciality/{id}', [LandingPageController::class, 'deleteLandingSpeciality'])->name('delete-landing-speciality');
        Route::delete('delete-landing-testimonial/{id}', [LandingPageController::class, 'deleteLandingTestimonial'])->name('delete-landing-testimonial');

        //Cron job setting
        Route::group(['prefix' => 'cron-job', 'as' => 'cron-job.'], function () {
            Route::get('/', [CronJobController::class, 'index'])->name('list');
            Route::get('status/{id}', [CronJobController::class, 'status'])->name('status');
            Route::get('edit/{id}', [CronJobController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [CronJobController::class, 'update']);
        });

        //login setup & seo setting
        Route::group(['prefix' => 'seo-setting', 'as' => 'seo.'], function () {
            Route::get('/', [SEOSettingController::class, 'index'])->name('setting');
            Route::post('error-log-link/{id}', [SEOSettingController::class, 'redirectLink'])->name('error-log-link');
            Route::delete('error-log-destroy/{id}', [SEOSettingController::class, 'errorLogDestroy'])->name('error-log-destroy');
            Route::post('error-log-bulk-destroy', [SEOSettingController::class, 'bulkDelete'])->name('error-log-bulk-destroy');

        });
        Route::get('notification-channel', [BusinessInformationController::class, 'notificationChannel'])->name('notification-channel');
        Route::post('update-notification-status', [BusinessInformationController::class, 'updateStatus'])->name('updateNotificationStatus');

        Route::get('login/setup', [LoginSetupController::class, 'loginSetup'])->name('login.setup');
        Route::post('login-setup-update', [LoginSetupController::class, 'loginSetupUpdate'])->name('login-setup-update');
        Route::get('check-active-sms-gateway', [LoginSetupController::class, 'checkActiveSMSGateway'])->name('check-active-sms-gateway');
        Route::get('check-active-social-media', [LoginSetupController::class, 'checkActiveSocialMedia'])->name('check-active-social-media');
        Route::get('check-email-or-sms-configured', [LoginSetupController::class, 'checkEmailOrSMSConfigured'])->name('check-email-or-sms-configured');
        Route::post('set-otp-login-information', [LoginSetupController::class, 'otpLoginInformationSet'])->name('set-otp-login-information');

    });

    Route::group(['prefix' => 'business-page-setup', 'as' => 'business-page-setup.'], function () {
        Route::get('list', [PageAndMediaController::class, 'list'])->name('list');
        Route::get('index', [PageAndMediaController::class, 'index'])->name('index');
        Route::post('store', [PageAndMediaController::class, 'store'])->name('store');
        Route::get('view/{id}', [PageAndMediaController::class, 'view'])->name('view');
        Route::get('edit/{id}', [PageAndMediaController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PageAndMediaController::class, 'update'])->name('update');
        Route::post('status/{id}', [PageAndMediaController::class, 'changeStatus'])->name('status');
        Route::delete('delete/{id}', [PageAndMediaController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'social-media', 'as' => 'social-media.'], function () {
        Route::get('index', [PageAndMediaController::class, 'socialIndex'])->name('index');
        Route::post('store', [PageAndMediaController::class, 'socialStore'])->name('store');
        Route::delete('delete/{id}', [PageAndMediaController::class, 'socialDelete'])->name('delete');
        Route::post('update/{id}', [PageAndMediaController::class, 'socialUpdate'])->name('update');
        Route::any('status/{id}', [PageAndMediaController::class, 'socialStatus'])->name('status');
    });

    Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
        Route::post('store', [LanguageController::class, 'store'])->name('store');
        Route::get('update-status', [LanguageController::class, 'updateStatus'])->name('update-status');
        Route::get('update-default-status', [LanguageController::class, 'updateDefaultStatus'])->name('update-default-status');
        Route::post('update', [LanguageController::class, 'update'])->name('update');
        Route::get('translate/{lang}', [LanguageController::class, 'translate'])->name('translate');
        Route::post('translate-submit/{lang}', [LanguageController::class, 'translateSubmit'])->name('translate-submit');
        Route::post('remove-key/{lang}', [LanguageController::class, 'translateKeyRemove'])->name('remove-key');
        Route::delete('delete/{lang}', [LanguageController::class, 'delete'])->name('delete');
        Route::any('auto-translate/{lang}', [LanguageController::class, 'autoTranslate'])->name('auto-translate');
        Route::any('auto-translate-all/{lang}', [LanguageController::class, 'autoTranslateAll'])->name('auto-translate-all');

    });

    Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function () {
        Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
            Route::get('list', [SubscriptionPackageController::class, 'index'])->name('list');
            Route::get('create', [SubscriptionPackageController::class, 'create'])->name('create');
            Route::post('create', [SubscriptionPackageController::class, 'store']);
            Route::get('update/{id}', [SubscriptionPackageController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [SubscriptionPackageController::class, 'update']);
            Route::get('details/{id}', [SubscriptionPackageController::class, 'details'])->name('details');
            Route::any('status-update/{id}', [SubscriptionPackageController::class, 'statusUpdate'])->name('status-update');
            Route::post('change-subscription', [SubscriptionPackageController::class, 'changeSubscription'])->name('change-subscription');
            Route::post('subscription-to-commission', [SubscriptionPackageController::class, 'subscriptionToCommission'])->name('subscription-to-commission');
            Route::post('commission-to-subscription', [SubscriptionPackageController::class, 'commissionToSubscription'])->name('commission-to-subscription');
            Route::any('download', [SubscriptionPackageController::class, 'download'])->name('download');
            Route::any('transactions', [SubscriptionPackageController::class, 'transactions'])->name('transactions');
            Route::get('transactions/download', [SubscriptionPackageController::class, 'transactionsDownload'])->name('transactions.download');
            Route::get('transactions/invoice/{id}', [SubscriptionPackageController::class, 'invoice'])->name('transactions.invoice');
            Route::get('invoice/{id}/{lang}', [SubscriptionPackageController::class, 'subscriptionInvoice'])->withoutMiddleware('admin');
        });

        Route::get('settings', [SubscriptionSettingsController::class, 'settings'])->name('settings');
        Route::post('settings', [SubscriptionSettingsController::class, 'settingsStore']);

        Route::group(['prefix' => 'subscriber', 'as' => 'subscriber.'], function () {
            Route::get('list', [SubscriberController::class, 'index'])->name('list');
            Route::get('details/{id}', [SubscriberController::class, 'details'])->name('details');
            Route::post('cancel', [SubscriberController::class, 'cancel'])->name('cancel');
            Route::any('download', [SubscriberController::class, 'download'])->name('download');
            Route::any('transactions', [SubscriberController::class, 'transactions'])->name('transactions');
            Route::get('transactions/download', [SubscriberController::class, 'transactionsDownload'])->name('transactions.download');
            Route::get('transactions/invoice/{id}', [SubscriberController::class, 'invoice'])->name('transactions.invoice');
        });
    });

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function () {
        Route::get('get-notification-setting', [ConfigurationController::class, 'notificationSettingsGet'])->name('get-notification-setting');
        Route::put('set-notification-setting', [ConfigurationController::class, 'notificationSettingsSet'])->name('set-notification-setting');
        Route::any('set-message-setting', [ConfigurationController::class, 'messageSettingsSet'])->name('set-message-setting');

        Route::get('get-email-config', [ConfigurationController::class, 'emailConfigGet'])->name('get-email-config');
        Route::put('set-email-config', [ConfigurationController::class, 'emailConfigSet'])->name('set-email-config');
        Route::get('test-send-email', [ConfigurationController::class, 'sendMail'])->name('send-mail');

        Route::get('get-third-party-config', [ConfigurationController::class, 'thirdPartyConfigGet'])->name('get-third-party-config');
        Route::put('set-third-party-config', [ConfigurationController::class, 'thirdPartyConfigSet'])->name('set-third-party-config');

        Route::get('get-app-settings', [ConfigurationController::class, 'appSettingsConfigGet'])->name('get-app-settings');
        Route::put('set-app-settings', [ConfigurationController::class, 'appSettingsConfigSet'])->name('set-app-settings');

        Route::get('language-setup', [ConfigurationController::class, 'languageSetup'])->name('language_setup');

        Route::post('social-login-config-set', [ConfigurationController::class, 'setSocialLoginConfig'])->name('social-login-config-set');
        Route::put('email-status-update', [ConfigurationController::class, 'emailStatusUpdate'])->name('email-status-update');

        Route::post('change-storage-connection-type', [ConfigurationController::class, 'changeStorageConnectionType'])->name('change-storage-connection-type');
        Route::put('update-storage-connection', [ConfigurationController::class, 'updateStorageConnectionSettings'])->name('update-storage-connection');

        Route::get('third-party/{webPage}', [ConfigurationController::class, 'thirdParty'])->name('third-party');
        Route::put('store-third-party-data', [ConfigurationController::class, 'storeThirdPartyData'])->name('store-third-party-data');
        Route::post('update-firebase-otp-status', [ConfigurationController::class, 'updateFirebaseOtpStatus'])->name('update-firebase-otp-status');
        Route::get('ai-configuration', [ConfigurationController::class, 'AIConfiguration'])->name('ai-configuration');
        Route::post('ai-configuration-update', [ConfigurationController::class, 'AIConfigurationUpdate'])->name('ai-configuration.update');
        Route::post('ai-configuration/status-update', [ConfigurationController::class, 'AIConfigurationStatusUpdate'])->name('ai-configuration.status-update');
    });

    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('settings', [ConfigurationController::class, 'getCustomerSettings'])->name('settings');
        Route::put('settings', [ConfigurationController::class, 'setCustomerSettings']);
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider']], function () {
    Route::group(['prefix' => 'subscription-package', 'as' => 'subscription-package.'], function () {
        Route::get('details', [ProviderSubscriptionPackageController::class, 'details'])->name('details');
        Route::post('to-commission', [ProviderSubscriptionPackageController::class, 'toCommission'])->name('to.commission');
        Route::post('renew-payment', [ProviderSubscriptionPackageController::class, 'renewPayment'])->name('renew.payment');
        Route::post('renew-ajax', [ProviderSubscriptionPackageController::class, 'ajaxRenewPackage'])->name('renew.ajax');
        Route::post('shift-payment', [ProviderSubscriptionPackageController::class, 'shiftPayment'])->name('shift.payment');
        Route::post('shift-ajax', [ProviderSubscriptionPackageController::class, 'ajaxShiftPackage'])->name('shift.ajax');
        Route::post('purchase-payment', [ProviderSubscriptionPackageController::class, 'purchasePayment'])->name('purchase.payment');
        Route::post('purchase-ajax', [ProviderSubscriptionPackageController::class, 'ajaxPurchasePackage'])->name('purchase.ajax');
        Route::post('cancel', [ProviderSubscriptionPackageController::class, 'cancel'])->name('cancel');
        //Route::get('transactions', [ProviderSubscriptionPackageController::class, 'transactions'])->name('transactions');
        //Route::post('transactions', [ProviderSubscriptionPackageController::class, 'transactions'])->name('transactions');
        Route::any('download', [ProviderSubscriptionPackageController::class, 'download'])->name('download');
        Route::any('transactions', [ProviderSubscriptionPackageController::class, 'transactions'])->name('transactions');
        Route::get('transactions/download', [ProviderSubscriptionPackageController::class, 'transactionsDownload'])->name('transactions.download');
        Route::get('transactions/invoice/{id}', [ProviderSubscriptionPackageController::class, 'invoice'])->name('transactions.invoice');
    });

    Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.'], function () {
        Route::get('get-business-information', [ProviderBusinessInformationController::class, 'businessInformationGet'])->name('get-business-information');
        Route::put('set-business-information', [ProviderBusinessInformationController::class, 'businessInformationSet'])->name('set-business-information');
        Route::put('availability-status', [ProviderBusinessInformationController::class, 'availabilityStatus'])->name('availability-status');
        Route::put('availability-schedule', [ProviderBusinessInformationController::class, 'availabilitySchedule'])->name('availability-schedule');
        Route::put('update-business-information', [ProviderBusinessInformationController::class, 'updateBusinessInformation'])->name('update-business-information');
    });

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function () {
        Route::get('get-notification-setting', [ProviderConfigurationController::class, 'notificationSettingsGet'])->name('get-notification-setting');
        Route::post('update-notification-status', [ProviderConfigurationController::class, 'updateStatus'])->name('updateProviderNotification');
    });

    Route::group(['prefix' => 'settings/payment-information', 'as' => 'settings.payment-information.'], function () {
        Route::get('index', [WithdrawPaymentInformationController::class, 'index'])->name('index');
        Route::post('status-update/{id}', [WithdrawPaymentInformationController::class, 'statusUpdate'])->name('status-update');
        Route::get('default-status-update/{id}', [WithdrawPaymentInformationController::class, 'defaultStatusUpdate'])->name('default-status-update');
        Route::post('store', [WithdrawPaymentInformationController::class, 'store'])->name('store');
        Route::delete('delete/{id}', [WithdrawPaymentInformationController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [WithdrawPaymentInformationController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [WithdrawPaymentInformationController::class, 'update'])->name('update');
    });
});

Route::get('provider/public/subscription-package/transactions/download', [ProviderSubscriptionPackageController::class, 'transactionsDownload'])->name('provider.public.subscription-package.transactions.download');
