<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;


Route::group(['prefix'=>'v1'],function(){
    Route::get('/brands',[BrandController::class, 'getBrands']);
    Route::get('/categories',[CategoryController::class, 'getCategories']);
});