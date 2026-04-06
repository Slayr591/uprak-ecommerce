# 🚀 Panduan Setup UKK E-Commerce (Laravel 11)

## Prasyarat
Pastikan sudah terinstall:
- PHP >= 8.2
- Composer
- MySQL (XAMPP / Laragon / WAMP)
- Git (opsional)

---

## Langkah 1 - Ekstrak & Masuk ke Folder

```bash
# Ekstrak file ZIP, lalu masuk ke folder
cd uprak-ecommerce
```

---

## Langkah 2 - Install Dependencies

```bash
composer install
```

> ⏳ Tunggu sampai selesai (butuh koneksi internet)

---

## Langkah 3 - Buat File .env

```bash
# Windows
copy .env.example .env

# Mac / Linux
cp .env.example .env
```

---

## Langkah 4 - Generate App Key

```bash
php artisan key:generate
```

---

## Langkah 5 - Buat Database

Buka **phpMyAdmin** (http://localhost/phpmyadmin) atau MySQL client,
lalu jalankan:

```sql
CREATE DATABASE ukk;
```

---

## Langkah 6 - Konfigurasi .env

Buka file `.env` dan sesuaikan:

```env
DB_DATABASE=ukk
DB_USERNAME=root
DB_PASSWORD=          ← kosongkan jika tidak ada password (XAMPP default)
```

---

## Langkah 7 - Migrasi & Seed Database

```bash
php artisan migrate --seed
```

Ini akan membuat semua tabel dan mengisi data awal (produk + akun demo).

---

## Langkah 8 - Link Storage

```bash
php artisan storage:link
```

---

## Langkah 9 - Jalankan Server

```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## ✅ Akun Demo

| Role  | Email            | Password |
|-------|-----------------|----------|
| Admin | admin@ukk.com   | password |
| Staff | staff@ukk.com   | password |
| User  | user@ukk.com    | password |

---

## 🗺️ Alur Aplikasi

```
User  → Login → Lihat Produk → Tambah ke Keranjang → Checkout
      → Pilih Metode Pembayaran → Upload Bukti Bayar → Selesai

Staff → Login → Konfirmasi Pembayaran → Tandai Dikirim
      → Kelola Produk (CRUD)

Admin → Login → Dashboard → Kelola Semua (User, Produk, Pesanan, Staff, Laporan)
```

---

## ⚠️ Jika Ada Error

### Error: `No application encryption key`
```bash
php artisan key:generate
```

### Error: `SQLSTATE[HY000] [1049] Unknown database 'ukk'`
Buat database `ukk` di phpMyAdmin terlebih dahulu.

### Error: `Class not found`
```bash
composer dump-autoload
```

### Gambar tidak muncul
```bash
php artisan storage:link
```

---

## 📁 Struktur Halaman

| URL | Halaman |
|-----|---------|
| `/login` | Login |
| `/register` | Register |
| `/products` | Daftar Produk (User) |
| `/cart` | Keranjang |
| `/checkout` | Checkout |
| `/history` | Riwayat Pesanan |
| `/admin/dashboard` | Dashboard Admin |
| `/admin/products` | Produk (Admin) |
| `/admin/users` | Pengguna (Admin) |
| `/admin/orders` | Pesanan (Admin) |
| `/admin/staff` | Staff (Admin) |
| `/admin/reports` | Laporan (Admin) |
| `/staff/dashboard` | Dashboard Staff |
| `/staff/products` | Produk (Staff) |
| `/staff/payments` | Konfirmasi Bayar (Staff) |
| `/staff/orders` | Pesanan (Staff) |
