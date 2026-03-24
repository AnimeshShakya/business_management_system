<?php

use Illuminate\Support\Facades\Route;
use Modules\CategoryManagement\Http\Controllers\Api\V1\Customer\CategoryController;
use Modules\CategoryManagement\Http\Controllers\Api\V1\Customer\SubCategoryController;
use Modules\CategoryManagement\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use Modules\CategoryManagement\Http\Controllers\Api\V1\Admin\SubCategoryController as AdminSubCategoryController;
use Modules\CategoryManagement\Http\Controllers\Api\V1\Provider\CategoryController as ProviderCategoryController;

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Api\V1\Admin', 'middleware'=>['auth:api']], function () {
//    Route::resource('category', 'CategoryController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::put('category/status/update', [AdminCategoryController::class, 'status_update']);
    Route::delete('category/delete', [AdminCategoryController::class, 'destroy']);
    Route::get('category/search', [AdminCategoryController::class, 'search']);
    Route::get('category/childes', [AdminCategoryController::class, 'childes']);

//    Route::resource('sub-category', 'SubCategoryController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::put('sub-category/status/update', [AdminSubCategoryController::class, 'status_update']);
    Route::delete('sub-category/delete', [AdminSubCategoryController::class, 'destroy']);
});


Route::group(['prefix' => 'provider', 'as'=>'provider.', 'namespace' => 'Api\V1\Provider', 'middleware' => ['auth:api']], function () {
    Route::get('sub-categories', [ProviderCategoryController::class, 'subCategory']);
    Route::group(['prefix' => 'category', 'as'=>'category.'], function () {
        Route::get('/', [ProviderCategoryController::class, 'index']); // index
        Route::get('childes', [ProviderCategoryController::class, 'childes']);
    });
});


Route::group(['prefix' => 'customer', 'as'=>'customer.', 'namespace' => 'Api\V1\Customer'], function () {
    Route::group(['prefix' => 'category', 'as'=>'category.'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('childes', [CategoryController::class, 'childes']);
    });
    Route::get('sub-categories', [SubCategoryController::class, 'index']);
    Route::get('featured-categories', [CategoryController::class, 'featured']);
});
