@extends('layouts.app')

@section('title', 'Amar Laundry - Pakaian Clean & Fresh')

@section('content')
<div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10 py-12">
    
    <!-- Sisi Kiri: Slogan -->
    <div class="space-y-6">
        <!-- Badge Welcome Sederhana -->
        <div class="inline-flex items-center bg-white text-gray-800 text-xs sm:text-sm font-bold px-4 py-2 rounded-full shadow-md">
            Selamat Datang di Amar Laundry
        </div>

        <!-- Judul & Slogan Utama -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
            CUCI BAJU DISINI<br>
            RESIK GASIK & ASIK!<br>
            <span class="text-[#ffc72c]"></span>
        </h1>

        <!-- Deskripsi Singkat -->
        <p class="text-teal-50 text-base sm:text-lg max-w-lg font-normal opacity-90 leading-relaxed">
            Serahkan urusan cucianmu pada kami. Pakaian bersih higienis, harum tahan lama, dan siap diantar langsung ke rumahmu.
        </p>

        <!-- Tombol Aksi Cepat -->
        <div class="flex flex-wrap gap-4 pt-2">
            <a href="{{ route('pesan') }}" class="bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold px-8 py-3.5 rounded-full shadow-lg transition transform hover:-translate-y-0.5">
                Pesan Sekarang
            </a>
            <a href="{{ route('layanan') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 font-bold px-7 py-3.5 rounded-full transition backdrop-blur-sm">
                Lihat Harga
            </a>
        </div>
    </div>

    <!-- Sisi Kanan: Visual Bersih Tanpa Info Lokasi -->
    <div class="relative flex justify-center items-center">
        <!-- Background Tulisan Korea Sederhana -->
        <div class="absolute -z-10 text-[140px] sm:text-[180px] font-black text-teal-700/20 select-none pointer-events-none top-[-50px]">
            세탁
        </div>

        <!-- Card Ilustrasi (Background Tosca diubah jadi nuansa biru muda/sky) -->
        <div class="relative w-full max-w-md bg-sky-200/50 p-6 rounded-3xl backdrop-blur-md border border-sky-300/40 shadow-2xl">
            <div class="relative bg-sky-500 rounded-2xl p-8 overflow-hidden flex items-center justify-center min-h-[320px]">
                
                <!-- Mesin Cuci Sederhana -->
                <div class="w-48 h-56 bg-white rounded-2xl border-4 border-gray-800 relative shadow-xl flex flex-col justify-between p-3">
                    <div class="flex justify-between items-center border-b-2 border-gray-800 pb-2">
                        <div class="flex space-x-1">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                        </div>
                        <div class="w-8 h-2 bg-gray-200 rounded"></div>
                    </div>
                    <div class="w-32 h-32 rounded-full border-4 border-gray-800 bg-sky-200 mx-auto flex items-center justify-center relative overflow-hidden">
                        <div class="w-24 h-24 rounded-full bg-sky-400 opacity-70 animate-pulse"></div>
                    </div>
                    <div class="h-2 bg-gray-300 rounded"></div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
