
<!-- Logo Laravel yang ditampilkan pada bagian paling atas README dan diposisikan di tengah halaman. -->
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<!-- Badge informasi proyek Laravel, meliputi status build, jumlah unduhan, versi stabil, dan lisensi. -->
<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<!-- Judul utama proyek yang menjelaskan nama aplikasi dan minggu pengerjaan tugas praktikum. -->
# 🧼 Amar Laundry Express - Web Application (Minggu 03)

<!-- Penjelasan singkat mengenai tujuan, teknologi, dan latar belakang pengembangan aplikasi. -->
Aplikasi manajemen dan pemesanan layanan laundry berbasis web yang dikembangkan menggunakan **Laravel 13** dan **Tailwind CSS**. Proyek ini disusun untuk memenuhi **Tugas Minggu 3 Praktikum Pemrograman Web Lanjut (PWL)**.

---

<!-- Bagian yang berisi identitas seluruh anggota kelompok beserta NIM dan pembagian tanggung jawab masing-masing. -->
## 👥 Tim Pengembang (Kelompok 02)

<!-- Tabel berikut digunakan untuk menyusun informasi anggota tim agar lebih terstruktur dan mudah dibaca. -->
| Nama Mahasiswa | NIM | Peran & Tanggung Jawab Utama |
| :--- | :--- | :--- |
| **Amar Albar** | 25170017 | Koordinator Projek (Project Management & Task Allocation) |
| **Naufal Kresna Putra Ardy** | 25170009 | Backend Engineer (API Logic & Core Business Process) |
| **Anrico Wibowo** | 25170019 | Frontend Engineer (UI Templates & User Interface Design) |
| **Andhika Meisteva** | 25170016 | Database Architect & QA Documentation Lead |

---

<!-- Bagian informasi repository yang digunakan untuk menyimpan source code dan versi teknologi proyek. -->
## 📌 Informasi Repository & Versi

