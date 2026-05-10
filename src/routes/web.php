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

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/admin', function () {
    return view('admin.home.homepage');
})->name('admin.home');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.dashboard');
})->name('admin.dashboard');

Route::prefix('admin')->group(function () {
    // Trang quản lý người dùng
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::prefix('admin')->group(function () {
    // Trang quản lý đơn hàng
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}/detail', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/orders/{id}/invoice', [AdminOrderController::class, 'invoice'])->name('admin.orders.invoice');
    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
});

Route::prefix('admin')->group(function () {
    // Trang quản lý sản phẩm
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
});



Route::get('/', function () {
    $products = Product::latest()
        ->take(4)
        ->get();

    return view('home', compact('products'));
})->name('user.home');

Route::get('/contact', function () {
    return view('contact');
});
Route::resource('account', AccountController::class);
Route::resource('product', ProductController::class);

//login, register, forgot password, email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Đã gửi link xác thực thành công, Hãy kiểm tra hộp thư email của bạn!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('create-password', [AuthController::class, 'handleCreatePassword'])->name("createPassword.handle");
Route::get('password', [AuthController::class, 'password'])->name('auth.password');

Route::post('login', [AuthController::class, 'handleLogin'])->name('login.handle');
Route::post('logout', [AuthController::class, 'handleLogout'])->name('logout');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('register', [AccountController::class, 'create'])->name('auth.register');
Route::post('register', [AccountController::class, 'store'])->name('register.handle');

//cart
Route::get('/cart', [ProductController::class, 'cart'])->middleware('auth')->name('user.cart');
Route::get('/user/purchase', [PurchaseController::class, 'index'])->middleware(['auth', 'hasPassword'])->name('user.purchase');

Route::get('/purchase/orders', [PurchaseController::class, 'ordersApi']);

//user profile
Route::get('/profile', [AccountController::class, 'index'])
->middleware(['auth',  'hasPassword'])->name('user.profile');

Route::post('/profile', [AccountController::class, 'update'])->name('edit.handle');
Route::post('/profile/avatar', [AccountController::class, 'updateAvatar'])->name('avatar.handle');

//product details, checkout, buynow
Route::get('product', [ProductController::class, 'index'])->name('user.product.index');
Route::get('product/{id}', [ProductController::class, 'show'])->name('user.product.show');

Route::post('/product/checkout', [ProductController::class, 'checkout'])->middleware('auth')->name('user.product.checkout');
Route::post('/product/place-order', [ProductController::class, 'processCheckout'])->middleware('auth')->name('user.product.placeorder');
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

//vnpay routes
Route::get('/payment/vnpay/return', [VnpayController::class, 'return']);
Route::get('/payment/vnpay/ipn', [VnpayController::class, 'ipn']);
Route::get('/payment/vnpay/{orderId}', [VnpayController::class, 'payment'])->name('payment.vnpay')->middleware('auth');