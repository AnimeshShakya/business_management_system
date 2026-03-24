<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\Api\V1\OTPVerificationController;
use Modules\UserManagement\Http\Controllers\Api\V1\PasswordResetController;
use Modules\UserManagement\Http\Controllers\Api\V1\Admin\UserController;

//admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.',], function () {
        Route::get('list', [UserController::class, 'index']);
    });
});


//User
Route::group(['prefix' => 'user', 'namespace' => 'Api\V1'], function () {
    //verification
    Route::group(['prefix' => 'verification'], function () {
        Route::post('send-otp', [OTPVerificationController::class, 'check']);
        Route::post('verify-otp', [OTPVerificationController::class, 'verify']);

        Route::post('firebase-auth-verify', [OTPVerificationController::class, 'firebaseAuthVerify']);
        Route::post('login-otp-verify', [OTPVerificationController::class, 'loginVerifyOTP']);
        Route::post('registration-with-otp', [OTPVerificationController::class, 'registrationWithOTP']);
    });

    //forget password
    Route::group(['prefix' => 'forget-password'], function () {
        Route::post('send-otp', [PasswordResetController::class, 'check']);
        Route::post('verify-otp', [PasswordResetController::class, 'verify']);
        Route::put('reset', [PasswordResetController::class, 'resetPassword']);
    });

    Route::post('check-existing-customer', [OTPVerificationController::class, 'checkExistingCustomer']);
});

