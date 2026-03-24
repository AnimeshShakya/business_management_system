<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminModule\Http\Controllers\Api\V1\Admin\ConfigController;
use Modules\AdminModule\Http\Controllers\Api\V1\Admin\AdminController;
use Modules\AdminModule\Http\Controllers\Api\V1\Admin\RoleController;
use Modules\AdminModule\Http\Controllers\Api\V1\Admin\EmployeeController;
use Modules\AdminModule\Http\Controllers\Api\V1\Admin\WithdrawController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::get('config', [ConfigController::class, 'config'])->withoutMiddleware('auth:api');
    Route::get('counts', [ConfigController::class, 'counts']);
    Route::get('dashboard', [AdminController::class, 'dashboard']);

    Route::get('info', ['index']);
    Route::get('/', [AdminController::class, 'edit']);
    Route::put('update/profile', [AdminController::class, 'update_profile']);

    Route::group(['prefix' => 'role', 'as' => 'role.',], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::get('{id}/edit', [RoleController::class, 'edit']);
        Route::put('{id}', [RoleController::class, 'update']);
        Route::delete('{id}', [RoleController::class, 'destroy']);
        Route::put('status/update', [RoleController::class, 'status_update']);
        Route::get('search', [RoleController::class, 'search']);
        Route::delete('delete', [RoleController::class, 'destroy']);
    });

    Route::group(['prefix' => 'employee', 'as' => 'employee.',], function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('/', [EmployeeController::class, 'store']);
        Route::get('{id}/edit', [EmployeeController::class, 'edit']);
        Route::put('{id}', [EmployeeController::class, 'update']);

        Route::put('status/update', [EmployeeController::class, 'status_update']);
        Route::get('search', [EmployeeController::class, 'search']);
        Route::delete('delete', [EmployeeController::class, 'destroy']);
    });

    Route::group(['prefix' => 'withdraw'], function () {
        Route::get('/', [WithdrawController::class, 'index']);   // index
        Route::put('{id}', [WithdrawController::class, 'update']); // update
    });
});
