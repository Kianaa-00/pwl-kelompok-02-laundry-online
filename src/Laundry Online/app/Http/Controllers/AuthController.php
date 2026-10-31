<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses login (mendukung input Email atau Nomor WhatsApp)
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $input = trim($request->input('email'));

        // Cek apakah input berupa email atau nomor WhatsApp
        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'whatsapp';

        $credentials = [
            $fieldType => $input,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Pemisahan pengalihan berdasarkan Role
            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Nomor WhatsApp / Email atau kata sandi yang Anda masukkan salah.'])
            ->onlyInput('email');
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah berhasil logout.');
    }
}
