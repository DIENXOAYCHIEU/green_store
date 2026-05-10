<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\User\PurchaseController;
use App\Http\Controllers\VnpayController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Models\Product;

Route::get('/', function () {

    $products = Product::latest()
        ->take(4)
        ->get();

    return view('home', compact('products'));
});

Route::get('/contact', function () {
    return view('contact');
});
Route::resource('account', AccountController::class);
Route::resource('product', ProductController::class);
