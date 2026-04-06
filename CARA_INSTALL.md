# 🛒 UKK E-Commerce - Panduan Instalasi

## Akun Login Default (setelah seeder)
| Role  | Email           | Password |
|-------|-----------------|----------|
| Admin | admin@ukk.com   | password |
| Staff | staff@ukk.com   | password |
| User  | user@ukk.com    | password |

---

## Prasyarat
Pastikan sudah terinstall:
- **PHP 8.2+** → cek: `php -v`
- **Composer** → cek: `composer -V`
- **MySQL** (XAMPP / Laragon / MySQL standalone)
- **Node.js** (opsional, untuk asset)

---

## Langkah Instalasi

### 1. Extract ZIP
Extract file zip ini ke folder pilihan Anda, misalnya:
- `C:\xampp\htdocs\ukk-ecommerce` (XAMPP Windows)
- `/var/www/html/ukk-ecommerce` (Linux)

### 2. Install Dependensi PHP
Buka terminal di dalam folder project, lalu jalankan:
```bash
composer install
```
> Tunggu hingga selesai (butuh koneksi internet, ~2-5 menit)

### 3. Buat File .env
```bash
cp .env.example .env
```
Atau di Windows (CMD):
```cmd
copy .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Buat Database
Buka **phpMyAdmin** atau **MySQL Workbench**, lalu buat database:
```sql
CREATE DATABASE ukk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Konfigurasi Database di .env
Buka file `.env`, sesuaikan bagian ini:
```env
DB_DATABASE=ukk
DB_USERNAME=root
DB_PASSWORD=           ← kosong jika XAMPP default
```
> Jika menggunakan Laragon, password default biasanya juga kosong.

### 7. Jalankan Migrasi + Seeder
```bash
php artisan migrate --seed
```
> Ini akan membuat semua tabel dan mengisi data awal (produk, user, dll)

### 8. Buat Storage Link (untuk upload gambar)
```bash
php artisan storage:link
```

### 9. Jalankan Server
```bash
php artisan serve
```

### 10. Buka di Browser
```
http://localhost:8000
```

---

## Struktur Halaman

| URL | Keterangan | Akses |
|-----|-----------|-------|
| `/` | Redirect ke produk | Public |
| `/login` | Halaman login | Guest |
| `/register` | Daftar akun baru | Guest |
| `/products` | Daftar produk | User |
| `/cart` | Keranjang belanja | User |
| `/checkout` | Form checkout | User |
| `/payment/{id}` | Upload bukti bayar | User |
| `/history` | Riwayat pesanan | User |
| `/admin/dashboard` | Dashboard admin | Admin |
| `/admin/users` | Kelola pengguna | Admin |
| `/admin/products` | Kelola produk | Admin |
| `/admin/orders` | Kelola pesanan | Admin |
| `/admin/staff` | Kelola staff | Admin |
| `/admin/reports` | Laporan penjualan | Admin |
| `/staff/dashboard` | Dashboard staff | Staff |
| `/staff/products` | Kelola produk | Staff |
| `/staff/payments` | Konfirmasi bayar | Staff |
| `/staff/orders` | Kelola pengiriman | Staff |

---

## Alur Pembelian

```
User daftar/login
    ↓
Lihat produk → Tambah ke keranjang
    ↓
Checkout (isi alamat + pilih pengiriman + metode bayar)
    ↓
Upload bukti pembayaran (jika bank transfer/ewallet)
    ↓
Staff konfirmasi pembayaran
    ↓
Staff tandai "Dikirim"
    ↓
Pesanan selesai
```

---

## Troubleshooting

**Error: `SQLSTATE[HY000] [1045] Access denied`**
→ Periksa `DB_USERNAME` dan `DB_PASSWORD` di `.env`

**Error: `Class not found`**
→ Jalankan: `composer dump-autoload`

**Gambar tidak muncul**
→ Jalankan: `php artisan storage:link`

**Error 500 setelah install**
→ Pastikan `APP_KEY` sudah diisi. Jalankan: `php artisan key:generate`

**Tabel tidak ada**
→ Jalankan ulang: `php artisan migrate:fresh --seed`

---

## Teknologi yang Digunakan
- **Laravel 11** - Framework PHP
- **MySQL** - Database
- **Tailwind CSS** (CDN) - Styling
- **Blade** - Template engine
- **Figma** - Desain referensi (Uprak)
