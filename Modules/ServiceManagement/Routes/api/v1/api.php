<?php

use Illuminate\Support\Facades\Route;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Customer\FavoriteServiceController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Customer\ServiceController as CustomerServiceController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Provider\ServiceController as ProviderServiceController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Provider\FAQController as ProviderFAQController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Serviceman\ServiceController as ServicemanServiceController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Admin\ServiceController as AdminServiceController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Admin\FAQController as AdminFAQController;
use Modules\ServiceManagement\Http\Controllers\Api\V1\Provider\ServiceRequestController;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
//    Route::resource('service', 'ServiceController', ['only' => ['index', 'store', 'edit', 'update', 'show']]);
    Route::put('service/status/update', [AdminServiceController::class, 'statusUpdate']);
    Route::delete('service/delete', [AdminServiceController::class, 'destroy']);

//    Route::resource('faq', 'FAQController', ['only' => ['index', 'store', 'edit', 'update', 'show']]);
    Route::put('faq/status/update', [AdminFAQController::class, 'statusUpdate']);
    Route::delete('faq/delete', [AdminFAQController::class, 'destroy']);
});

Route::group(['prefix' => 'provider', 'as' => 'provider.', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {
    Route::get('service', [ProviderServiceController::class, 'index']); // index
    Route::get('service/{id}', [ProviderServiceController::class, 'show']); // show
    Route::put('service/status/update', [ProviderServiceController::class, 'statusUpdate']);
    Route::get('service/data/search', [ProviderServiceController::class, 'search']);
    Route::get('service/review/{service_id}', [ProviderServiceController::class, 'review']);
    Route::get('service/data/sub-category-wise', [ProviderServiceController::class, 'servicesBySubcategory']);

    Route::get('service-request', [ServiceRequestController::class, 'index']);
    Route::post('service-request', [ServiceRequestController::class, 'makeRequest']);

    Route::post('review-reply', [ProviderServiceController::class, 'reviewReply']);

    Route::get('faq', [ProviderFAQController::class, 'index']); // index
});

Route::group(['prefix' => 'serviceman', 'as' => 'serviceman.', 'namespace' => 'Api\V1\Service', 'middleware' => ['auth:api']], function () {
    Route::get('service/data/sub-category-wise', [ServicemanServiceController::class, 'servicesBySubcategory']);

});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Api\V1\Customer'], function () {

    Route::group(['prefix' => 'favorite', 'as' => 'favorite.', 'middleware' => ['auth:api']], function () {
        Route::get('service-list', [FavoriteServiceController::class, 'list']);
        Route::post('service', [FavoriteServiceController::class, 'store']);
        Route::post('service-delete/{service_id}', [FavoriteServiceController::class, 'destroy']);
    });

    Route::group(['prefix' => 'service'], function () {
        Route::get('/', [CustomerServiceController::class, 'index']);
        Route::post('search', [CustomerServiceController::class, 'search']);
        Route::get('search-suggestion', [CustomerServiceController::class, 'searchSuggestions']);
        Route::get('search/recommended', [CustomerServiceController::class, 'searchRecommended']);
        Route::get('popular', [CustomerServiceController::class, 'popular']);
        Route::get('recommended', [CustomerServiceController::class, 'recommended']);
        Route::get('trending', [CustomerServiceController::class, 'trending']);
        Route::get('recently-viewed', [CustomerServiceController::class, 'recentlyViewed'])->middleware('auth:api');
        Route::get('offers', [CustomerServiceController::class, 'offers']);
        Route::get('detail/{slug}', [CustomerServiceController::class, 'show']);
        Route::get('review/{service_id}', [CustomerServiceController::class, 'review']);
        //Route::get('sub-category/{sub_category_id}', [CustomerServiceController::class, 'servicesBySubcategory']);
        Route::get('sub-category/{slug}', [CustomerServiceController::class, 'servicesBySubcategory']);

        Route::post('area-availability', [CustomerServiceController::class, 'serviceAreaAvailability']);

        Route::group(['prefix' => 'request'], function () {
            Route::post('make', [CustomerServiceController::class, 'makeRequest'])->middleware('auth:api');
            Route::get('list', [CustomerServiceController::class, 'requestList'])->middleware('auth:api');
        });
    });

    Route::get('recently-searched-keywords', [CustomerServiceController::class, 'recentlySearchedKeywords'])->middleware('auth:api');
    Route::get('remove-searched-keywords', [CustomerServiceController::class, 'removeSearchedKeywords'])->middleware('auth:api');
});
