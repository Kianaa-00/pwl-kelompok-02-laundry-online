<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\FinanceController;

// Rute Halaman Publik / Beranda
Route::get('/', [PageController::class, 'index'])->name('dashboard');

// Halaman Daftar Layanan (Regular & Express)
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');

// Rute Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Form Pemesanan
Route::get('/pesan', [OrderController::class, 'create'])->name('pesan');
Route::post('/pesan', [OrderController::class, 'store'])->name('pesan.store');

// Halaman Pelacakan (Lacak Status Pesanan)
Route::get('/lacak', [OrderController::class, 'lacakIndex'])->name('lacak');
Route::get('/lacak/{resi}', [OrderController::class, 'lacakDetail'])->name('lacak.detail');

// Rute Khusus Admin (Dilindungi Auth Middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboardadmn', [DashboardController::class, 'index'])->name('dashboardadmn'); // alias
    
    // Kasir / POS (Cash Only)
    Route::get('/kasir', [CashierController::class, 'index'])->name('kasir');
    Route::post('/kasir/store', [CashierController::class, 'store'])->name('kasir.store');
    
    // Manajemen Data Pesanan
    Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('pesanan.index');
    Route::get('/datapesan', [AdminOrderController::class, 'index'])->name('datapesan'); // alias
    Route::patch('/pesanan/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('pesanan.update');
    
    // Laporan Keuangan
    Route::get('/laporan', [FinanceController::class, 'index'])->name('laporan');
});
