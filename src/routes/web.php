<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('account', AccountController::class);
Route::resource('product', ProductController::class);