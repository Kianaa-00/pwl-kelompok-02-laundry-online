# Requirements --- Website Laundry Online

**Versi:** 1.1\
**Tanggal:** 17 Oktober 2026\
**Status:** Draft\
**Tujuan dokumen:** Menjadi acuan kebutuhan sistem dan batasan scope
pengembangan Website Laundry Online.

## 1. Deskripsi Singkat

Website Laundry Online membantu pelanggan melihat layanan laundry,
membuat pesanan, memilih jadwal penjemputan atau pengantaran, dan
memantau status pesanan. Admin mengelola layanan, pesanan, dan status
pembayaran.

Dokumen ini menggunakan format **Requirement Sheet** seperti contoh pada
halaman 22 materi *Requirements + UI/UX*: **ID, Role, Requirement / User
Story, Prioritas, dan Acceptance**. Setiap acceptance criterion ditulis
agar dapat diperiksa melalui pengujian.

## 2. User Role

  -----------------------------------------------------------------------
  Role                    Tujuan dan aktivitas    Batasan akses
                          utama                   
  ----------------------- ----------------------- -----------------------
  Pengunjung              Melihat informasi       Tidak dapat membuat
                          layanan dan harga.      atau melihat pesanan
                                                  pribadi sebelum login.

  Pelanggan               Mengelola profil,       Hanya dapat melihat dan
                          membuat pesanan,        mengelola pesanan
                          memilih jadwal, dan     miliknya sendiri.
                          memantau pesanan.       

  Admin                   Mengelola layanan,      Mengakses fitur
                          harga, pesanan, dan     administrasi sesuai hak
                          status pembayaran.      akses.

  Petugas Laundry         Memperbarui status      Hanya dapat mengakses
  (opsional)              proses laundry atau     pesanan dan tindakan
                          pengantaran.            yang ditugaskan.
  -----------------------------------------------------------------------

## 3. Requirement Sheet (FR + NFR)

Keterangan prioritas scope:

-   **MUST** --- wajib untuk MVP dan versi final.
-   **SHOULD** --- penting, dikerjakan jika waktu dan sumber daya
    memungkinkan.
-   **COULD** --- fitur pengayaan jika kebutuhan utama telah selesai.
-   **OUT** --- tidak dikerjakan dalam scope versi ini.

  --------------------------------------------------------------------------------------
  ID             Role           Requirement / User   Prioritas      Acceptance
                                Story                               
  -------------- -------------- -------------------- -------------- --------------------
  FR-01          Semua pengguna Pengguna dapat login MUST           Login dengan
                                menggunakan email                   kredensial valid
                                dan kata sandi yang                 berhasil dan
                                terdaftar agar dapat                pengguna diarahkan
                                mengakses fitur                     ke halaman sesuai
                                sesuai perannya.                    role; kredensial
                                                                    tidak valid
                                                                    menghasilkan pesan
                                                                    kesalahan.

  FR-02          Pelanggan      Sebagai pelanggan,   MUST           Daftar menampilkan
                                saya ingin melihat                  nama layanan,
                                daftar layanan dan                  deskripsi, tarif,
                                harga agar dapat                    satuan harga, dan
                                memilih layanan yang                estimasi pengerjaan
                                sesuai.                             yang tersedia.

  FR-03          Pelanggan      Sebagai pelanggan,   MUST           Pesanan hanya
                                saya ingin membuat                  tersimpan jika
                                pesanan dengan                      seluruh data wajib
                                memilih layanan,                    valid; sistem
                                jumlah/berat cucian,                menghasilkan nomor
                                alamat, serta jadwal                pesanan unik dan
                                agar dapat                          menampilkan
                                menggunakan layanan                 ringkasan pesanan.
                                laundry.                            

  FR-04          Pelanggan      Sebagai pelanggan,   MUST           Total dihitung
                                saya ingin melihat                  berdasarkan tarif,
                                perkiraan total                     jumlah/berat, dan
                                biaya sebelum                       biaya tambahan yang
                                mengonfirmasi                       berlaku; rincian
                                pesanan agar                        biaya tampil sebelum
                                mengetahui biaya                    konfirmasi.
                                yang harus dibayar.                 

  FR-05          Pelanggan      Sebagai pelanggan,   MUST           Pelanggan dapat
                                saya ingin melihat                  melihat status
                                status dan riwayat                  terkini dan detail
                                pesanan agar dapat                  hanya untuk pesanan
                                mengetahui                          miliknya; akses ke
                                perkembangan cucian.                pesanan pelanggan
                                                                    lain ditolak.

  FR-06          Admin          Sebagai admin, saya  MUST           Perubahan valid
                                ingin menambah,                     tersimpan dan tampil
                                mengubah, dan                       pada daftar layanan;
                                menonaktifkan                       pengguna tanpa hak
                                layanan serta tarif                 admin tidak dapat
                                agar informasi                      menjalankan tindakan
                                layanan tetap                       tersebut.
                                akurat.                             

  FR-07          Admin          Sebagai admin, saya  MUST           Admin dapat melihat
                                ingin melihat                       detail pesanan dan
                                pesanan dan                         mengubah status
                                memperbarui status                  sesuai alur yang
                                pengerjaan agar                     diizinkan; status
                                proses laundry dapat                baru tersimpan dan
                                dikelola.                           terlihat oleh
                                                                    pelanggan terkait.

  FR-08          Pelanggan dan  Pelanggan dapat      SHOULD         Metode pembayaran
                 Admin          memilih metode                      dan statusnya
                                pembayaran yang                     tercatat pada
                                tersedia, sedangkan                 pesanan; pembayaran
                                admin dapat mencatat                yang belum
                                atau memverifikasi                  terverifikasi tidak
                                pembayaran sesuai                   ditampilkan sebagai
                                metode tersebut.                    sudah dibayar.

  FR-09          Admin          Sebagai admin, saya  SHOULD         Hasil
                                ingin mencari atau                  pencarian/filter
                                memfilter pesanan                   hanya menampilkan
                                berdasarkan nomor                   pesanan yang sesuai
                                pesanan, tanggal,                   dengan kriteria yang
                                atau status agar                    dipilih.
                                lebih mudah                         
                                menemukan data.                     

  NFR-01         Semua pengguna Sistem harus menjaga MUST           Kata sandi tidak
                                keamanan akun dan                   tersimpan sebagai
                                data dengan hashing                 teks biasa; input
                                kata sandi, validasi                tidak dapat
                                input, query                        menjalankan SQL
                                terparameterisasi,                  injection; pelanggan
                                serta kontrol akses                 tidak dapat membuka
                                berdasarkan role dan                data pesanan milik
                                kepemilikan pesanan.                orang lain.

  NFR-02         Pelanggan      Antarmuka harus      MUST           Halaman login,
                                responsif dan dapat                 daftar layanan,
                                digunakan pada                      formulir pesanan,
                                desktop maupun                      dan pelacakan dapat
                                perangkat mobile                    digunakan pada
                                agar pelanggan dapat                ukuran layar desktop
                                memesan dari                        dan mobile tanpa
                                berbagai perangkat.                 kehilangan fungsi
                                                                    utama.

  NFR-03         Admin          Sistem dapat         COULD          Jika fitur
                                menampilkan                         diimplementasikan,
                                ringkasan statistik                 admin dapat melihat
                                pesanan dan                         jumlah pesanan dan
                                pendapatan untuk                    ringkasan pendapatan
                                membantu pemantauan                 berdasarkan rentang
                                operasional.                        tanggal yang
                                                                    dipilih.

  FR-10          Pemilik proyek Integrasi aplikasi   OUT            Tidak ada aplikasi
                 / Pengembang   mobile native dan                   Android/iOS native
                                payment gateway                     maupun integrasi
                                otomatis berada di                  payment gateway
                                luar scope versi                    otomatis pada versi
                                awal; versi ini                     ini; metode
                                berfokus pada                       pembayaran yang
                                website dan                         disepakati dikelola
                                pencatatan                          secara manual.
                                pembayaran                          
                                sederhana.                          
  --------------------------------------------------------------------------------------

