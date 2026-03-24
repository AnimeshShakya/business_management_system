<?php

use Illuminate\Support\Facades\Route;
use Modules\CategoryManagement\Http\Controllers\Web\Admin\CategoryController;
use Modules\CategoryManagement\Http\Controllers\Web\Admin\SubCategoryController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Web\Admin', 'middleware' => ['admin']], function () {

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::any('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [CategoryController::class, 'statusUpdate'])->name('status-update');
        Route::any('featured-update/{id}', [CategoryController::class, 'featuredUpdate'])->name('featured-update');
        Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
        Route::get('childes', [CategoryController::class, 'childes']);
        Route::get('ajax-childes/{id}', [CategoryController::class, 'ajaxChildes'])->name('ajax-childes');
        Route::get('ajax-childes-only/{id}', [CategoryController::class, 'ajaxChildesOnly'])->name('ajax-childes-only');
        Route::get('download', [CategoryController::class, 'download'])->name('download');
        Route::get('table', [CategoryController::class, 'getTable'])->name('table');
    });

    Route::group(['prefix' => 'sub-category', 'as' => 'sub-category.'], function () {
        Route::any('create', [SubCategoryController::class, 'create'])->name('create');
        Route::post('store', [SubCategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [SubCategoryController::class, 'update'])->name('update');
        Route::any('status-update/{id}', [SubCategoryController::class, 'statusUpdate'])->name('status-update');
        Route::delete('delete/{id}', [SubCategoryController::class, 'destroy'])->name('delete');
        Route::get('download', [SubCategoryController::class, 'download'])->name('download');
    });
});
