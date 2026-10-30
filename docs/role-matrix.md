# Matrix Peran dan Hak Akses (Role Matrix)

Dokumen ini mendefinisikan batasan hak akses untuk setiap peran pengguna di dalam Aplikasi Manajemen / Website Laundry Online.

## 1. Definisi Peran (Role)
* **Guest (Tamu)**: Pengunjung publik yang belum melakukan autentikasi (login).
* **Pelanggan**: Pengguna terdaftar yang memesan dan memantau status pesanan laundry.
* **Petugas / Admin**: Pengelola sistem yang mengelola data master, status pesanan, dan laporan transaksi.

---

## 2. Tabel Hak Akses Fitur

| No | Modul / Fitur                        | Guest (Tamu) | Pelanggan | Petugas / Admin |
|:--:|:------------------------------------ |:------------:|:---------:|:---------------:|
| 1  | Lihat Halaman Utama & Daftar Layanan |      ✅      |     ✅   |        ✅       |
| 2  | Registrasi Akun Baru                 |      ✅      |     ❌   |        ❌       |
| 3  | Login & Logout                       |      ✅      |     ✅   |        ✅       |
| 4  | Membuat Pesanan Laundry Baru         |      ❌      |     ✅   |        ❌       |
| 5  | Lihat Riwayat Pesanan Saya           |      ❌      |     ✅   |        ❌       |
| 6  | Kelola Data Master Layanan & Tarif   |      ❌      |     ❌   |        ✅       |
| 7  | Lihat Seluruh Pesanan Masuk          |      ❌      |     ❌   |        ✅       |
| 8  | Perbarui Status Pesanan Laundry      |      ❌      |     ❌   |        ✅       |
| 9  | Akses Halaman Dashboard Admin        |      ❌      |     ❌   |        ✅       |

---

## 3. Catatan Keamanan Otorisasi
1. Pengguna dengan *role* **Pelanggan** hanya diizinkan membaca/mengubah data pesanan yang memiliki `user_id` sesuai dengan akun yang sedang login.
2. Pengguna dengan *role* **Guest** yang mencoba mengakses halaman khusus Pelanggan atau Admin akan otomatis di-redirect ke halaman Login.
3. Pengguna dengan *role* **Pelanggan** yang mencoba mengakses route Admin akan mendapatkan respon HTTP `403 Forbidden`.