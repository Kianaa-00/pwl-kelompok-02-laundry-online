<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Amar Laundry - Admin Panel')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js untuk Laporan Keuangan -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

    <!-- NAVBAR ADMIN -->
    <header class="bg-teal-900 text-white shadow-lg relative z-20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.dashboard') }}" class="bg-[#ffc72c] text-gray-900 font-extrabold text-xl px-3 py-1 rounded-xl shadow-md">
                    Amar.
                </a>
                <span class="text-xs bg-teal-800 text-teal-200 px-2 py-1 rounded-md hidden sm:inline-block border border-teal-700 font-semibold">Admin Panel</span>
            </div>

            <!-- Navigasi Admin -->
            <nav class="hidden md:flex space-x-1 text-xs font-bold">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full transition {{ request()->routeIs('admin.dashboard*') ? 'bg-[#ffc72c] text-gray-900 shadow' : 'text-teal-100 hover:text-white' }}">Dashboard</a>
                <a href="{{ route('admin.kasir') }}" class="px-4 py-2 rounded-full transition {{ request()->routeIs('admin.kasir*') ? 'bg-[#ffc72c] text-gray-900 shadow' : 'text-teal-100 hover:text-white' }}">Kasir (POS)</a>
                <a href="{{ route('admin.pesanan.index') }}" class="px-4 py-2 rounded-full transition {{ request()->routeIs('admin.pesanan*') ? 'bg-[#ffc72c] text-gray-900 shadow' : 'text-teal-100 hover:text-white' }}">Data Pesanan</a>
                <a href="{{ route('admin.laporan') }}" class="px-4 py-2 rounded-full transition {{ request()->routeIs('admin.laporan*') ? 'bg-[#ffc72c] text-gray-900 shadow' : 'text-teal-100 hover:text-white' }}">Laporan Keuangan</a>
            </nav>

            <div class="flex items-center space-x-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-white">{{ Auth::user()->name ?? 'Kasir Utama' }}</p>
                    <p class="text-[10px] text-teal-200">Shift Pagi • Cash Only</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-teal-800 hover:bg-teal-700 text-teal-100 px-3 py-1.5 rounded-xl text-xs font-bold transition border border-teal-700">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- KONTEN UTAMA ADMIN -->
    <main class="max-w-7xl w-full mx-auto px-6 py-8 flex-1 space-y-8">
        @yield('content')
    </main>

    <!-- FOOTER ADMIN -->
    <footer class="bg-teal-900 text-teal-200 text-center py-4 text-xs mt-auto border-t border-teal-800">
        <p>&copy; 2026 Amar Laundry Express - Panel Pengelola Operasional</p>
    </footer>

</body>
</html>
