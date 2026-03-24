<?php

use Illuminate\Support\Facades\Route;
use Modules\ZoneManagement\Http\Controllers\PublicZoneController;
use Modules\ZoneManagement\Http\Controllers\Api\V1\Admin\ZoneController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'zone'], function () {
        Route::get('/', [ZoneController::class, 'index']);   // index
        Route::post('/', [ZoneController::class, 'store']);  // store
        Route::get('{id}/edit', [ZoneController::class, 'edit']); // edit
        Route::put('{id}', [ZoneController::class, 'update']);    // update
    });
    Route::put('zone/status/update', [ZoneController::class, 'statusUpdate']);
    Route::delete('zone/delete', [ZoneController::class, 'destroy']);
});

Route::get('zones', [PublicZoneController::class, 'index']);
