<?php

use Illuminate\Support\Facades\Route;
use Modules\ChattingModule\Http\Controllers\Api\V1\Admin\ChattingController as AdminChattingController;
use Modules\ChattingModule\Http\Controllers\Api\V1\Customer\ChattingController as CustomerChattingController;
use Modules\ChattingModule\Http\Controllers\Api\V1\Provider\ChattingController as ProviderChattingController;
use Modules\ChattingModule\Http\Controllers\Api\V1\Serviceman\ChattingController as ServicemanChattingController;
use Modules\ChattingModule\Http\Controllers\Api\V1\GlobalChattingController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'chat'], function () {
        Route::get('channel-list', [AdminChattingController::class, 'channelList']);
        Route::get('referenced-channel-list', [AdminChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [AdminChattingController::class, 'createChannel']);
        Route::post('send-message', [AdminChattingController::class, 'sendMessage']);
        Route::get('conversation', [AdminChattingController::class, 'conversation']);
    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Api\V1\Customer', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'chat'], function () {
        Route::get('channel-list', [CustomerChattingController::class, 'channelList']);
        Route::post('channel-list-search', [CustomerChattingController::class, 'channelListSearch']);
        Route::get('referenced-channel-list', [CustomerChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [CustomerChattingController::class, 'createChannel']);
        Route::post('send-message', [CustomerChattingController::class, 'sendMessage']);
        Route::get('conversation', [CustomerChattingController::class, 'conversation']);
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'chat'], function () {
        Route::get('channel-list', [ProviderChattingController::class, 'channelList']);
        Route::post('channel-list-search', [ProviderChattingController::class, 'channelListSearch']);
        Route::get('referenced-channel-list', [ProviderChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [ProviderChattingController::class, 'createChannel']);
        Route::post('send-message', [ProviderChattingController::class, 'sendMessage']);
        Route::get('conversation', [ProviderChattingController::class, 'conversation']);
    });
});

Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.', 'namespace' => 'Api\V1\Serviceman', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'chat'], function () {
        Route::get('channel-list', [ServicemanChattingController::class, 'channelList']);
        Route::post('channel-list-search', [ServicemanChattingController::class, 'channelListSearch']);
        Route::get('referenced-channel-list', [ServicemanChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [ServicemanChattingController::class, 'createChannel']);
        Route::post('send-message', [ServicemanChattingController::class, 'sendMessage']);
        Route::get('conversation', [ServicemanChattingController::class, 'conversation']);
    });
});

Route::group(['namespace' => 'Api\V1', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'chat'], function () {
        Route::get('channel-list', [GlobalChattingController::class, 'channelList']);
        Route::get('referenced-channel-list', [GlobalChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [GlobalChattingController::class, 'createChannel']);
        Route::post('send-message', [GlobalChattingController::class, 'sendMessage']);
        Route::get('conversation', [GlobalChattingController::class, 'conversation']);
        Route::get('unread-conversation', [GlobalChattingController::class, 'unreadConversationCount']);
    });
});
