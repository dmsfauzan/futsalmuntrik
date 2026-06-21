# Futsal Muntrik ⚽

Sistem **Sewa Lapangan Futsal** berbasis web yang dibangun menggunakan **PHP Native** dan **MySQL**.

## Fitur

### Pengguna

- Registrasi & Login akun
- Lupa password
- Lihat daftar lapangan futsal
- Booking / sewa lapangan
- Cek ketersediaan lapangan
- Upload bukti pembayaran
- Keranjang booking
- Profil pengguna
- Status pemesanan

### Admin

- Dashboard dengan statistik
- Kelola produk (lapangan) — tambah, edit, hapus
- Kelola pemesanan / order
- Konfirmasi pembayaran & ubah status
- Kelola pelanggan
- Lihat bukti pembayaran
- Cetak surat

## Teknologi

- **Backend:** PHP Native 8.x
- **Database:** MySQL 8.x (via phpMyAdmin)
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
- **Library:** jQuery, Owl Carousel, Animate.css, Font Awesome, Bootstrap Icons, Morris.js, Raphael.js, Easing.js, CounterUp.js, Waypoints.js

## Persyaratan Sistem

- XAMPP / Laragon / server dengan PHP 8.x
- MySQL 8.x
- Web browser modern

## Instalasi

1. Clone / download proyek ke folder `htdocs` (XAMPP) atau `www` (Laragon)
2. Buat database baru (misal: `futsal_muntrik`) di phpMyAdmin
3. Import file `coba.sql` ke database tersebut
4. Sesuaikan konfigurasi database di file `koneksi.php`:
   ```php
   $koneksi = new mysqli("localhost", "root", "", "coba");
   ```
   Ubah `coba` menjadi nama database yang Anda buat
5. Buka `http://localhost/futsalmuntrik` di browser

> Atau jalankan file `install.php` sekali untuk setup otomatis, lalu hapus file tersebut.

## Login Default

### Admin

- **Username:** `admin`
- **Password:** `admin`

### Pengguna (contoh)

- **Username:** `dmsfauzann` | `amalialtfh` | `cobb`

## Struktur Database

| Tabel    | Keterangan                      |
| -------- | ------------------------------- |
| `admin`  | Data admin (username, password) |
| `users`  | Data pengguna / pelanggan       |
| `produk` | Data lapangan futsal            |
| `order`  | Data pemesanan / booking        |

## Struktur Folder

```
futsalmuntrik/
├── admin/                  # Halaman admin
│   ├── assets/             # CSS, JS, fonts, images admin
│   ├── index.php           # Dashboard admin
│   ├── produk.php          # Kelola lapangan
│   ├── pembelian.php       # Data pembelian
│   ├── order.php           # Kelola order
│   ├── pelanggan.php       # Data pelanggan
│   └── ...
├── assets/
│   └── landing/            # Template landing page
├── foto_produk/            # Foto lapangan
├── uploads/
│   ├── bukti/              # Bukti pembayaran
│   └── izin/               # Dokumen izin
├── index.php               # Halaman utama
├── product.php             # Daftar lapangan
├── beli.php                # Proses booking
├── keranjang.php           # Halaman keranjang
├── checkout.php            # Checkout
├── login.php               # Halaman login
├── daftar.php              # Halaman registrasi
├── lupapw.php              # Lupa password
├── profile.php             # Profil pengguna
├── status_order.php        # Status pemesanan
├── cek_ketersediaan.php    # Cek jadwal lapangan
├── koneksi.php             # Koneksi database
├── install.php             # Script instalasi
└── coba.sql                # Dump database
```

## Catatan

- Pastikan folder `uploads/bukti` dan `foto_produk` memiliki permission writable untuk upload file
- Hapus `install.php` setelah instalasi selesai untuk keamanan
