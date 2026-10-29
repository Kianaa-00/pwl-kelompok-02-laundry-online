@extends('layouts.app')

@section('title', 'Amar Laundry - Lacak Cucian')

@section('content')
<div class="max-w-lg w-full mx-auto px-6 py-10">
    <div class="bg-white text-gray-900 rounded-3xl p-6 sm:p-8 shadow-2xl border-4 border-teal-700/20">
        <div class="text-center mb-6">
            <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full">Status Cucian</span>
            <h2 class="text-2xl font-extrabold mt-3 text-gray-900">Lacak Pesanan Amar</h2>
            <p class="text-xs text-gray-500 mt-1">Pantau progres cucian dan penjemputan secara real-time</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold mb-6 flex items-start space-x-2">
                <span class="text-emerald-600 font-bold text-sm">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Cari Resi -->
        <form action="{{ route('lacak') }}" method="GET" class="flex space-x-2 mb-6">
            <input type="text" name="resi" value="{{ request('resi', $dummyOrder['order_code'] ?? '') }}" placeholder="Masukkan ID Resi (cth: AMAR-8829)" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-sm outline-none focus:border-[#0f8281] transition">
            <button type="submit" class="bg-[#0f8281] hover:bg-teal-800 text-white px-5 rounded-xl font-bold text-xs transition cursor-pointer">
                Cari
            </button>
        </form>

        @isset($dummyOrder)
        <!-- Kartu Rincian Pesanan Terlacak -->
        <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5 space-y-4">
            
            <!-- Resi & Status Header -->
            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Nomor Resi</p>
                    <p class="text-base font-black text-[#0f8281]">{{ $dummyOrder['order_code'] ?? $dummyOrder['resi'] }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Waktu Pesan</p>
                    <p class="text-xs font-bold text-gray-700">{{ $dummyOrder['created_at'] ?? now()->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <!-- Timeline Status -->
            <div class="space-y-3 py-1">
                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 bg-emerald-500 text-white rounded-full flex items-center justify-center text-xs font-bold shrink-0">✓</div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Pesanan Diterima & Terverifikasi</p>
                        <p class="text-[10px] text-gray-500">Atas nama: <span class="font-bold text-gray-700">{{ $dummyOrder['customer_name'] ?? $dummyOrder['nama'] }}</span> • {{ $dummyOrder['whatsapp'] ?? $dummyOrder['no_hp'] }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 bg-[#ffc72c] text-gray-900 rounded-full flex items-center justify-center text-xs font-extrabold shrink-0">⚡</div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Status Terkini:</p>
                        <span class="inline-block mt-0.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-teal-100 text-teal-800">
                            {{ $dummyOrder['status'] }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 bg-teal-700 text-white rounded-full flex items-center justify-center text-xs font-bold shrink-0">💵</div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Metode Pembayaran</p>
                        <p class="text-[10px] text-gray-500">{{ $dummyOrder['payment_method'] ?? 'Tunai (Cash di Tempat)' }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Alamat & Layanan -->
            <div class="bg-white p-3.5 rounded-xl border border-gray-200/80 text-xs space-y-1.5">
                <div class="flex justify-between">
                    <span class="text-gray-400">Layanan:</span>
                    <span class="font-extrabold text-gray-800">{{ $dummyOrder['service'] ?? $dummyOrder['layanan'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Tarif:</span>
                    <span class="font-bold text-teal-700">{{ $dummyOrder['price_rate'] ?? 'Rp 15.000 / kg' }}</span>
                </div>
                @if(!empty($dummyOrder['address']))
                <div class="pt-1 border-t border-gray-100">
                    <span class="text-gray-400 block mb-0.5">Alamat Penjemputan:</span>
                    <span class="text-gray-700 font-medium leading-relaxed block">{{ $dummyOrder['address'] }}</span>
                </div>
                @endif
                @if(!empty($dummyOrder['catatan']) && $dummyOrder['catatan'] !== '-')
                <div class="pt-1 border-t border-gray-100">
                    <span class="text-gray-400 block mb-0.5">Catatan:</span>
                    <span class="text-gray-600 italic block">{{ $dummyOrder['catatan'] }}</span>
                </div>
                @endif
            </div>

        </div>
        @endisset

        <div class="mt-6 text-center text-xs text-gray-500">
            <p>Ingin pesan cucian baru lagi? <a href="{{ route('pesan') }}" class="text-teal-600 font-bold hover:underline">Formulir Pesan</a></p>
        </div>

    </div>
</div>
@endsection
