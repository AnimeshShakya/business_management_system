<?php

use Illuminate\Support\Facades\Route;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\LanguageController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\Report\Business\OverviewReportController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\Report\BookingReportController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\Report\Business\EarningReportController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\Report\Business\ExpenseReportController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\Report\TransactionReportController;
use Modules\ProviderManagement\Http\Controllers\Web\Admin\CollectCashController;
use Modules\ProviderManagement\Http\Controllers\Web\Admin\ProviderController;
use Modules\ProviderManagement\Http\Controllers\Web\Admin\SubscriptionController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\ProviderController as ProviderProviderController;
use Modules\ProviderManagement\Http\Controllers\Web\Provider\WithdrawController;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {
    Route::group(['prefix' => 'provider', 'as' => 'provider.'], function () {
        Route::any('list', [ProviderController::class, 'index'])->name('list');
        Route::any('status-update/{id}', [ProviderController::class, 'statusUpdate'])->name('status_update');
        Route::any('service-availability/{id}', [ProviderController::class, 'serviceAvailability'])->name('service_availability');
        Route::any('suspend-update/{id}', [ProviderController::class, 'suspendUpdate'])->name('suspend_update');
        Route::post('commission-update/{id}', [ProviderController::class, 'commissionUpdate'])->name('commission_update');

        Route::get('available-provider', [ProviderController::class, 'availableProviderList'])->name('available-provider-list');
        Route::get('provider-info', [ProviderController::class, 'providerInfo'])->name('provider-info');
        Route::put('reassign-provider/{id}', [ProviderController::class, 'reassignProvider'])->name('reaasign-provider');

        Route::get('create', [ProviderController::class, 'create'])->name('create');
        Route::post('store', [ProviderController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProviderController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProviderController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ProviderController::class, 'destroy'])->name('delete');
        Route::any('details/{id}', [ProviderController::class, 'details'])->name('details');
        Route::any('download', [ProviderController::class, 'download'])->name('download');
        Route::any('reviews/download', [ProviderController::class, 'reviewsDownload'])->name('reviews.download');
        Route::get('get-provider-info/{provider_id}', [ProviderController::class, 'getProviderInfo'])->name('get-provider-info')->withoutMiddleware('admin');

        Route::group(['prefix' => 'subscription-package', 'as' => 'subscription-package.'], function () {
            Route::post('to-commission', [SubscriptionController::class, 'toCommission'])->name('to.commission');
            Route::post('renew-payment', [SubscriptionController::class, 'renewPayment'])->name('renew.payment');
            Route::post('renew-ajax', [SubscriptionController::class, 'ajaxRenewPackage'])->name('renew.ajax');
            Route::post('shift-payment', [SubscriptionController::class, 'shiftPayment'])->name('shift.payment');
            Route::post('shift-ajax', [SubscriptionController::class, 'ajaxShiftPackage'])->name('shift.ajax');
            Route::post('purchase-payment', [SubscriptionController::class, 'purchasePayment'])->name('purchase.payment');
            Route::post('purchase-ajax', [SubscriptionController::class, 'ajaxPurchasePackage'])->name('purchase.ajax');
            Route::post('cancel', [SubscriptionController::class, 'cancel'])->name('cancel');
        });

        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::post('update/{id}', [ProviderController::class, 'updateAccountInfo'])->name('update');
            Route::get('delete/{id}', [ProviderController::class, 'deleteAccountInfo'])->name('delete');
        });

        Route::group(['prefix' => 'sub-category', 'as' => 'sub_category.'], function () {
            Route::get('update-subscription/{id}', [ProviderController::class, 'updateSubscription'])->name('update_subscription');
        });

        Route::any('onboarding-request', [ProviderController::class, 'onboardingRequest'])->name('onboarding_request');
        Route::get('onboarding-details/{id}', [ProviderController::class, 'onboardingDetails'])->name('onboarding_details');
        Route::get('update-approval/{id}/{status}', [ProviderController::class, 'updateApproval'])->name('update-approval');

        Route::group(['prefix' => 'collect-cash', 'as' => 'collect_cash.'], function () {
            Route::get('/{id}', [CollectCashController::class, 'index'])->name('list');
            Route::post('/', [CollectCashController::class, 'collectCash'])->name('store');
        });
    });
});


Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider']], function () {
    Route::get('setup-guide/status', [ProviderProviderController::class, 'refreshSetupGuideUI'])->name('setup-guide.status');

    Route::post('search-routing', [ProviderProviderController::class, 'searchRouting'])->name('search.routing');
    Route::get('lang/{locale}', [LanguageController::class, 'lang'])->name('lang');
    Route::get('get-updated-data', [ProviderProviderController::class, 'getUpdatedData'])->name('get_updated_data');
    Route::get('dashboard', [ProviderProviderController::class, 'dashboard'])->name('dashboard');
    Route::post('/set-modal-closed', [ProviderProviderController::class, 'setModalClosed'])->name('set.modal.closed');
    Route::get('update-dashboard-earning-graph', [ProviderProviderController::class, 'updateDashboardEarningGraph'])->name('update-dashboard-earning-graph');
    Route::post('subscribeToTopic', [ProviderProviderController::class, 'subscribeToTopic'])->name('subscribeToTopic');
    Route::post('store/search-routing', [ProviderProviderController::class, 'storeClickedRoute'])->name('search.routing.store');
    Route::get('recent-search', [ProviderProviderController::class, 'recentSearch'])->name('recent.search');

    Route::get('bank-info', [ProviderProviderController::class, 'bankInfo'])->name('bank_info');
    Route::put('update-bank-info', [ProviderProviderController::class, 'updateBankInfo'])->name('update_bank_info');

    Route::any('account-info', [ProviderProviderController::class, 'accountInfo'])->name('account_info');
    Route::any('adjust', [ProviderProviderController::class, 'adjust'])->name('adjust');
    Route::any('reviews/download', [ProviderProviderController::class, 'reviewsDownload'])->name('reviews.download');

    //profile
    Route::get('profile-update', [ProviderProviderController::class, 'profileInfo'])->name('profile_update');
    Route::post('profile-update', [ProviderProviderController::class, 'updateProfile']);

    Route::delete('delete', [ProviderProviderController::class, 'deleteProvider'])->name('delete_account');

    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('conversation', [ProviderProviderController::class, 'conversation'])->name('conversation');
    });

    Route::group(['prefix' => 'sub-category', 'as' => 'sub_category.'], function () {
        Route::get('subscribed', [ProviderProviderController::class, 'subscribedSubCategories'])->name('subscribed');
        Route::get('status-update/{id}', [ProviderProviderController::class, 'statusUpdate'])->name('status-update');
        Route::get('available/services', [ProviderProviderController::class, 'availableServices'])->name('available-services');
        Route::get('download', [ProviderProviderController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {
        Route::any('/', [WithdrawController::class, 'index'])->name('list');
        Route::post('/store', [WithdrawController::class, 'withdraw'])->name('store');
        Route::any('download', [WithdrawController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'report', 'as' => 'report.', 'namespace' => 'Report', 'middleware' => 'subscription:reports_&_analytics'], function () {
        //Transaction Report
        Route::any('transaction', [TransactionReportController::class, 'getTransactionReport'])->name('transaction');
        Route::any('transaction/download', [TransactionReportController::class, 'downloadTransactionReport'])->name('transaction.download');

        //Booking Report
        Route::any('booking', [BookingReportController::class, 'getBookingReport'])->name('booking');
        Route::any('booking/download', [BookingReportController::class, 'getBookingReportDownload'])->name('booking.download');

        //Business Report
        Route::group(['prefix' => 'business', 'as' => 'business.'], function () {
            Route::any('overview', [OverviewReportController::class, 'getBusinessOverviewReport'])->name('overview');
            Route::any('overview/download', [OverviewReportController::class, 'getBusinessOverviewReportDownload'])->name('overview.download');
            Route::any('earning', [EarningReportController::class, 'getBusinessEarningReport'])->name('earning');
            Route::any('earning/download', [EarningReportController::class, 'getBusinessEarningReportDownload'])->name('earning.download');
            Route::any('expense', [ExpenseReportController::class, 'getBusinessExpenseReport'])->name('expense');
            Route::any('expense/download', [ExpenseReportController::class, 'getBusinessExpenseReportDownload'])->name('expense.download');
        });
    });
});
