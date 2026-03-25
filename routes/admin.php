<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoaiSPController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\NguoiDungController;
use App\Http\Controllers\Admin\ThongKeController;

// Prefix: admin, tên route: admin.*
Route::prefix('admin')->name('admin.')->group(function () {

    // ===== CHƯA LOGIN =====
    Route::get('/login', [AdminController::class,'loginForm'])->name('login');
    Route::post('/login', [AdminController::class,'login'])->name('login.submit');

    Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');

        // Logout
        Route::post('logout', [AdminController::class,'logout'])->name('logout');

        // ===== DANH MỤC (loaisp) =====
        Route::get('loaisp', [LoaiSPController::class,'index'])->name('loaisp.index');

        Route::get('loaisp/create', [LoaiSPController::class,'create'])->name('loaisp.create');
        Route::post('loaisp', [LoaiSPController::class,'store'])->name('loaisp.store');
        Route::get('loaisp/{id}/edit', [LoaiSPController::class,'edit'])->name('loaisp.edit');
        Route::put('loaisp/{id}', [LoaiSPController::class,'update'])->name('loaisp.update');
        Route::delete('loaisp/{id}', [LoaiSPController::class,'destroy'])->name('loaisp.destroy');
        Route::get('loaisp/search', [LoaiSPController::class,'search'])->name('loaisp.search');
        Route::get('/sanpham/filter', [SanPhamController::class,'filterByCategory'])->name('sanpham.filter');

        // ===== SẢN PHẨM (sanpham) =====
Route::get('sanpham', [SanPhamController::class,'index'])->name('sanpham.index');
Route::get('sanpham/create', [SanPhamController::class,'create'])->name('sanpham.create');
Route::post('sanpham', [SanPhamController::class,'store'])->name('sanpham.store');
Route::get('sanpham/{id}/edit', [SanPhamController::class,'edit'])->name('sanpham.edit');
Route::put('sanpham/{id}', [SanPhamController::class,'update'])->name('sanpham.update');
Route::delete('sanpham/{id}', [SanPhamController::class,'destroy'])->name('sanpham.destroy');
Route::get('sanpham/search', [SanPhamController::class,'search'])->name('sanpham.search');

        // ===== ĐƠN HÀNG (donhang) =====
      Route::get('donhang', [DonHangController::class,'index'])->name('donhang.index');

Route::get('donhang/{id}', [DonHangController::class,'show'])->name('donhang.show');

Route::post('donhang/{id}/status', [DonHangController::class,'updateStatus'])->name('donhang.status');


        // ===== NGƯỜI DÙNG (nguoidung) =====
    Route::get('nguoidung', [NguoiDungController::class, 'index'])->name('nguoidung.index');
    Route::get('nguoidung/search', [NguoiDungController::class, 'search'])->name('nguoidung.search');
    Route::get('nguoidung/{id}', [NguoiDungController::class, 'show'])->name('nguoidung.show');
    Route::patch('nguoidung/{id}/toggle-status', [NguoiDungController::class, 'toggleStatus'])->name('nguoidung.toggleStatus');

        // ===== THỐNG KÊ =====
        Route::get('thongke', [ThongKeController::class,'index'])->name('thongke.index');
        Route::get('thongke/doanhthu', [ThongKeController::class,'revenue'])->name('thongke.doanhthu');
    });
});