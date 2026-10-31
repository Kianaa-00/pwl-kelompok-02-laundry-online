@extends('layouts.app')

@section('title', 'Amar Laundry - Masuk Akun')

@section('content')
<div class="max-w-md w-full mx-auto px-6 py-10">
    <div class="bg-white text-gray-900 rounded-3xl p-8 shadow-2xl border-4 border-teal-700/20">
        <div class="text-center mb-6">
            <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full">Login Pelanggan / Kasir</span>
            <h2 class="text-2xl font-extrabold mt-3 text-gray-900">Selamat Datang</h2>
            <p class="text-xs text-gray-500 mt-1">Masuk dengan Email atau Nomor WhatsApp</p>
        </div>

        @if(isset($errors) && $errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email atau No. WhatsApp</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="nama@email.com atau 08123456789" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800 transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kata Sandi</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800 transition">
            </div>

            <button type="submit" class="w-full bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold py-3.5 rounded-xl shadow-lg transition">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-500">
            <p>Belum punya akun? Pesan langsung secara tunai di halaman <a href="{{ route('pesan') }}" class="text-teal-600 font-bold hover:underline">Pesan Laundry</a>.</p>
        </div>
    </div>
</div>
@endsection
