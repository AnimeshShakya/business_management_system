<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\V1\LoginController;
use Modules\Auth\Http\Controllers\Api\V1\RegisterController;

Route::group(['prefix' => 'admin', 'as' => 'admin', 'namespace' => 'Api\V1'], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('login', [LoginController::class, 'adminLogin'])->name('login');
    });

});

Route::group(['prefix' => 'provider', 'as' => 'provider', 'namespace' => 'Api\V1'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('registration', [RegisterController::class, 'providerRegister'])->name('registration');
        Route::post('login', [LoginController::class, 'providerLogin'])->name('login');
    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer', 'namespace' => 'Api\V1'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('registration', [RegisterController::class, 'customerRegister'])->name('registration');
        Route::post('login', [LoginController::class, 'customerLogin'])->name('login');
        Route::post('social-login', [LoginController::class, 'customerSocialLogin'])->name('social-login');
        Route::post('existing-account-check', [LoginController::class, 'existingAccountCheck']);
        Route::post('registration-with-social-media', [LoginController::class, 'registrationWithSocialMedia']);
        Route::post('logout', [LoginController::class, 'customerLogOut'])->middleware('auth:api');
    });
});

Route::group(['prefix' => 'serviceman', 'as' => 'serviceman', 'namespace' => 'Api\V1'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('login', [LoginController::class, 'servicemanLogin'])->name('login');
    });
});


Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:api'], 'namespace' => 'Api\V1'], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