<!-- Menampilkan alamat repository GitHub, tag tugas, versi framework, serta versi minimum PHP yang dibutuhkan. -->
* **Repository:** [pwl-kelompok-02-laundry-online](https://github.com/Kianaa-00/pwl-kelompok-02-laundry-online.git)
* **Tag Tugas:** `minggu-03`
* **Framework Version:** Laravel 13.x
* **PHP Version:** >= 8.5

---

<!-- Bagian panduan instalasi untuk membantu anggota kelompok menjalankan aplikasi pada komputer masing-masing. -->
## 💻 Panduan Instalasi & Penggunaan Lokal

<!-- Langkah-langkah instalasi disusun secara berurutan mulai dari mengambil source code hingga menjalankan aplikasi. -->
ikuti langkah-langkah berikut untuk menjalankan proyek di komputer/laptop anggota kelompok:

<!-- LANGKAH 1: Mengunduh source code proyek dari repository GitHub menggunakan Git Clone. -->
1. **Clone Repository:**
   ```bash
   git clone https://github.com/Kianaa-00/pwl-kelompok-02-laundry-online.git
   cd pwl-kelompok-02-laundry-online
   ```

<!-- LANGKAH 2: Menginstal seluruh library dan package yang dibutuhkan oleh Laravel serta frontend. -->
2. **Install Dependensi PHP & JavaScript:**
   ```bash
   composer install
   npm install
   ```

<!-- LANGKAH 3: Membuat file konfigurasi environment dan menghasilkan application key untuk keamanan aplikasi Laravel. -->
3. **Konfigurasi Environment File:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

<!-- LANGKAH 4: Menjalankan compiler asset frontend dan server lokal Laravel agar aplikasi dapat diakses melalui browser. -->
4. **Jalankan Asset Compiler & Web Server Laravel:**
   ```bash
   # Terminal 1: Kompilasi Tailwind CSS
   npm run dev

   # Terminal 2: Jalankan Server Laravel
   php artisan serve
   ```
   Akses aplikasi di *browser* pada alamat `http://127.0.0.1:8000` atau melalui domain lokal Laragon `http://laundry.test`.

---

<!-- Bagian pemetaan seluruh URL aplikasi beserta HTTP method, controller, named route, dan fungsi masing-masing halaman. -->
## 🗺️ Route Map (Pemetaan Rute Minggu 3)

<!-- Penjelasan bahwa aplikasi menggunakan berbagai jenis route Laravel, termasuk Named Route, Route Parameter, GET, dan POST. -->
Sesuai dengan kriteria tugas, proyek ini mengimplementasikan $\ge 5$ rute terstruktur yang memanfaatkan *Named Routes*, *Route Parameter*, serta penanganan *HTTP Method* (GET/POST):

<!-- Tabel berikut mendokumentasikan seluruh endpoint yang tersedia dalam aplikasi Amar Laundry Express. -->
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

<!-- Bagian checklist untuk menjelaskan struktur arsitektur aplikasi dan pemenuhan kriteria penilaian praktikum. -->
## 🛠️ Arsitektur & Checklist Pemenuhan Tugas

<!-- Penjelasan implementasi komponen utama Laravel yang digunakan dalam pengembangan aplikasi. -->
Berikut adalah pemenuhan checklist tugas berdasarkan kriteria penilaian:

<!-- BAGIAN 1: Menjelaskan penggunaan Master Layout dan Partials untuk menghindari penulisan kode tampilan secara berulang. -->
### 1. Master Layout & Partials (25% + 15%)

<!-- File layout utama yang menjadi kerangka tampilan halaman publik aplikasi. -->
* **Master Layout Publik:** `resources/views/layouts/app.blade.php`

<!-- File layout utama yang digunakan khusus untuk halaman dashboard dan panel admin. -->
* **Master Layout Admin:** `resources/views/layouts/admin.blade.php`

<!-- Komponen partial digunakan untuk memisahkan elemen tampilan yang dapat digunakan kembali pada beberapa halaman. -->
* **Components / Partials:**
  * Navigasi publik dan panel pengelola terpisah.
  * Footer universal dan partial penanganan *alert/error*.

<!-- BAGIAN 2: Menjelaskan pembagian tugas controller dalam mengelola request, memproses data, dan mengirimkan data ke halaman Blade. -->
### 2. Controller & Data Dummy (15%)

<!-- PageController bertanggung jawab mengatur halaman publik dan menyediakan data layanan laundry dalam bentuk array sementara. -->
* **`PageController`:** Mengelola halaman statis dan mengirimkan data dummy array pricelist/layanan ke Blade view `layanan.blade.php`.

<!-- OrderController mengatur proses pemesanan serta menampilkan informasi status cucian berdasarkan nomor resi. -->
* **`OrderController`:** Mengelola siklus form pemesanan dan penyajian dummy data lacak status pesanan berdasarkan parameter resi.

<!-- AuthController bertanggung jawab memproses autentikasi dan mengarahkan pengguna sesuai dengan hak akses atau role masing-masing. -->
* **`AuthController`:** Mengatur logika pengarahan halaman (*redirection*) berdasarkan role akses pengguna (Admin mengarah ke `/admin/dashboard`, Customer mengarah ke `/`).

<!-- Controller pada folder Admin digunakan untuk menangani kebutuhan operasional pengelola, seperti dashboard, transaksi, pesanan, dan laporan. -->
* **`Admin\*Controllers`:** Mengelola dashboard metrik operasional, antrean cucian, dan laporan keuangan admin.

<!-- BAGIAN 3: Menjelaskan implementasi tampilan antarmuka menggunakan Tailwind CSS agar aplikasi dapat digunakan pada perangkat mobile maupun desktop. -->
### 3. Tampilan & Responsivitas Wireframe (15%)

<!-- Tailwind CSS digunakan sebagai framework CSS untuk membantu membuat tampilan aplikasi yang fleksibel dan responsif. -->
Seluruh halaman disesuaikan agar responsif di berbagai ukuran layar (mobile & desktop) menggunakan kerangka Tailwind CSS:

<!-- Daftar halaman Blade yang menjadi bagian dari antarmuka aplikasi Amar Laundry Express. -->
* Beranda (`home.blade.php`)
* Layanan & Harga (`layanan.blade.php`)
* Form Pesanan (`pesan.blade.php`)
* Lacak Resi (`lacak.blade.php`)
* Form Login (`login.blade.php`)
* Dashboard Admin (`admin/dashboard.blade.php`)
