<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('user.home.index');
})->name('user.home');

Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('login', [AuthController::class, 'handleLogin'])->name('login.handle');
Route::post('logout', [AuthController::class, 'handleLogout'])->name('logout.handle');

Route::get('register', [AccountController::class, 'index'])->name('auth.register');
Route::post('register', [AccountController::class, 'create'])->name('register.handle');

Route::get('/user/purchase', [AccountController::class, 'purchase'])->name('user.purchase');


Route::resource('product', ProductController::class)->only(['index', 'show']);
Route::post('/product/checkout', [ProductController::class, 'checkout'])->name('product.checkout');
Route::post('/product/buynow', [ProductController::class, 'buyNow'])->name('product.buynow');

Route::resource('review', ReviewController::class);