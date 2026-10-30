@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Amar Laundry')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-xs font-bold bg-teal-100 text-teal-800 px-3 py-1 rounded-full">Audit Finansial</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-2">Laporan Keuangan & Rekap Pendapatan</h2>
            <p class="text-xs text-gray-500">Rekapitulasi pemasukan tunai harian dan bulanan Amar Laundry.</p>
        </div>
        <div class="bg-teal-900 text-white p-4 rounded-2xl shadow-md text-right">
            <p class="text-[10px] text-teal-200 uppercase font-bold">Total Pendapatan Bulan Ini</p>
            <h3 class="text-xl font-black text-[#ffc72c] mt-0.5">Rp {{ number_format($totalRevenue ?? 4850000, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Grafik Sederhana / Tabel Ringkasan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20">
        <h3 class="text-base font-extrabold text-gray-900 mb-4">Grafik Pemasukan Mingguan</h3>
        <div class="h-64 flex items-center justify-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 text-gray-400 text-xs">
            [ Chart.js Render Area - Pemasukan Tunai Harian ]
        </div>
    </div>
</div>
@endsection
