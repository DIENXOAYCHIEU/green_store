<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\User\PurchaseController;

Route::get('/', function () {
    return view('user.home.index');
})->name('user.home');

Route::get('login', [AuthController::class, 'login'])->name('auth.login');

Route::post('create-password', [AuthController::class, 'handleCreatePassword'])->name("createPassword.handle");
Route::get('password', [AuthController::class, 'password'])->name('auth.password');

Route::post('login', [AuthController::class, 'handleLogin'])->name('login.handle');
Route::post('logout', [AuthController::class, 'handleLogout'])->name('logout.handle');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('register', [AccountController::class, 'create'])->name('auth.register');
Route::post('register', [AccountController::class, 'store'])->name('register.handle');

Route::get('/user/purchase', [PurchaseController::class, 'index'])->name('user.purchase');
Route::get('/purchase/orders', [PurchaseController::class, 'ordersApi']);

Route::resource('product', ProductController::class)->only(['index', 'show']);
Route::post('/product/checkout', [ProductController::class, 'checkout'])->name('product.checkout');
Route::post('/product/buynow', [ProductController::class, 'buyNow'])->name('product.buynow');

// Show form to request reset link
Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
// Handle sending the link
Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
// Show form to enter new password
Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
// Handle updating the password
Route::post('reset-password', [PasswordResetController::class, 'update'])->name('password.update');

Route::resource('review', ReviewController::class);