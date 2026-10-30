<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Amar Laundry - Express & Fresh')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- File CSS Publik -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="flex flex-col justify-between min-h-screen relative overflow-x-hidden bg-gradient-to-br from-teal-900 via-teal-800 to-gray-900 text-white">

    <!-- NAVBAR UTAMA -->
    <header class="max-w-7xl mx-auto w-full px-6 pt-6 flex justify-between items-center relative z-20">
        <div class="flex items-center space-x-2">
            <a href="{{ route('dashboard') }}" class="bg-[#ffc72c] text-gray-900 font-extrabold text-xl px-3 py-1 rounded-xl shadow-md">
                Amar.
            </a>
            <span class="text-xs bg-teal-800 text-teal-200 px-2 py-1 rounded-md hidden sm:inline-block font-medium">laundry express</span>
        </div>
        <nav class="navbar">
            <a href="{{ route('dashboard') }}" class="px-3 py-2 sm:px-4 sm:py-2 rounded-full transition {{ request()->routeIs('dashboard') ? 'bg-[#ffc72c] text-gray-900' : 'text-teal-100 hover:text-black' }}">Beranda</a>
            <a href="{{ route('layanan') }}" class="px-3 py-2 sm:px-4 sm:py-2 rounded-full transition {{ request()->routeIs('layanan') ? 'bg-[#ffc72c] text-gray-900' : 'text-teal-100 hover:text-white' }}">Layanan</a>
            <a href="{{ route('pesan') }}" class="px-3 py-2 sm:px-4 sm:py-2 rounded-full transition {{ request()->routeIs('pesan*') ? 'bg-[#ffc72c] text-gray-900' : 'text-teal-100 hover:text-white' }}">Pesan (Cash)</a>
            <a href="{{ route('lacak') }}" class="px-3 py-2 sm:px-4 sm:py-2 rounded-full transition {{ request()->routeIs('lacak*') ? 'bg-[#ffc72c] text-gray-900' : 'text-teal-100 hover:text-white' }}">Lacak</a>
            @guest
                <a href="{{ route('login') }}" class="px-3 py-2 sm:px-4 sm:py-2 rounded-full transition {{ request()->routeIs('login') ? 'bg-[#ffc72c] text-gray-900' : 'text-teal-100 hover:text-white' }}">Login</a>
            @else
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-2 sm:px-4 sm:py-2 rounded-full transition text-teal-100 hover:text-red-300">Logout</button>
                </form>
            @endguest
        </nav>
    </header>

    <!-- KONTEN UTAMA DINAMIS -->
    <main class="flex-grow flex items-center justify-center py-10">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-6 text-xs text-teal-200 opacity-80">
        <p>&copy; 2026 Amar Laundry Express. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>
