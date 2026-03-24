<?php

use Illuminate\Support\Facades\Route;
use Modules\ChattingModule\Http\Controllers\Web\Admin\ChattingController;
use Modules\ChattingModule\Http\Controllers\Web\Provider\ChattingController as ProviderChattingController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {
    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('index', [ChattingController::class, 'index'])->name('index');
        Route::get('channel-list', [ChattingController::class, 'channelList']);
        Route::get('referenced-channel-list', [ChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [ChattingController::class, 'createChannel'])->name('create-channel');
        Route::post('send-message', [ChattingController::class, 'sendMessage'])->name('send-message');
        Route::get('ajax-conversation', [ChattingController::class, 'conversation'])->name('ajax-conversation');
    });
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Web\Provider', 'middleware' => ['provider', 'subscription:chat']], function () {
    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('index', [ProviderChattingController::class, 'index'])->name('index');
        Route::get('channel-list', [ProviderChattingController::class, 'channelList']);
        Route::get('referenced-channel-list', [ProviderChattingController::class, 'referencedChannelList']);
        Route::post('create-channel', [ProviderChattingController::class, 'createChannel'])->name('create-channel');
        Route::post('send-message', [ProviderChattingController::class, 'sendMessage'])->name('send-message');
        Route::get('ajax-conversation', [ProviderChattingController::class, 'conversation'])->name('ajax-conversation');
    });
});
