<?php

use Illuminate\Support\Facades\Route;
use Modules\TransactionModule\Http\Controllers\Api\V1\Provider\WithdrawController;
use Modules\TransactionModule\Http\Controllers\Api\V1\Admin\TransactionController;

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Api\V1\Admin','middleware'=>['auth:api']], function () {
    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::post('/', [TransactionController::class, 'store']);
    });
});

Route::group(['prefix' => 'provider', 'as'=>'provider.', 'namespace' => 'Api\V1\Provider','middleware'=>['auth:api']], function () {
    Route::group(['prefix' => 'withdraw', 'as'=>'withdraw.'], function () {
        Route::get('methods', [WithdrawController::class, 'getMethods']);
    });
});
