<?php

use Illuminate\Support\Facades\Route;
use Modules\SMSModule\Http\Controllers\Web\Admin\SMSConfigController;

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Web\Admin','middleware'=>['admin']], function () {
    Route::group(['prefix'=>'configuration', 'as'=>'configuration.'],function (){
        Route::get('sms-get', [SMSConfigController::class, 'smsConfigGet'])->name('sms-get');
        Route::put('sms-set', [SMSConfigController::class, 'smsConfigSet'])->name('sms-set');
        Route::post('update-gateway-status/{gateway}/{status}', [SMSConfigController::class, 'updateGatewayStatus'])->name('update-gateway-status');
    });
});
