<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;




Route::post('/users/create', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}/update', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/carts', [CartController::class, 'index']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::post('/carts/add', [CartController::class, 'addToCart']);
    Route::delete('/carts/destroy', [CartController::class, 'removeFromCart']);
    Route::put('/carts/update', [CartController::class, 'updateQuantity']);

    Route::apiResource('orders', OrderController::class);
});

Route::fallback(
    function () {
        return response()->json([
            'message' => 'route not found'
        ], 404);
    }
);
