<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tambahkan fungsi ini untuk menampilkan halaman login
  public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email_or_whatsapp' => ['required'],
            'password' => ['required'],
        ]);

        $loginInput = $request->input('email_or_whatsapp');
        $password = $request->input('password');

        // 2. Deteksi apakah input berupa email atau nomor WhatsApp
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'whatsapp';

        // 3. Coba lakukan autentikasi (pencocokan data & password)
        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 4. Arahkan berdasarkan role masing-masing
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard-admin');
            } else {
                return redirect()->intended('/dashboard-customer');
            }
        }

        // 5. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email_or_whatsapp' => 'Nomor WhatsApp/Email atau Kata Sandi yang Anda masukkan salah.',
        ])->onlyInput('email_or_whatsapp');
    }
}