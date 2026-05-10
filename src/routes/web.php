<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\User\PurchaseController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('user.home.index');
})->name('user.home');

/*Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Đã gửi link xác thực thành công, Hãy kiểm tra hộp thư email của bạn!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');*/

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('create-password', [AuthController::class, 'handleCreatePassword'])->name("createPassword.handle");
Route::get('password', [AuthController::class, 'password'])->name('auth.password');

Route::post('login', [AuthController::class, 'handleLogin'])->name('login.handle');
Route::post('logout', [AuthController::class, 'handleLogout'])->name('logout');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('register', [AccountController::class, 'create'])->name('auth.register');
Route::post('register', [AccountController::class, 'store'])->name('register.handle');

Route::get('/user/purchase', [PurchaseController::class, 'index'])
->middleware(['auth', 'hasPassword'])->name('user.purchase');

Route::get('/purchase/orders', [PurchaseController::class, 'ordersApi']);

Route::get('/profile', [AccountController::class, 'index'])
->middleware(['auth',  'hasPassword'])->name('user.profile');

Route::post('/profile', [AccountController::class, 'update'])->name('edit.handle');
Route::post('/profile/avatar', [AccountController::class, 'updateAvatar'])->name('avatar.handle');

Route::get('product', [ProductController::class, 'index'])->name('user.product.index');
Route::get('product/{id}', [ProductController::class, 'show'])->name('user.product.show');
Route::post('/product/checkout', [ProductController::class, 'checkout'])->name('user.product.checkout');
Route::post('/product/buynow', [ProductController::class, 'buyNow'])->name('user.product.buynow');

// Show form to request reset link
Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
// Handle sending the link
Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
// Show form to enter new password
Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
// Handle updating the password
Route::post('reset-password', [PasswordResetController::class, 'update'])->name('password.update');

Route::resource('review', ReviewController::class);