<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//welcome route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Route
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthenticationController::class, 'showRegister']);
Route::post('/register', [AuthenticationController::class, 'store']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [ProductController::class, 'index']);
    Route::get('/products/myProducts', [ProductController::class, 'myProducts']);
    Route::get('/products/othersProducts', [ProductController::class, 'othersProducts']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::get('/product/{product}', [ProductController::class, 'show']);
    Route::get('/product/{product}/edit', [ProductController::class, 'edit']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/checkout', [CartController::class, 'checkout']);
    Route::get('/order', [OrdersController::class, 'index']);
});

Route::post('/product/store', [ProductController::class, 'store']);
Route::put('/product/{product}', [ProductController::class, 'update']);
Route::delete('/product/{product}/delete', [ProductController::class, 'destroy']);
Route::post('/cart/add_cart', [CartItemController::class, 'store']);
Route::put('/cart/update_cart/{cartItem}', [CartItemController::class, 'update']);
Route::delete('/cart/delete/{cartItem}', [CartItemController::class, 'destroy']);
Route::post('/order', [OrdersController::class, 'store']);
