@extends('layouts.app')

@section('title', '403 - Akses Ditolak | Amar Laundry')

@section('content')
<div class="max-w-lg w-full mx-auto px-6 py-12">
    <div class="bg-white text-gray-900 rounded-3xl p-8 sm:p-10 shadow-2xl border-4 border-amber-500/30 text-center relative overflow-hidden">
        
        <!-- Badge Header -->
        <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-50 rounded-3xl mb-4 border-2 border-amber-200 shadow-inner">
            <span class="text-4xl">🚫</span>
        </div>

        <div class="space-y-2">
            <span class="bg-amber-100 text-amber-800 text-[11px] font-extrabold uppercase px-3 py-1 rounded-full tracking-wider border border-amber-200">
                Peringatan Keamanan • HTTP 403
            </span>
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900">Area Khusus Administrator</h1>
            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-sm mx-auto">
                {{ $exception->getMessage() ?: 'Halaman ini merupakan ranah pengelola Amar Laundry. Pelanggan biasa tidak diperbolehkan mengakses halaman ini.' }}
            </p>
        </div>

        <!-- Info Akun yang Sedang Login -->
        @auth
        <div class="mt-6 p-4 bg-gray-50 rounded-2xl border border-gray-200 text-left text-xs space-y-1.5">
            <div class="flex justify-between items-center pb-1.5 border-b border-gray-200/80">
                <span class="text-gray-500 font-medium">Akun Terhubung:</span>
                <span class="font-extrabold text-gray-800">{{ Auth::user()->name }}</span>
            </div>
            <div class="flex justify-between items-center pb-1.5 border-b border-gray-200/80">
                <span class="text-gray-500 font-medium">Peran (Role):</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-100 text-blue-800 capitalize">
                    {{ Auth::user()->role }}
                </span>
            </div>
            <p class="text-[10px] text-amber-700 italic pt-1 text-center">
                Jika Anda adalah staff pengelola, silakan masuk menggunakan akun Admin.
            </p>
        </div>
        @endauth

        <!-- Tombol Aksi -->
        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-6 py-3 bg-[#0f8281] hover:bg-teal-800 text-white font-extrabold rounded-xl text-xs shadow-md transition flex items-center justify-center space-x-1.5">
                <span>← Kembali ke Beranda</span>
            </a>
            
            @auth
            <form action="{{ route('logout') }}" method="POST" class="inline w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-xl text-xs transition">
                    Ganti Akun Admin
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-6 py-3 bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-xs shadow-md transition">
                Masuk sebagai Admin
            </a>
            @endauth
        </div>

    </div>
</div>
@endsection
