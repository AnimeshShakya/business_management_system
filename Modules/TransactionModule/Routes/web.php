<?php

use Illuminate\Support\Facades\Route;
use Modules\TransactionModule\Http\Controllers\Web\Admin\WithdrawnController;
use Modules\TransactionModule\Http\Controllers\Web\Admin\WithdrawRequestController;
use Modules\TransactionModule\Http\Controllers\Web\Admin\TransactionController;
use Modules\TransactionModule\Http\Controllers\Web\Provider\WithdrawController as ProviderWithdrawnController;


Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Web\Admin','middleware'=>['admin']], function () {

    Route::group(['prefix' => 'transaction', 'as'=>'transaction.'], function () {
        Route::any('list', [TransactionController::class, 'index'])->name('list');
        Route::any('download', [TransactionController::class, 'download'])->name('download');
    });

    Route::group(['prefix' => 'withdraw', 'as'=>'withdraw.'], function () {
        Route::group(['prefix' => 'request', 'as'=>'request.'], function () {
            Route::any('list', [WithdrawRequestController::class, 'index'])->name('list');
            Route::any('download', [WithdrawRequestController::class, 'download'])->name('download');
            Route::post('import', [WithdrawRequestController::class, 'import'])->name('import');
            Route::post('update-status/{id}', [WithdrawRequestController::class, 'updateStatus'])->name('update_status');
            Route::put('update-multiple-status', [WithdrawRequestController::class, 'updateMultipleStatus'])->name('update_multiple_status');
        });

        Route::group(['prefix' => 'method', 'as'=>'method.'], function () {
            Route::any('list', [WithdrawnController::class, 'methodList'])->name('list');
            Route::get('create', [WithdrawnController::class, 'methodCreate'])->name('create');
            Route::post('store', [WithdrawnController::class, 'methodStore'])->name('store');
            Route::get('edit/{id}', [WithdrawnController::class, 'methodEdit'])->name('edit');
            Route::put('update', [WithdrawnController::class, 'methodUpdate'])->name('update');
            Route::delete('delete/{id}', [WithdrawnController::class, 'methodDestroy'])->name('delete');
            Route::any('status-update/{id}', [WithdrawnController::class, 'methodStatusUpdate'])->name('status-update');
            Route::any('default-status-update/{id}', [WithdrawnController::class, 'methodDefaultStatusUpdate'])->name('default-status-update');
        });
    });

});
Route::group(['prefix' => 'provider', 'as'=>'provider.', 'namespace' => 'Web\Provider','middleware'=>['provider']], function () {
    Route::group(['prefix' => 'withdraw', 'as'=>'withdraw.'], function () {
        Route::group(['prefix' => 'method', 'as'=>'method.'], function () {
            Route::get('list', [ProviderWithdrawnController::class, 'getMethod'])->name('list');
        });
    });

});
