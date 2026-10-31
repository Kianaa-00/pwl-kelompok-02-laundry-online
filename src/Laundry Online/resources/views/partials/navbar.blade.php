<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Brand / Nama Aplikasi -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">Amar Laundry</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu Kiri -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('layanan') }}">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lacak') }}">Lacak Pesanan</a>
                </li>
                
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pesan') }}">Pesan Laundry</a>
                </li>
                @endauth

                <!-- Menu Khusus Admin/Kasir -->
                @auth
                    @if(auth()->user()->hasRole('admin', 'kasir'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Panel Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.kasir') }}">Kasir / POS</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.pesanan.index') }}">Data Pesanan</a></li>
                            @if(auth()->user()->hasRole('admin'))
                                <li><a class="dropdown-item" href="{{ route('admin.laporan') }}">Laporan Keuangan</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endauth
            </ul>

            <!-- Menu Kanan (Auth) -->
            <ul class="navbar-nav ms-auto align-items-lg-center">
                @auth
                    <li class="nav-item text-light small mx-lg-2">
                        {{ auth()->user()->name }} 
                        <span class="badge text-bg-warning text-dark">{{ auth()->user()->role }}</span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm px-3" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>