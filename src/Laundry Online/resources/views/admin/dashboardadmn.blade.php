@extends('layouts.admin')

@section('title', 'Dashboard Admin - Amar Laundry')

@section('content')
<div class="space-y-8">
    
    <!-- HEADER SELAMAT DATANG -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-xs font-bold bg-teal-100 text-teal-800 px-3 py-1 rounded-full">Panel Pengelola Utama</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mt-2">Selamat Datang, Admin! 👋</h2>
            <p class="text-xs text-gray-500 mt-1">Berikut adalah ringkasan operasional dan status cucian harian Amar Laundry.</p>
        </div>
        <div class="bg-teal-900 text-white px-5 py-3 rounded-2xl shadow-md text-center">
            <p class="text-[10px] text-teal-200 uppercase font-bold">Status Sistem</p>
            <p class="text-xs font-bold text-emerald-400 mt-0.5">● Operasional Normal</p>
        </div>
    </div>

    <!-- KARTU STATISTIK (METRIK) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-teal-700/20">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['total_pesanan'] }}</h3>
            <span class="text-[10px] text-teal-600 font-bold mt-2 inline-block">↑ Terus bertambah minggu ini</span>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-teal-700/20">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pendapatan Hari Ini</p>
            <h3 class="text-3xl font-black text-[#0f8281] mt-2">Rp {{ number_format($stats['pendapatan_hari_ini'], 0, ',', '.') }}</h3>
            <span class="text-[10px] text-emerald-600 font-bold mt-2 inline-block">Tunai (Cash Only)</span>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-teal-700/20">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Cucian Diproses</p>
            <h3 class="text-3xl font-black text-amber-600 mt-2">{{ $stats['cucian_diproses'] }}</h3>
            <span class="text-[10px] text-amber-600 font-bold mt-2 inline-block">Sedang dikerjakan</span>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-teal-700/20">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pelanggan Terdaftar</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['pelanggan_aktif'] }}</h3>
            <span class="text-[10px] text-teal-600 font-bold mt-2 inline-block">Akun aktif</span>
        </div>
    </div>

    <!-- TABEL PESANAN TERBARU -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-xl font-extrabold text-gray-900">Pesanan Masuk Terbaru</h3>
                <p class="text-xs text-gray-500">Daftar transaksi cucian yang baru saja masuk ke sistem.</p>
            </div>
            <a href="{{ route('admin.pesanan.index') }}" class="text-xs font-bold text-teal-700 hover:underline">Lihat Semua →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-teal-900 text-white uppercase text-[10px] tracking-wider">
                        <th class="p-3.5 rounded-l-xl">No. Resi</th>
                        <th class="p-3.5">Nama Pelanggan</th>
                        <th class="p-3.5">Layanan</th>
                        <th class="p-3.5">Berat</th>
                        <th class="p-3.5 rounded-r-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-3.5 font-extrabold text-[#0f8281]">{{ $order['resi'] }}</td>
                        <td class="p-3.5 font-bold text-gray-900">{{ $order['nama'] }}</td>
                        <td class="p-3.5">{{ $order['layanan'] }}</td>
                        <td class="p-3.5">{{ $order['berat'] }}</td>
                        <td class="p-3.5">
                            <span class="px-2.5 py-1 rounded-full font-bold text-[10px] 
                                {{ $order['status'] == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $order['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection