<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $products = Product::with('user')->where('user_id', '!=', Auth::id())->get();
    return view('home', ['products' => $products ?? ""]);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');



// Route::controller(RegisterController::class)->group(function () {
//     Route::get('/register', 'create');
//     Route::post('/register', 'store');
// });

Route::controller(LoginController::class)->group(function () {
    Route::get('/login',  'show')->name('login');
    Route::post('/login',  'store');
    Route::post('/logout', 'logout')->name('logout');
});




Route::get('/products/user-product', [ProductController::class, 'userProduct']);

Route::resource('users', UserController::class);

Route::resource('products', ProductController::class)->middleware('auth');

Route::resource('carts', CartController::class)->middleware('auth');

Route::resource('cartitems', CartItemController::class)->middleware('auth');

// Route::resource('orders', OrderController::class)->middleware('auth');

Route::get('/orders', [OrderController::class, 'create']);
Route::post('/orders', [OrderController::class, 'store']);
