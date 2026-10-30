@extends('layouts.app')

@section('title', 'Amar Laundry - Lacak Cucian')

@section('content')
<div class="max-w-md w-full mx-auto px-6 py-10">
    <div class="bg-white text-gray-900 rounded-3xl p-8 shadow-2xl border-4 border-teal-700/20">
        <div class="text-center mb-6">
            <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full">Status Cucian</span>
            <h2 class="text-2xl font-extrabold mt-3 text-gray-900">Lacak Pesanan Amar</h2>
            <p class="text-xs text-gray-500 mt-1">Cek progres cucianmu secara real-time</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold mb-4 flex items-center space-x-2">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Cari Resi -->
        <form action="{{ route('lacak') }}" method="GET" class="flex space-x-2 mb-6">
            <input type="text" name="resi" value="{{ request('resi', $dummyOrder['order_code'] ?? '') }}" placeholder="Masukkan ID Resi (cth: AMAR-8829)" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-sm outline-none focus:border-[#0f8281] transition">
            <button type="submit" class="bg-[#0f8281] text-white px-5 rounded-xl font-bold text-xs hover:bg-teal-800 transition">Cari</button>
        </form>

        @isset($dummyOrder)
        <!-- Timeline Status (Tampil jika resi dicari) -->
        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 space-y-4">
            <div class="text-xs font-bold text-teal-700 mb-2">Hasil untuk Resi: {{ $dummyOrder['order_code'] }}</div>
            <div class="flex items-center space-x-3">
                <div class="w-7 h-7 bg-green-500 text-white rounded-full flex items-center justify-center text-xs font-bold">✓</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Pesanan Diterima</p>
                    <p class="text-[10px] text-gray-400">Atas nama: {{ $dummyOrder['customer_name'] }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-7 h-7 bg-teal-600 text-white rounded-full flex items-center justify-center text-xs font-bold">2</div>
                <div>
                    <p class="text-xs font-bold text-teal-700">Status: {{ $dummyOrder['status'] }}</p>
                    <p class="text-[10px] text-gray-400">Layanan: {{ $dummyOrder['service'] }}</p>
                </div>
            </div>
        </div>
        @endisset
    </div>
</div>
@endsection