## 4. Ringkasan Scope

  -----------------------------------------------------------------------
  Prioritas                           Fitur dalam scope
  ----------------------------------- -----------------------------------
  **MUST**                            Login dan hak akses, daftar layanan
                                      dan harga, pembuatan pesanan,
                                      perhitungan biaya, pelacakan
                                      pesanan, pengelolaan layanan oleh
                                      admin, pembaruan status, keamanan
                                      dasar, dan antarmuka responsif.

  **SHOULD**                          Pencatatan/verifikasi pembayaran
                                      dan pencarian/filter pesanan.

  **COULD**                           Dashboard statistik pesanan dan
                                      pendapatan.

  **OUT**                             Aplikasi mobile native dan
                                      integrasi payment gateway otomatis
                                      pada versi awal.
  -----------------------------------------------------------------------

Prinsip scope: selesaikan seluruh kebutuhan **MUST** terlebih dahulu
sebelum mengerjakan SHOULD atau COULD. Item **OUT** tidak termasuk
implementasi versi ini.

## 5. Aturan Bisnis Utama

1.  Setiap pesanan memiliki nomor pesanan unik.
2.  Pelanggan hanya dapat melihat pesanan miliknya sendiri.
3.  Total biaya dihitung berdasarkan tarif yang berlaku, jumlah atau
    berat cucian, dan biaya tambahan yang disetujui.
4.  Status pembayaran harus dipisahkan dari status pengerjaan laundry.
5.  Perubahan status hanya dapat dilakukan oleh role yang berwenang dan
    harus mengikuti alur status yang ditetapkan.
6.  Tarif yang berlaku saat pesanan dikonfirmasi perlu dicatat pada
    pesanan agar perubahan tarif berikutnya tidak mengubah tagihan lama
    secara diam-diam.
7.  Pembatalan pesanan mengikuti kebijakan usaha yang ditampilkan kepada
    pelanggan.

## 6. Catatan Implementasi dan Pengujian

-   Setiap baris requirement memiliki acceptance criterion yang dapat
    digunakan sebagai dasar test case.
-   Fitur MUST menjadi dasar user flow, page inventory, dan wireframe.
-   Halaman yang dirancang harus mendukung requirement yang tercantum;
    hindari membuat halaman atau fitur di luar scope tanpa alasan.
-   Target kinerja, kapasitas pengguna, kebijakan pembatalan, jadwal
    operasional, dan detail metode pembayaran perlu dikonfirmasi dengan
    pemilik usaha sebelum implementasi.
