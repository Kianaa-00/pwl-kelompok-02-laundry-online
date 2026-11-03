@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan | Amar Laundry')

@section('content')
<div class="max-w-md w-full mx-auto px-6 py-12 text-center">
    <div class="bg-white text-gray-900 rounded-3xl p-8 shadow-2xl border-4 border-teal-700/20">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-teal-50 rounded-3xl mb-4 border-2 border-teal-100">
            <span class="text-4xl">🧺</span>
        </div>
        
        <span class="bg-teal-100 text-teal-800 text-xs font-extrabold px-3 py-1 rounded-full uppercase">
            Error 404 • Halaman Kosong
        </span>

        <h2 class="text-2xl font-black mt-3 text-gray-900">Halaman Tidak Ditemukan</h2>
        <p class="text-xs text-gray-500 mt-2 leading-relaxed">
            Halaman yang Anda tuju mungkin sudah dipindahkan, dihapus, atau alamat URL yang Anda masukkan salah.
        </p>

        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('dashboard') }}" class="px-5 py-3 bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-xs shadow-md transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('pesan') }}" class="px-5 py-3 bg-[#0f8281] hover:bg-teal-800 text-white font-extrabold rounded-xl text-xs shadow-md transition">
                Pesan Laundry
            </a>
        </div>
    </div>
</div>
@endsection
