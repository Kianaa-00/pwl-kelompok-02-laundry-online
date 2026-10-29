<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🧼 Amar Laundry Express - Web Application (Minggu 03)

Aplikasi manajemen dan pemesanan layanan laundry berbasis web yang dikembangkan menggunakan **Laravel 13** dan **Tailwind CSS**. Proyek ini disusun untuk memenuhi **Tugas Minggu 3 Praktikum Pemrograman Web Lanjut (PWL)**.

---

## 👥 Tim Pengembang (Kelompok 02)

| Nama Mahasiswa | NIM | Peran & Tanggung Jawab Utama |
| :--- | :--- | :--- |
| **Amar Albar** | 25170017 | Koordinator Projek (Project Management & Task Allocation) |
| **Naufal Kresna Putra Ardy** | 25170009 | Backend Engineer (API Logic & Core Business Process) |
| **Anrico Wibowo** | 25170019 | Frontend Engineer (UI Templates & User Interface Design) |
| **Andhika Meisteva** | 25170016 | Database Architect & QA Documentation Lead |

---

## 📌 Informasi Repository & Versi

* **Repository:** [pwl-kelompok-02-laundry-online](https://github.com/Kianaa-00/pwl-kelompok-02-laundry-online.git)
* **Tag Tugas:** `minggu-03`
* **Framework Version:** Laravel 13.x
* **PHP Version:** >= 8.5

---

## 💻 Panduan Instalasi & Penggunaan Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer/laptop anggota kelompok:

1. **Clone Repository:**
   ```bash
   git clone [https://github.com/Kianaa-00/pwl-kelompok-02-laundry-online.git](https://github.com/Kianaa-00/pwl-kelompok-02-laundry-online.git)
   cd pwl-kelompok-02-laundry-online
   ```

2. **Install Dependensi PHP & JavaScript:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment File:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan Asset Compiler & Web Server Laravel:**
   ```bash
   # Terminal 1: Kompilasi Tailwind CSS
   npm run dev

   # Terminal 2: Jalankan Server Laravel
   php artisan serve
   ```
   Akses aplikasi di *browser* pada alamat `http://127.0.0.1:8000` atau melalui domain lokal Laragon `http://laundry.test`.

---

## 🗺️ Route Map (Pemetaan Rute Minggu 3)

Sesuai dengan kriteria tugas, proyek ini mengimplementasikan $\ge 5$ rute terstruktur yang memanfaatkan *Named Routes*, *Route Parameter*, serta penanganan *HTTP Method* (GET/POST):

| Method | URL | Action / Controller | Named Route | Deskripsi & Fitur |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | `PageController@index` | `home` | Halaman Utama / Beranda (Wireframe & Responsif) |
| `GET` | `/layanan` | `PageController@layanan` | `layanan` | Daftar Layanan & Pricelist (Render dari Dummy Data Array) |
| `GET` | `/login` | `AuthController@showLoginForm` | `login` | Form Login Pelanggan & Pengelola |
| `POST` | `/login` | `AuthController@authenticate` | `login.process` | Memproses Login & Memisahkan Role (Admin vs Customer) |
| `GET` | `/pesan` | `OrderController@create` | `pesan` | Form Pemesanan Laundry (Cash / Tunai) |
| `POST` | `/pesan` | `OrderController@store` | `pesan.store` | Memproses Data Form Pemesanan |
| `GET` | `/lacak` | `OrderController@lacakIndex` | `lacak` | Form Lacak Resi Status Cucian |
| `GET` | `/lacak/{resi}` | `OrderController@lacakDetail` | `lacak.detail` | Lacak Status Cucian (Menggunakan **Route Parameter**) |
| `GET` | `/admin/dashboard` | `Admin\DashboardController@index` | `admin.dashboard` | Dashboard Panel Pengelola/Admin |
| `GET` | `/admin/kasir` | `Admin\CashierController@index` | `admin.kasir` | Kasir POS Input Transaksi Tunai |
| `GET` | `/admin/pesanan` | `Admin\AdminOrderController@index` | `admin.pesanan.index` | Kelola Antrean & Status Cucian |
| `GET` | `/admin/laporan` | `Admin\FinanceController@index` | `admin.laporan` | Laporan Keuangan Operasional |

---

## 🛠️ Arsitektur & Checklist Pemenuhan Tugas

Berikut adalah pemenuhan checklist tugas berdasarkan kriteria penilaian:

### 1. Master Layout & Partials (25% + 15%)
* **Master Layout Publik:** `resources/views/layouts/app.blade.php`
* **Master Layout Admin:** `resources/views/layouts/admin.blade.php`
* **Components / Partials:**
  * Navigasi publik dan panel pengelola terpisah.
  * Footer universal dan partial penanganan *alert/error*.

### 2. Controller & Data Dummy (15%)
* **`PageController`:** Mengelola halaman statis dan mengirimkan data dummy array pricelist/layanan ke Blade view `layanan.blade.php`.
* **`OrderController`:** Mengelola siklus form pemesanan dan penyajian dummy data lacak status pesanan berdasarkan parameter resi.
* **`AuthController`:** Mengatur logika pengarahan halaman (*redirection*) berdasarkan role akses pengguna (Admin mengarah ke `/admin/dashboard`, Customer mengarah ke `/`).
* **`Admin\*Controllers`:** Mengelola dashboard metrik operasional, antrean cucian, dan laporan keuangan admin.

### 3. Tampilan & Responsivitas Wireframe (15%)
Seluruh halaman disesuaikan agar responsif di berbagai ukuran layar (mobile & desktop) menggunakan kerangka Tailwind CSS:
* Beranda (`home.blade.php`)
* Layanan & Harga (`layanan.blade.php`)
* Form Pesanan (`pesan.blade.php`)
* Lacak Resi (`lacak.blade.php`)
* Form Login (`login.blade.php`)
* Dashboard Admin (`admin/dashboard.blade.php`)
