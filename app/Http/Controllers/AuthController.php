<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Memproses login dan memeriksa hak akses (role)
    public function authenticate(Request $request)
    {
        $request->validate([
            'email_or_phone' => ['required'],
            'password' => ['required'],
        ]);

        $input = $request->email_or_phone;
        // Cek apakah input berupa email atau nomor WhatsApp
        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'whatsapp';

        // Proses Auth bawaan Laravel
        if (Auth::attempt([$fieldType => $input, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            // LOGIKA PEMISAHAN AKSES (ROLE-BASED REDIRECTION)
            if (($user->role ?? null) === 'admin' && Route::has('admin.dashboard')) {
                // Jika admin, arahkan ke panel pengelola
                return redirect()->intended(route('admin.dashboard'));
            } else {
                // Jika pelanggan biasa, arahkan ke halaman beranda
                return redirect()->intended(route('dashboard'));
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email_or_phone' => 'Nomor WhatsApp/Email atau kata sandi yang Anda masukkan salah.',
        ])->withInput();
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
