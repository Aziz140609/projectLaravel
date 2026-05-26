# ArenaPlay - Aplikasi Booking Lapangan Futsal 🏟️⚽

![Preview ArenaPlay](assets/ChatGPT%20Image%20May%2026,%202026,%2007_33_30%20AM.png)

## 📖 Deskripsi
ArenaPlay adalah platform aplikasi web berbasis Laravel yang dirancang untuk memudahkan proses pemesanan (booking) lapangan futsal. Sistem ini menyediakan antarmuka yang ramah pengguna bagi pelanggan untuk melihat ketersediaan lapangan dan melakukan pemesanan, serta menyediakan dashboard komprehensif bagi admin untuk mengelola seluruh operasional lapangan futsal.

---

## ✨ Detail Fitur dan Tampilan Aplikasi

### 1. Landing Page / Welcome

![Landing Page](assets/Screenshot%202026-05-26%20070054.png)

**Headline:**  
ArenaPlay

**Subheadline:**  
Tempat bermain futsal terbaik di kota. Fasilitas premium, lapangan berkualitas, dan sistem pemesanan yang cepat.

**CTA:**  
Booking Sekarang

**Section Keunggulan:**  
Mengapa memilih ArenaPlay sebagai tempat bermain futsal Anda?

- **Card 1: Tidak Terpengaruh Cuaca**  
  Main futsal kapan saja, tanpa khawatir hujan atau panas. Lapangan indoor kami selalu nyaman untuk bermain.
- **Card 2: Pencahayaan Optimal**  
  Tetap terang siang maupun malam.
- **Card 3: Cocok untuk Event**  
  Tempat yang sempurna untuk mengadakan turnamen futsal, acara perusahaan, atau pertandingan persahabatan.

**Call to action bawah:**  
Booking lapangan futsal sekarang juga dan nikmati fasilitas terbaik di kota.

---

### 2. Halaman Login

![Halaman Login](assets/Screenshot%202026-05-26%20070159.png)

**Subtitle:**  
Masuk untuk melanjutkan booking lapangan

**CTA:**  
Masuk

**Footer:**  
Belum punya akun? Daftar di sini

**Kembali:**  
← Kembali ke Beranda

---

### 3. Halaman Register

![Halaman Register](assets/Screenshot%202026-05-26%20070230.png)

**Subtitle:**  
Buat akun untuk mulai booking lapangan

**CTA:**  
Daftar Sekarang

**Footer:**  
Sudah punya akun? Masuk di sini

**Kembali:**  
← Kembali ke Beranda

---

### 4. Dashboard Pengguna / Dashboard Biasa

![Dashboard Pengguna](assets/Screenshot%202026-05-26%20070150.png)

**Heading utama:**  
Pilih Lapangan

**CTA card:**  
Booking Sekarang

**State kosong:**  
Maaf, belum ada lapangan yang tersedia saat ini.

**Nav bar:**  
Halo, [nama pengguna]

**Button logout:**  
Logout

---

### 5. Form Booking

![Form Booking](assets/Screenshot%202026-05-26%20070353.png)

**Heading utama:**  
Form Booking

**Back link:**  
← Kembali pilih lapangan

**Field placeholder:**  
Masukkan nama lengkap

**Label utama:**  
- Nama Pemesan  
- No. HP / WhatsApp  
- Tanggal Main  
- Jam Mulai  
- Durasi Main  
- Metode Pembayaran  
- Estimasi Total

**Payment options:**  
- **Bayar di Tempat:** Bayar tunai saat tiba di lapangan  
- **Bayar via E-Wallet:** E-Wallet & bayar sekarang  

**CTA:**  
Konfirmasi Booking

**Error / alert:**  
Informasi konflik jadwal bisa ditampilkan di sini jika booking tidak tersedia.

---

### 6. Dashboard Admin

![Dashboard Admin](assets/Screenshot%202026-05-26%20070658.png)

**Title:**  
Dashboard Overview

**Header tanggal:**  
Hari ini: [tanggal]

**Stat cards:**  
- Total User  
- Total Booking  
- Booking Hari Ini  
- Lapangan Tersedia  
- Pendapatan Bulan Ini  
- Jadwal Aktif

**Chart titles:**  
- Grafik Pendapatan (Mingguan)  
- Lapangan Terpopuler

**Button:**  
Lihat Detail

**Table heading:**  
Daftar Booking

**Badge status:**  
- Lunas  
- Belum Lunas

**Sidebar menu:**  
- Dashboard  
- Booking  
- Lapangan  
- User  
- Pembayaran

---

### 7. Halaman Admin Booking

![Halaman Admin Booking](assets/Screenshot%202026-05-26%20070720.png)

**Title:**  
Seluruh Log Booking

**Search placeholder:**  
Cari booking, user, lapangan...

**Header tanggal:**  
Hari ini: [tanggal]

**Heading table:**  
Daftar Booking

**Kolom tabel:**  
- Pelanggan  
- Lapangan  
- Tanggal & Jam  
- Total Bayar  
- Status  
- Aksi

**Status:**  
- Lunas  
- Belum Lunas

**Action tombol:**  
- Detail  
- Verifikasi Lunas  
- Batalkan/Hapus

**State kosong:**  
Belum ada data booking.

---

### 8. Halaman Admin Lapangan

![Halaman Admin Lapangan](assets/Screenshot%202026-05-26%20070739.png)

**Title:**  
Manajemen Lapangan

**Heading:**  
Daftar Lapangan

**CTA:**  
Tambah Lapangan

**Deskripsi card lapangan:**  
- Deskripsi lapangan  
- Harga per jam  
- Jadwal / informasi tambahan

**Section schedule:**  
Jadwal Lapangan

**Action tombol:**  
- Edit  
- Hapus

**Modal / form:**  
- Nama Lapangan  
- Deskripsi  
- Harga per jam  
- Upload gambar

---

### 9. Halaman Admin User

![Halaman Admin User](assets/Screenshot%202026-05-26%20070829.png)

**Title:**  
Manajemen User

**Search placeholder:**  
Cari nama atau email user...

**Heading table:**  
Daftar Pengguna

**Kolom tabel:**  
- Nama  
- Email  
- Role  
- Tanggal Bergabung  
- Aksi

**Role badge:**  
- admin  
- user

**State kosong:**  
Tidak ada user ditemukan.

**Action tombol:**  
- Detail  
- Hapus User

---

## ⚙️ Cara Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer lokal Anda:

1. **Clone repositori** atau ekstrak source code.
2. Buka terminal/command prompt di direktori project:
   ```bash
   cd booking-app
   ```
3. Install dependencies menggunakan Composer:
   ```bash
   composer install
   ```
4. Copy file konfigurasi environment:
   ```bash
   cp .env.example .env
   ```
5. Sesuaikan konfigurasi database di file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```
6. Generate application key:
   ```bash
   php artisan key:generate
   ```
7. Jalankan migrasi database dan seeder (untuk data awal):
   ```bash
   php artisan migrate --seed
   ```
8. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
9. Buka browser dan akses `http://localhost:8000`.

---








<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
