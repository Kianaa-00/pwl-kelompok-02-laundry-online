@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Amar Laundry')

@section('content')
<div class="space-y-6">
    <!-- Header Laporan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-xs font-bold bg-teal-100 text-teal-800 px-3 py-1 rounded-full">Audit Finansial</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-2">Laporan Keuangan & Rekap Pendapatan</h2>
            <p class="text-xs text-gray-500">Rekapitulasi pemasukan tunai harian, bulanan, serta statistik layanan Amar Laundry.</p>
        </div>
        <div class="bg-teal-900 text-white p-4 rounded-2xl shadow-md text-right">
            <p class="text-[10px] text-teal-200 uppercase font-bold">Total Pendapatan Bulan Ini</p>
            <h3 class="text-xl font-black text-[#ffc72c] mt-0.5">Rp {{ number_format($totalRevenue ?? 4850000, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- === STATISTIK & KOMPARASI REGULER VS EXPRESS === -->
    @php
        $reg = $regulerCount ?? 18;
        $exp = $expressCount ?? 7;
        $totalOrder = ($reg + $exp) > 0 ? ($reg + $exp) : 1;
        $regPercent = round(($reg / $totalOrder) * 100);
        $expPercent = round(($exp / $totalOrder) * 100);
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Layanan Reguler -->
        <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-teal-700/20 space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <span class="bg-blue-100 text-blue-800 text-[10px] font-extrabold px-3 py-1 rounded-full">Standar</span>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-2">Layanan Reguler</h3>
                </div>
                <span class="text-2xl font-black text-blue-600">{{ $reg }} <span class="text-xs font-normal text-gray-500">Pesanan</span></span>
            </div>
            <div class="text-xs text-gray-500 flex justify-between border-t border-gray-100 pt-3">
                <span>Estimasi Pendapatan:</span>
                <span class="font-bold text-gray-800">Rp {{ number_format($regulerRevenue ?? 2160000, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Card Layanan Express -->
        <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-teal-700/20 space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <span class="bg-amber-100 text-amber-800 text-[10px] font-extrabold px-3 py-1 rounded-full">Kilat</span>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-2">Layanan Express</h3>
                </div>
                <span class="text-2xl font-black text-amber-600">{{ $exp }} <span class="text-xs font-normal text-gray-500">Pesanan</span></span>
            </div>
            <div class="text-xs text-gray-500 flex justify-between border-t border-gray-100 pt-3">
                <span>Estimasi Pendapatan:</span>
                <span class="font-bold text-gray-800">Rp {{ number_format($expressRevenue ?? 2690000, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Grafik Komparasi Visual (Progress Bar Perbandingan) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-base font-extrabold text-gray-900">Komparasi Preferensi Customer (Reguler vs Express)</h3>
            <span class="text-xs font-bold text-gray-500">Total: {{ $reg + $exp }} Transaksi</span>
        </div>
        
        <div class="space-y-2">
            <div class="flex justify-between text-xs font-bold">
                <span class="text-blue-700">Reguler ({{ $regPercent }}%)</span>
                <span class="text-amber-700">Express ({{ $expPercent }}%)</span>
            </div>
            <!-- Progress Bar Komparasi -->
            <div class="w-full h-4 bg-gray-100 rounded-full overflow-hidden flex shadow-inner">
                <div class="bg-blue-600 h-full transition-all duration-500" style="width: {{ $regPercent }}%"></div>
                <div class="bg-[#ffc72c] h-full transition-all duration-500" style="width: {{ $expPercent }}%"></div>
            </div>
        </div>
        <p class="text-[11px] text-gray-400 italic text-center pt-1">Grafik komparasi persentase pilihan layanan yang digunakan oleh pelanggan pada periode ini.</p>
    </div>
    <!-- ======================================================= -->
<!-- Grafik Pemasukan Mingguan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20">
        <h3 class="text-base font-extrabold text-gray-900 mb-4">Grafik Pemasukan Mingguan</h3>
        <div class="h-64 flex items-center justify-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 text-gray-400 text-xs">
            [ Chart.js Render Area - Pemasukan Tunai Harian ]
        </div>
    </div>
</div>
@endsection