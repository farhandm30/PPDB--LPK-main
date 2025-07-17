# PPDB Online - Laravel Filament💪💪💪

Proyek ini adalah migrasi dari sistem PPDB (Penerimaan Peserta Didik Baru) yang sebelumnya menggunakan CodeIgniter ke Laravel dengan admin panel Filament.

## Teknologi yang Digunakan

-   Laravel 12
-   Filament 3.x
-   MySQL
-   PHP 8.2+
-   TailwindCSS
-   AlpineJS

## Fitur

-   Admin Panel dengan Filament
-   Manajemen Data Pendaftaran
-   Manajemen Jurusan
-   Manajemen Tahun Ajaran
-   Pengaturan Aplikasi
-   Frontend Pendaftaran Siswa

## Instalasi

1. Clone repository
2. Jalankan `composer install`
3. Salin `.env.example` ke `.env` dan sesuaikan konfigurasi database
4. Jalankan `php artisan key:generate`
5. Jalankan `php artisan migrate --seed`
6. Jalankan `npm install && npm run dev`
7. Jalankan `php artisan serve`

## Login Admin

-   Email: admin@example.com
-   Password: password

## Progress Migrasi dari CodeIgniter ke Laravel Filament

### Selesai

-   [x] Setup proyek Laravel baru
-   [x] Instalasi dan konfigurasi Filament
-   [x] Migrasi struktur database
    -   [x] Tabel Pendaftaran
    -   [x] Tabel Jurusan
    -   [x] Tabel Tahun Ajaran
    -   [x] Tabel Pengaturan
    -   [x] Tabel Pengumuman
-   [x] Pembuatan model
    -   [x] Model Pendaftaran
    -   [x] Model Jurusan
    -   [x] Model Tahun Ajaran
    -   [x] Model Pengaturan
    -   [x] Model Pengumuman ( belum ada diadmin panel)
-   [x] Pembuatan Filament Resources
    -   [x] PendaftaranResource
    -   [x] JurusanResource
    -   [x] TahunAjaranResource
    -   [x] PengaturanResource
    -   [x] UserResource
-   [x] Pembuatan RelationManagers
    -   [x] JurusanResource - PendaftaransRelationManager
    -   [x] TahunAjaranResource - PendaftaransRelationManager
-   [x] Pembuatan Observer untuk nomor pendaftaran otomatis
-   [x] Seeder data awal
    -   [x] TahunAjaranSeeder
    -   [x] JurusanSeeder
    -   [x] PengaturanSeeder
    -   [x] User Admin
    -   [x] PengumumanSeeder
-   [x] Dashboard statistik pendaftaran
-   [x] Manajemen pengguna admin

### Dalam Pengerjaan - Frontend User

-   [x] Setup layout dasar frontend (hijau-putih)
    -   [x] Master layout
    -   [x] Komponen navigasi
    -   [x] Komponen footer
    -   [x] Komponen hero section
-   [x] Halaman beranda
    -   [x] Hero section dengan informasi pendaftaran
    -   [x] Statistik pendaftaran
    -   [x] Jurusan unggulan
    -   [x] Testimoni siswa
-   [x] Halaman profil
    -   [x] Tentang kami
    -   [x] Sejarah
    -   [x] Visi dan misi
    -   [x] Struktur organisasi
-   [x] Halaman jurusan
    -   [x] Daftar jurusan
    -   [x] Detail jurusan
-   [x] Halaman kontak
    -   [x] Formulir kontak
    -   [x] Informasi kontak
    -   [x] Peta lokasi
-   [x] Formulir pendaftaran online
    -   [x] Langkah 1: Data pribadi
    -   [x] Langkah 2: Data orang tua
    -   [x] Langkah 3: Upload dokumen
    -   [x] Langkah 4: Hasil pendaftaran
    -   [x] Langkah 5: Cetak bukti pendaftaran
    -   [ ] testimoni pada home page
-   [x] Halaman login dan register siswa
-   [x] Dashboard siswa
    -   [x] Status pendaftaran
    -   [x] Cetak kartu pendaftaran
    -   [x] Pengumuman

## Skema Warna

