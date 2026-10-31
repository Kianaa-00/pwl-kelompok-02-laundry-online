@extends('layouts.admin')

@section('title', 'Kasir & POS - Amar Laundry')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- FORM INPUT KASIR -->
    <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 space-y-6">
        <div>
            <span class="text-xs font-bold bg-teal-100 text-teal-800 px-3 py-1 rounded-full">Sistem POS Tunai</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-2">Input Cucian Pelanggan (Walk-in)</h2>
            <p class="text-xs text-gray-500">Catat pesanan pelanggan langsung di gerai (Metode Pembayaran: Cash Only).</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold flex items-center space-x-2">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.kasir.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Pelanggan</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Contoh: Siti Aminah" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">No. WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder="0812xxxxxxxx" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Pilih Layanan</label>
                    <select name="service_type" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm bg-white">
                        <option value="express">Express 3 Jam (Rp 15.000/Kg)</option>
                        <option value="reguler">Reguler 1 Hari (Rp 8.000/Kg)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Berat Cucian (Kg)</label>
                    <input type="number" step="0.1" min="0.1" name="weight" value="{{ old('weight') }}" required placeholder="Contoh: 3.5" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold py-3.5 rounded-xl shadow-lg transition">
                Cetak Nota & Simpan Transaksi
            </button>
        </form>
    </div>

    <!-- RINGKASAN KASIR HARI INI -->
    <div class="bg-teal-900 text-white rounded-3xl p-6 shadow-xl flex flex-col justify-between space-y-6">
        <div>
            <h3 class="text-lg font-extrabold text-[#ffc72c]">Ringkasan Shift Hari Ini</h3>
            <p class="text-xs text-teal-200 mt-1">Verifikasi kas fisik secara berkala.</p>
        </div>
        <div class="space-y-4">
            <div class="bg-teal-800/80 p-4 rounded-2xl border border-teal-700">
                <p class="text-[10px] uppercase font-bold text-teal-300">Total Transaksi Tunai</p>
                <h4 class="text-2xl font-black mt-1">{{ $todayOrdersCount ?? 14 }} Nota</h4>
            </div>
            <div class="bg-teal-800/80 p-4 rounded-2xl border border-teal-700">
                <p class="text-[10px] uppercase font-bold text-teal-300">Estimasi Pendapatan Kas</p>
                <h4 class="text-2xl font-black text-[#ffc72c] mt-1">Rp {{ number_format($todayIncome ?? 485000, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="text-[10px] text-teal-300 text-center">
            Amar Laundry POS v1.1 • Laravel 11
        </div>
    </div>
</div>
@endsection
