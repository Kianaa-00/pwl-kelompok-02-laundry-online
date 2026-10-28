<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amar Laundry - Dashboard Customer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col justify-between min-h-screen relative overflow-x-hidden bg-teal-950 text-white">

    <!-- NAVBAR -->
    <header class="max-w-7xl mx-auto w-full px-6 pt-6 flex justify-between items-center relative z-20">
        <div class="flex items-center space-x-2">
            <div class="bg-[#ffc72c] text-gray-900 font-extrabold text-xl px-3 py-1 rounded-xl shadow-md">
                Amar.
            </div>
            <span class="text-xs bg-teal-800 text-teal-200 px-2 py-1 rounded-md hidden sm:inline-block font-medium">customer portal</span>
        </div>
        <nav class="flex space-x-1 sm:space-x-2 text-xs font-bold items-center">
            <a href="{{ route('customer.dashboard') }}" class="bg-[#ffc72c] text-gray-900 px-3 py-2 sm:px-4 sm:py-2 rounded-full">Beranda</a>
            <a href="#" class="text-teal-100 hover:text-white px-3 py-2 sm:px-4 sm:py-2 rounded-full">Layanan</a>
            <a href="{{ route('customer.pesan') }}" class="text-teal-100 hover:text-white px-4 py-2 rounded-full">Pesan</a>
            <a href="#" class="text-teal-100 hover:text-white px-3 py-2 sm:px-4 sm:py-2 rounded-full">Lacak</a>
            
            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-full transition">Logout</button>
            </form>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <main class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10 my-auto py-12">
        
        <!-- Sisi Kiri: Ucapan & Slogan Khas -->
        <div class="space-y-6">
            <div class="inline-flex items-center bg-white text-gray-800 text-xs sm:text-sm font-bold px-4 py-2 rounded-full shadow-md">
                ✨ Selamat Datang Kembali di Amar Laundry
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                CUCI BAJU DISINI<br>
                RESIK GASIK & ASIK!<br>
            </h1>

            <p class="text-teal-50 text-base sm:text-lg max-w-lg font-normal opacity-90 leading-relaxed">
                Serahkan urusan cucianmu pada kami. Pakaian bersih higienis, harum tahan lama, dan siap diantar langsung ke rumahmu.
            </p>

            <!-- Tombol Aksi Cepat ke Pesan & Lacakan -->
            <div class="flex flex-wrap gap-4 pt-2">
                <a href="{{ route('customer.pesan') }}" class="bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold px-8 py-3.5 rounded-full shadow-lg transition transform hover:-translate-y-0.5">
                    Pesan Sekarang
                </a>
                <a href="#" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 font-bold px-7 py-3.5 rounded-full transition backdrop-blur-sm">
                    Lacak Pesanan Saya
                </a>
            </div>
        </div>

        <!-- Sisi Kanan: Visual Ilustrasi -->
        <div class="relative flex justify-center items-center">
            <div class="absolute -z-10 text-[140px] sm:text-[180px] font-black text-teal-700/20 select-none pointer-events-none top-[-50px]">
                세탁
            </div>

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

    </main>

</body>
</html>