<!-- @format -->

# Final App

Sistem ERP yang sederhana, lengkap, dan mudah digunakan untuk mengelola data operasional perusahaan.

<img src="public/icon/Final.png" width="80" alt="Final App Logo">

## Tampilan Aplikasi

### Dashboard

![Dashboard](screenshoot/home.png)

### Data Master

![Data Master](screenshoot/data.png)

### Laporan

![Laporan](screenshoot/laporan.png)

### Pengaturan

![Pengaturan](screenshoot/pengaturan.png)

---

## Persyaratan Sistem

Pastikan lingkungan server memenuhi spesifikasi berikut:

| Komponen | Versi   |
| -------- | ------- |
| Apache   | 2.4.66  |
| PHP      | 8.3.30  |
| MySQL    | 8.4.3   |
| Composer | Terbaru |

### Rekomendasi

Untuk mempermudah proses instalasi dan pengembangan, disarankan menggunakan:

- Laragon
- XAMPP

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/kamiludin890/Final.git
```

### 2. Masuk ke Direktori Project

```bash
cd Final
```

### 3. Install Dependency

```bash
composer require twbs/bootstrap:^5.3
composer require twbs/bootstrap-icons
```

---

## Login Awal

Gunakan akun bawaan berikut untuk login pertama kali:

```text
Username : admin
Password : admin
```

---

## Konfigurasi Database

1. Login menggunakan akun admin.
2. Buka menu **Pengaturan**.
3. Isi konfigurasi database sesuai server yang digunakan.
4. Simpan konfigurasi.

### Catatan

Saat koneksi database berhasil:

- Sistem akan membuat seluruh tabel yang diperlukan secara otomatis.
- Akun administrator akan otomatis dibuat pada database.
- Aplikasi siap digunakan tanpa proses migrasi tambahan.

---

## Cara Penggunaan

Setelah konfigurasi database selesai:

1. Logout dari aplikasi.
2. Login kembali menggunakan akun administrator.
3. Mulai mengelola data melalui menu yang tersedia.

---

## Fitur Utama

- Dashboard informatif
- Manajemen data master
- Sistem laporan
- Pengaturan aplikasi
- Pembuatan database otomatis
- Pembuatan akun administrator otomatis
- Antarmuka berbasis Bootstrap 5

---

## Teknologi yang Digunakan

- PHP 8.3
- MySQL 8.4
- Bootstrap 5
- Bootstrap Icons
- Apache Web Server

---

## License

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/) [![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)
