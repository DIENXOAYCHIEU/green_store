<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\PurchaseController;

Route::get('/', function () {
    return view('user.home.index');
})->name('user.home');

Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('login', [AuthController::class, 'handleLogin'])->name('login.handle');
Route::post('logout', [AuthController::class, 'handleLogout'])->name('logout.handle');

Route::get('register', [AccountController::class, 'create'])->name('auth.register');
Route::post('register', [AccountController::class, 'store'])->name('register.handle');

Route::get('/user/purchase', [PurchaseController::class, 'index'])->name('user.purchase');
Route::get('/purchase/orders', [PurchaseController::class, 'ordersApi']);

Route::get('product', [ProductController::class, 'index'])->name('user.product.index');
Route::get('product/{id}', [ProductController::class, 'show'])->name('user.product.show');
Route::post('/product/checkout', [ProductController::class, 'checkout'])->name('user.product.checkout');
Route::post('/product/buynow', [ProductController::class, 'buyNow'])->name('user.product.buynow');

Route::resource('review', ReviewController::class);