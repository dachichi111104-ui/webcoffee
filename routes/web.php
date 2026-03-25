<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\SanPhamController;
use App\Http\Controllers\User\GioHangController;
use App\Http\Controllers\User\DonHangController;
use App\Http\Controllers\User\UserController;

Route::middleware('web')->group(function () {
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [SanPhamController::class, 'index'])->name('menu');
Route::get('/store', [HomeController::class, 'store'])->name('store');
Route::get('/story', [HomeController::class, 'story'])->name('story');
Route::get('/voucher', [HomeController::class, 'voucher'])->name('voucher');

  // Sản phẩm
    Route::get('/products', [SanPhamController::class,'index'])->name('products.index');
    Route::get('/products/{idsp}', [SanPhamController::class,'show'])->name('products.show');
Route::get('/search', [SanPhamController::class, 'search'])->name('products.search');

    // Auth
Route::post('/register', [AuthController::class,'register'])->name('register');

Route::post('/login', [AuthController::class,'login'])->name('login');

// Giỏ hàng
    Route::get('/cart', [GioHangController::class,'index']);
    Route::post('/cart', [GioHangController::class,'store']);
    Route::put('/cart/{id}', [GioHangController::class,'update']);
    Route::delete('/cart/{id}', [GioHangController::class,'destroy']);

  Route::middleware('auth')->group(function () {
 Route::post('/checkout', [DonHangController::class, 'store'])->name('checkout.store');
    Route::get('/user', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
 Route::post('/user/orders/{id}/cancel', [DonHangController::class, 'cancel']);
 
    Route::post('/logout', [AuthController::class,'logout'])->name('auth.logout');

    });
});
