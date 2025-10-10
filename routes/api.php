<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Route::group(['prefix'=>'v1'],function(){
    Route::get('/brands',[BrandController::class, 'getBrands']);
    Route::get('/categories',[CategoryController::class, 'getCategories']);

    //Product routes
    Route::get('/products',[ProductController::class, 'index']);
    Route::get('/product/{product}',[ProductController::class, 'show']);
    Route::get('/product-slider',[ProductController::class, 'productSlider']);
});