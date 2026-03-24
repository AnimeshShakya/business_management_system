<?php

use Illuminate\Support\Facades\Route;
use Modules\ServiceManagement\Http\Controllers\Web\Admin\ServiceController as AdminServiceController;
use Modules\ServiceManagement\Http\Controllers\Web\Admin\ServiceRequestController;
use Modules\ServiceManagement\Http\Controllers\Web\Admin\FAQController;
use Modules\ServiceManagement\Http\Controllers\Web\Provider\ServiceController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {

    Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
        Route::any('list', [AdminServiceController::class, 'index'])->name('index');
        Route::any('create', [AdminServiceController::class, 'create'])->name('create');
        Route::post('store', [AdminServiceController::class, 'store'])->name('store');
        Route::any('detail/{id}', [AdminServiceController::class, 'show'])->name('detail');
        Route::get('edit/{id}', [AdminServiceController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [AdminServiceController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [AdminServiceController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [AdminServiceController::class, 'destroy'])->name('delete');
        Route::any('download', [AdminServiceController::class, 'download'])->name('download');
        Route::any('reviews/download', [AdminServiceController::class, 'reviewsDownload'])->name('reviews.download');

        Route::get('request/list', [ServiceRequestController::class, 'requestList'])->name('request.list');
        Route::post('request/update/{id}', [ServiceRequestController::class, 'updateStatus'])->name('request.update');

        Route::any('review-status-update/{id}', [AdminServiceController::class, 'reviewStatusUpdate'])->name('review-status-update');

        //ajax routes
        Route::any('ajax-add-variant', [AdminServiceController::class, 'ajaxAddVariant'])->name('ajax-add-variant')->withoutMiddleware('csrf');
        Route::any('ajax-remove-variant/{variant_key}', [AdminServiceController::class, 'ajaxRemoveVariant'])->name('ajax-remove-variant')->withoutMiddleware('csrf');
        Route::any('ajax-delete-db-variant/{variant_key}/{service_id}', [AdminServiceController::class, 'ajaxDeleteDbVariant'])->name('ajax-delete-db-variant')->withoutMiddleware('csrf');
    });

    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
        Route::post('store/{service_id}', [FAQController::class, 'store'])->name('store');
        Route::get('edit/{id}', [FAQController::class, 'edit'])->name('edit');
        Route::any('update/{id}', [FAQController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [FAQController::class, 'statusUpdate'])->name('status-update');
        Route::any('delete/{id}/{service_id}', [FAQController::class, 'destroy'])->name('delete');
    });
});


Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider']], function () {
    Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
        Route::get('available', [ServiceController::class, 'index'])->name('available');
        Route::get('request-list', [ServiceController::class, 'requestList'])->name('request-list')->middleware('subscription:service_request');
        Route::get('make-request', [ServiceController::class, 'makeRequest'])->name('make-request');
        Route::post('make-request', [ServiceController::class, 'storeRequest']);
        Route::put('update-subscription', [ServiceController::class, 'updateSubscription'])->name('update-subscription');
        Route::any('detail/{id}', [ServiceController::class, 'show'])->name('detail');
        Route::post('review-reply', [ServiceController::class, 'reviewReply'])->name('review.reply');
        Route::any('reviews/download', [ServiceController::class, 'reviewsDownload'])->name('reviews.download');
    });
});