-   Warna Utama: Hijau (#1E8449)
-   Warna Sekunder: Hijau Muda (#27AE60)
-   Warna Aksen: Hijau Tua (#145A32)
-   Warna Latar: Putih (#FFFFFF)
-   Warna Teks: Hitam (#333333)
-   Warna Teks Sekunder: Abu-abu (#666666)

### Akan Datang

-   [x] Notifikasi whatsapp untuk pendaftar
-   [x] Cetak kartu pendaftaran

## Fitur Admin Panel yang Perlu Ditambahkan

Berikut adalah daftar fitur yang perlu ditambahkan pada admin panel untuk mendukung tampilan frontend:

### Manajemen Konten

-   [x] Manajemen Halaman (Page Builder)
-   [x] Manajemen Slider/Banner (✓ Selesai diperbaiki)
-   [x] Manajemen Berita/Artikel
-   [x] Manajemen FAQ

### Komunikasi

-   [x] Manajemen Pesan Kontak (contactresouce)
-   [x] Notifikasi whatsapp dan Pengumuman

### Pendaftaran

-   [x] Formulir Pendaftaran Kustom
-   [x] Manajemen Dokumen Persyaratan
-   [x] Manajemen Status Pendaftaran
-   [x] Cetak Kartu Pendaftaran

### Testimoni dan Ulasan

-   [x] Manajemen Testimoni Siswa (rating dan ulasan) (testimoniresouce)

### Pengumuman dan Informasi

-   [x] Manajemen Pengumuman

### Manajemen Pengguna

-   [x] Manajemen Akun Siswa

<!-- ### Laporan dan Analitik
- [ ] Laporan Pendaftaran
- [ ] Statistik dan Grafik
- [ ] Ekspor Data -->

### New Progress User

-   [x] Setelah klik Daftar Sekarang, pengguna di-redirect ke halaman login (tanpa sesi login).
-   [x] Fungsi buka/tutup sidebar pada tampilan siswa (khusus desktop) telah diaktifkan.
-   [x] Ukuran logo telah disesuaikan.
-   [x] Struktur database untuk fitur bantuan di dashboard telah disesuaikan.

### New Progress Admin

-   [x] Kolom Aksi untuk status telah ditambahkan pada halaman data pendaftaran.

### OTW DEPLOY

### upadate 24 06 2025

-   [x]galery navbar dan admin panel
-   [x] nisn dihapus
-   [x] status dokumen lengkap, mengunggu upload 2 data pending
-   [x]data siswa nisn dihpaus diganti NIK
-   [x]hasil pendaftaran ucapan selamat dihapus sama dwonload bagian bukti pendfatran dan surat pertnyataan
-   [x]admin panel bisa download berkas

# tata letak admin panel:

-   [x]manajemen ppdb
-   [x]data master
-   [x]manajemen konten
-   [x]pengaturan sistem

### SIAP DEPLOY

### UPDATE 27 06 2025

orieda ppdb lpk

error:

-   [x] bagian data orang tua bagian wali 500 server error
-   [x] ketika di data siswa update menunggu verifikasi hilang didata siswa

revisi:

-   [x] status verifikasi diganti nama menjadi menunggu verifikasi
-   [x] di data siswa hanya menampilkan status diterima (tidak bisa diubah)
-   [x] hapus data pendaftaran di halaman data jurusan
-   [x] hapus data pendaftaran di halaman tahun ajaran
-   [x] halaman data artikel dijadikan sama seperti halaman data faq SEMUA HALAMAN MANAJEMEN KONTEN
-   [x] hapus filter di semua halaman data
-   [x] pengturan admin diganti nama pengaturan akun, badge menampilkan semua data bukan admin saja
-   [x] bila menghapus data pendaftaran dan data siswa data akun juga terhapus

### update revisi 16 juli 2025

-   [x] icon notifikasi di admin panel samping menu logout pojok kanan atas tidak ada fungsinya lebih baik ditiadakan
-   [x] Data siswa yang sudah(pendaftar yang diacc) tidak ada informasi orang tua atau berkasnya terus bagaimana mau melihatnya jika ingin melihatnya kembali
-   [x] informasi jurusan tidak singkron atau kelebihan di web profilnya,
-   [x] admin panel bagian menu pengaturan aplikasi tidak perlu aksi create
-   [x] fix opsional data wali pada pendaftaran
-   [x] fitur wa blast siswa resouce
