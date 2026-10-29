@extends('layouts.app')

@section('title', 'Amar Laundry - Pemesanan (Cash Only)')

@section('content')
<div class="max-w-xl w-full mx-auto px-6 py-10">
    <div class="bg-white text-gray-900 rounded-3xl p-6 sm:p-8 shadow-2xl border-4 border-teal-700/20">
        
        <div class="border-b border-gray-100 pb-4 mb-6 text-center">
            <span class="text-xs font-bold text-teal-700 bg-teal-50 px-3 py-1 rounded-full border border-teal-100">
                💵 Tunai di Tempat (Cash Only)
            </span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-3">Formulir Pesan Amar Laundry</h2>
            <p class="text-xs text-gray-500 mt-1">Pilih paket dan siapkan uang pas saat kurir tiba.</p>
        </div>

        <form action="{{ route('pesan.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Nama Anda" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">No. WhatsApp</label>
                    <input type="tel" name="whatsapp" placeholder="08123456789" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800">
                </div>
            </div>

            <div class="space-y-3">
                <label class="block text-xs font-extrabold uppercase text-gray-400 tracking-wider">Pilih Layanan</label>
                
                <label class="flex items-center justify-between p-4 rounded-2xl border-2 border-teal-600 bg-teal-50/50 cursor-pointer transition">
                    <div class="flex items-center space-x-3">
                        <input type="radio" name="layanan" value="Express" checked class="w-4 h-4 text-teal-600">
                        <div>
                            <p class="text-sm font-extrabold text-gray-900">Express (Selesai 3 Jam)</p>
                            <p class="text-xs text-gray-500">Rp 15.000 /kg</p>
                        </div>
                    </div>
                </label>

                <label class="flex items-center justify-between p-4 rounded-2xl border-2 border-gray-200 cursor-pointer transition">
                    <div class="flex items-center space-x-3">
                        <input type="radio" name="layanan" value="Reguler" class="w-4 h-4 text-teal-600">
                        <div>
                            <p class="text-sm font-extrabold text-gray-900">Reguler (Selesai 1 Hari)</p>
                            <p class="text-xs text-gray-500">Rp 8.000 /kg</p>
                        </div>
                    </div>
                </label>
            </div>

            <div>
                <label class="block text-xs font-extrabold uppercase text-gray-400 tracking-wider mb-1">Alamat Penjemputan</label>
                <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap rumah/kost kamu..." required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800"></textarea>
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start space-x-3">
                <span class="text-amber-600 font-bold text-lg">💡</span>
                <div class="text-xs text-amber-800 leading-relaxed">
                    <p class="font-bold">Ketentuan Pembayaran Tunai:</p>
                    <p>Pembayaran dilakukan secara tunai (Cash) langsung kepada kurir Amar Laundry saat penjemputan.</p>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold py-3.5 rounded-xl shadow-lg transition cursor-pointer">
                Konfirmasi Pesanan (Cash)
            </button>
        </form>

    </div>
</div>
@endsection