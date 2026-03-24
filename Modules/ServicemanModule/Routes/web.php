<?php

use Illuminate\Support\Facades\Route;
use Modules\ServicemanModule\Http\Controllers\Web\Provider\ServicemanController;

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider']], function () {

    Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.'], function () {
        Route::any('/list', [ServicemanController::class, 'index'])->name('list');
        Route::get('create', [ServicemanController::class, 'create'])->name('create');
        Route::post('store', [ServicemanController::class, 'store'])->name('store');
        Route::get('show/{id}', [ServicemanController::class, 'show'])->name('show');
        Route::get('edit/{id}', [ServicemanController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ServicemanController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [ServicemanController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [ServicemanController::class, 'destroy'])->name('delete');
        Route::any('download', [ServicemanController::class, 'download'])->name('download');
    });
});

