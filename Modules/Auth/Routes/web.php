<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\Web\PasswordResetController;
use Modules\Auth\Http\Controllers\Web\VerificationController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [LoginController::class, 'loginForm'])->name('login');
        Route::post('login', [LoginController::class, 'adminLogin']);
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('sign-up', [RegisterController::class, 'providerSelfRegisterForm'])->name('sign-up');
        Route::post('sign-up', [RegisterController::class, 'providerSelfRegister'])->name('sign-up-submit');
        Route::get('login', [LoginController::class, 'providerLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'providerLogin']);
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'reset-password', 'as' => 'reset-password.'], function () {
            Route::get('/', [PasswordResetController::class, 'index'])->name('index');
            Route::post('send-otp', [PasswordResetController::class, 'sendOtp'])->name('send-otp');
            Route::post('verify-otp', [PasswordResetController::class, 'verifyOtp'])->name('verify-otp');
            Route::post('change-password', [PasswordResetController::class, 'changePassword'])->name('change-password');
        });

        Route::group(['prefix' => 'verification', 'as' => 'verification.'], function () {
            Route::get('/', [VerificationController::class, 'index'])->name('index');
            Route::post('send-otp', [VerificationController::class, 'sendOtp'])->name('send-otp');
            Route::post('verify-otp', [VerificationController::class, 'verifyOtp'])->name('verify-otp');
        });
    });

});

Route::post('check-unique-user', [RegisterController::class, 'checkUniqueUser'])->name('check-unique-user');
