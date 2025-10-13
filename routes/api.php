<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishListController;


Route::group(['prefix'=>'v1'],function(){
    Route::get('/brands',[BrandController::class, 'getBrands']);
    Route::get('/categories',[CategoryController::class, 'getCategories']);

    //Product routes
    Route::get('/products',[ProductController::class, 'index']);
    Route::get('/product/{product}',[ProductController::class, 'show']);
    Route::get('/product-slider',[ProductController::class, 'productSlider']);

    //login
    Route::post('/sent-otp',[AuthController::class, 'sentOtp']);
    Route::post('/login',[AuthController::class, 'login']);

    Route::group(['middleware'=>'auth:sanctum'],function(){
        //Wish list
        Route::post('/add-wishlist',[WishListController::class,'addWishList']);
        Route::get('/wishlist',[WishListController::class,'wishlist']);
        Route::delete('/remove-wishlist/{list}',[WishListController::class,'removeWishList']);

        //Cart List
        Route::get('/cartList',[CartController::class,'cartList']);
        Route::post('/add-cartList',[CartController::class,'addCartList']);
        Route::delete('/remove-to-cartList',[CartController::class,'removeToCartLit']);
        Route::delete('/clear-cartList',[CartController::class,'clearCartList']);
    });
});