@extends('layouts.app')

@section('title', 'Amar Laundry - Daftar Layanan & Harga')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10 w-full">
    <div class="text-center mb-8">
        <span class="bg-teal-800 text-teal-200 text-xs font-semibold px-3 py-1 rounded-full uppercase">Pricelist Amar Laundry</span>
        <h2 class="text-3xl font-extrabold mt-2 text-white">Daftar Layanan & Harga</h2>
        <p class="text-xs text-teal-100 opacity-80 mt-1">Pilih paket laundry sesuai kebutuhan kecepatan kamu</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($services as $service)
        <div class="bg-white text-gray-900 rounded-3xl p-6 shadow-xl border-4 {{ $service['tipe'] == 'express' ? 'border-[#ffc72c] relative' : 'border-teal-700/20' }} flex flex-col justify-between">
            @if($service['tipe'] == 'express')
                <span class="absolute -top-3 right-6 bg-[#ffc72c] text-gray-900 text-[10px] font-extrabold px-3 py-1 rounded-full uppercase">Paling Cepat</span>
            @endif
            <div>
                <div class="text-3xl mb-2">{{ $service['tipe'] == 'express' ? '⚡' : '🧺' }}</div>
                <h3 class="text-xl font-extrabold">{{ $service['nama'] }}</h3>
                <p class="text-xs text-gray-500 mt-1">{{ $service['deskripsi'] }}</p>
                
                <div class="my-6">
                    <span class="text-3xl font-extrabold text-[#0f8281]">Rp {{ number_format($service['harga'], 0, ',', '.') }}</span>
                    <span class="text-xs text-gray-400"> / Kg</span>
                </div>

                <ul class="text-xs text-gray-600 space-y-2 mb-6">
                    <li class="flex items-center">✓ Estimasi: {{ $service['estimasi'] }}</li>
                    <li class="flex items-center">✓ Higienis & Wangi Tahan Lama</li>
                    <li class="flex items-center">✓ Bayar Tunai (Cash di Tempat)</li>
                </ul>
            </div>
            <a href="{{ route('pesan') }}" class="block text-center w-full {{ $service['tipe'] == 'express' ? 'bg-[#ffc72c] hover:bg-yellow-400 text-gray-900' : 'bg-teal-800 hover:bg-teal-900 text-white' }} font-extrabold py-3 rounded-xl transition">
                Pilih Layanan Ini
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection