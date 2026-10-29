<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;

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
