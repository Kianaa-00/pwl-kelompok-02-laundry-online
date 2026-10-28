<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect awal ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Rute Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute khusus setelah berhasil login (Dilindungi middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-admin', function () {
        return "Selamat datang di Dashboard Admin Amar Laundry!";
    });

    // Dashboard Customer
    Route::get('/dashboard-customer', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // Halaman Pemesanan Customer
    Route::get('/pesan', function () {
        return view('customer.pesan'); // Buat file view ini nanti jika diperlukan
    })->name('customer.pesan');
});