@extends('layouts.admin')

@section('title', 'Data Pesanan - Amar Laundry')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-4 border-teal-700/20 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900">Kelola Data Pesanan Masuk</h2>
            <p class="text-xs text-gray-500">Perbarui status cucian pelanggan dari proses cuci hingga siap diantar.</p>
        </div>
        <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1.5 rounded-full">
            Total: {{ isset($orders) ? count($orders) : 0 }} Pesanan Aktif
        </span>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold flex items-center space-x-2">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabel Pesanan -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="bg-teal-900 text-white uppercase text-[10px] tracking-wider">
                    <th class="p-3.5 rounded-l-xl">Kode Resi</th>
                    <th class="p-3.5">Pelanggan</th>
                    <th class="p-3.5">Layanan</th>
                    <th class="p-3.5">Status Saat Ini</th>
                    <th class="p-3.5 rounded-r-xl text-center">Aksi Ubah Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders ?? [] as $order)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-3.5 font-extrabold text-[#0f8281]">{{ $order['resi'] }}</td>
                    <td class="p-3.5 font-bold text-gray-900">
                        {{ $order['nama'] }}<br>
                        <span class="text-[10px] font-normal text-gray-500">{{ $order['no_hp'] }}</span>
                    </td>
                    <td class="p-3.5">{{ $order['layanan'] }}</td>
                    <td class="p-3.5">
                        <span class="px-2.5 py-1 rounded-full font-bold text-[10px] 
                            {{ $order['status'] == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : ($order['status'] == 'Sedang Dicuci' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800') }}">
                            {{ $order['status'] }}
                        </span>
                    </td>
                    <td class="p-3.5 text-center">
                        <form action="{{ route('admin.pesanan.update', $order['id']) }}" method="POST" class="inline-flex items-center space-x-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="text-xs border-2 border-gray-200 rounded-lg px-2 py-1 outline-none focus:border-teal-600 bg-white">
                                <option value="Menunggu Cuci" {{ $order['status'] == 'Menunggu Cuci' ? 'selected' : '' }}>Menunggu Cuci</option>
                                <option value="Sedang Dicuci" {{ $order['status'] == 'Sedang Dicuci' ? 'selected' : '' }}>Sedang Dicuci</option>
                                <option value="Menunggu Antar" {{ $order['status'] == 'Menunggu Antar' ? 'selected' : '' }}>Menunggu Antar</option>
                                <option value="Selesai" {{ $order['status'] == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold px-3 py-1 rounded-lg text-xs shadow transition">
                                Simpan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-400 text-xs">Belum ada pesanan aktif.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
