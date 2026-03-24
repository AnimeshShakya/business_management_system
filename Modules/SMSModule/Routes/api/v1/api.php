<?php

use Illuminate\Support\Facades\Route;
use Modules\SMSModule\Http\Controllers\Api\V1\Admin\SMSConfigController;

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Api\V1\Admin','middleware'=>['auth:api']], function () {
    Route::group(['prefix'=>'sms-config'],function (){
        Route::get('get', [SMSConfigController::class, 'smsConfigGet']);
        Route::put('set', [SMSConfigController::class, 'smsConfigSet']);
    });
});
