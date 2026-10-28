<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amar Laundry - Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- File CSS Terpisah (disesuaikan dengan helper asset Laravel) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="flex flex-col justify-between min-h-screen relative overflow-x-hidden bg-teal-900">

    <!-- NAVBAR -->
    <header class="max-w-7xl mx-auto w-full px-6 pt-6 flex justify-between items-center relative z-20">
        <div class="flex items-center space-x-2">
            <div class="bg-[#ffc72c] text-gray-900 font-extrabold text-xl px-3 py-1 rounded-xl shadow-md">
                Amar.
            </div>
            <span class="text-xs bg-teal-800 text-teal-200 px-2 py-1 rounded-md hidden sm:inline-block">laundry express</span>
        </div>
        <nav class="flex space-x-2 text-xs font-bold">
            <a href="{{ url('/') }}" class="text-teal-100 hover:text-white px-4 py-2 rounded-full">Beranda</a>
            <a href="#" class="text-teal-100 hover:text-white px-4 py-2 rounded-full">Layanan & Harga</a>
            <a href="{{ route('login') }}" class="bg-[#ffc72c] text-gray-900 px-4 py-2 rounded-full">Login</a>
            <a href="#" class="text-teal-100 hover:text-white px-4 py-2 rounded-full">Pesan (Cash)</a>
            <a href="#" class="text-teal-100 hover:text-white px-3 py-2 sm:px-4 sm:py-2 rounded-full">Lacak</a>
        </nav>
    </header>

    <!-- FORM LOGIN -->
    <main class="max-w-md w-full mx-auto px-6 my-auto py-10 relative z-10">
        <div class="bg-white text-gray-900 rounded-3xl p-8 shadow-2xl border-4 border-teal-700/20">
            <div class="text-center mb-6">
                <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full">
                    Selamat Datang!
                </span>
                <h2 class="text-2xl font-extrabold mt-3 text-gray-900">Masuk Akun Amar Laundry</h2>
                <p class="text-xs text-gray-500 mt-1">Masukkan nomor WhatsApp atau email kamu</p>
            </div>

            <!-- Pesan Error jika Login Gagal -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border-2 border-red-300 rounded-xl text-xs text-red-800 font-bold">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form mengarah ke route POST /login -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nomor WhatsApp / Email</label>
                    <input type="text" name="email_or_whatsapp" value="{{ old('email_or_whatsapp') }}" placeholder="Contoh: admin@amarlaundry.com atau 08123456789" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                        <a href="#" class="text-xs font-bold text-teal-600 hover:underline">Lupa sandi?</a>
                    </div>
                    <input type="password" name="password" placeholder="••••••••" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm">
                </div>

                <div class="flex items-center space-x-2 pt-1">
                    <input type="checkbox" id="remember" name="remember" class="rounded text-teal-600">
                    <label for="remember" class="text-xs text-gray-600">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="w-full bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold py-3.5 rounded-xl shadow-lg transition cursor-pointer">
                    Masuk Sekarang
                </button>
            </form>

            <!-- Info Panduan Uji Coba Akun Default -->
            <div class="mt-6 pt-4 border-t border-gray-100 text-[11px] text-gray-400 space-y-1">
                <p class="font-bold text-gray-500">Akun Uji Coba:</p>
                <p>Admin: <span class="text-gray-700 font-mono">admin@amarlaundry.com</span> | Sandi: <span class="text-gray-700 font-mono">admin123</span></p>
                <p>Customer: <span class="text-gray-700 font-mono">081234567890</span> | Sandi: <span class="text-gray-700 font-mono">budi123</span></p>
            </div>
        </div>
    </main>

</body>
</html>