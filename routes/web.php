<?php

use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductController::class,'index'])->name('home');
Route::get('/product/{product}',[ProductController::class,'show'])->name('product.show');
Route::post('/add-to-cart/{product}',[OrderController::class,'addToCart'])->name('addToCart');
Route::delete('/remove-from-cart/{product}',[OrderController::class,'removeFromCart'])->name('removeFromCart');
Route::patch('/update-cart/{product}',[OrderController::class,'updateCart'])->name('updateCart');


Route::get('/cart',[OrderController::class,'cartShow'])->name('cartShow');
Route::post('/cart/address',[OrderController::class,'addAddress'])->name('addAddress');
Route::get('/invoice',[OrderController::class,'invoice'])->name('invoice');
Route::post('/order/store',[OrderController::class,'store'])->name('orderStore')->middleware('Auth');
Route::match(['get','post'],'/pay-result',[OrderController::class,'payResult'])->name('payResult');

Route::middleware('guest')
    ->prefix('auth')
    ->group(function (){
        Route::get('/login',[\App\Http\Controllers\AuthController::class , 'loginView'])->name('login');
        Route::post('/login',[\App\Http\Controllers\AuthController::class , 'loginSubmit'])->name('loginSubmit');

        Route::get('/register',[\App\Http\Controllers\AuthController::class , 'registerView'])->name('register');
        Route::post('/register',[\App\Http\Controllers\AuthController::class , 'registerSubmit'])->name('registerSubmit');

    });

Route::middleware('dashboard')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function (){
        Route::get('/',[\App\Http\Controllers\Dashboard\DashboardController::class , "index"])->name('index');
        Route::resource('product',\App\Http\Controllers\Dashboard\ProductController::class);
    });
Route::get('/logout',[\App\Http\Controllers\AuthController::class , 'logout'])->name('logout');

