# Sistem Manajemen Hubungan Pelanggan ISP

## Tentang Proyek

Sistem Manajemen Hubungan Pelanggan ISP adalah aplikasi web yang dibangun dengan Laravel 11 untuk membantu perusahaan Internet Service Provider mengelola hubungan pelanggan.

### Waktu Pengerjaan
- Mulai: 30 April 2025, pukul 18:15 WIB
- Selesai: 3 Mei 2025, pukul 11:00 WIB

### Dibangun Dengan

* [Laravel 11](https://laravel.com)
* [PostgreSQL](https://www.postgresql.org/)
* [Tailwind CSS](https://tailwindcss.com)
* [Flowbite](https://flowbite.com) - Library komponen Tailwind CSS
* [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze) - Scaffolding autentikasi

## Fitur

### Untuk Sales (Penjual):
- CRUD (Create, Read, Update, Delete) data lead/calon customer
- Menambahkan proyek baru
- CRUD produk layanan
- Melihat list customer dan produk yang dipilih

### Untuk Manager:
- Melakukan approval pada proyek yang diajukan oleh sales

## Memulai

Ikuti langkah-langkah berikut untuk menyiapkan proyek secara lokal.

### Prasyarat

* PHP 8.2+
* Composer
* Node.js dan NPM
* PostgreSQL

### Instalasi

1. Clone repositori

2. Install dependensi PHP
   ```sh
   composer install
   ```

3. Install paket NPM
   ```sh
   npm install
   npm install tailwindcss @tailwindcss/vite --save-dev
   npm install flowbite --save
   ```

4. Buat salinan file .env
   ```sh
   cp .env.example .env
   ```

5. Konfigurasi koneksi database di file .env
   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=crm_smart
   DB_USERNAME=postgres
   DB_PASSWORD=
   ```

6. Jalankan migrasi dan seeder database
   ```sh
   php artisan migrate
   php artisan db:seed
   ```

7. Mulai server pengembangan
   ```sh
   php artisan serve
   ```

8. Di terminal terpisah, kompilasi aset
   ```sh
   npm run dev
   ```

### Manager
- Email: manager@gmail.com
- Password: 12345678

### Sales
- Email: sales@gmail.com
- Password: 12345678

### Struktur Proyek

Proyek ini mengikuti struktur direktori Laravel 11 standar dengan beberapa direktori kustom:

- `app/Models` - Berisi semua model database
- `app/Http/Controllers` - Berisi semua kontroler
- `app/Http/Middleware` - Berisi middleware kustom termasuk kontrol akses berbasis peran
- `resources/views` - Berisi template Blade
- `database/migrations` - Berisi migrasi database
- `database/seeders` - Berisi seeder database
- `routes` - Berisi definisi rute

## Skema Database

Aplikasi ini menggunakan PostgreSQL dengan tabel utama berikut:

- `users` - Menyimpan informasi pengguna
- `lead` - Menyimpan data calon pelanggan
- `customer` - Menyimpan informasi pelanggan
- `project` - Mencatat proyek-proyek
- `product` - Daftar paket layanan yang tersedia

## Pengakuan

* [Laravel](https://laravel.com)
* [Tailwind CSS](https://tailwindcss.com)
* [Flowbite](https://flowbite.com)
* [PostgreSQL](https://www.postgresql.org/)
