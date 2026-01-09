# Sistem Resep Makanan 🍳

Platform berbagi resep makanan yang dibangun dengan Laravel, memungkinkan pengguna untuk berbagi, menjelajahi, dan berinteraksi melalui resep masakan.

## ✨ Fitur Utama

- **Autentikasi Lengkap**: Registrasi, login, logout dengan validasi
- **Manajemen Resep**: CRUD lengkap dengan ownership validation
- **Sistem Komentar**: Interaksi komunitas dengan moderasi admin
- **Activity Tracking**: Log semua aktivitas pengguna
- **Laporan Pengguna**: Statistik dan timeline aktivitas pribadi
- **Panel Admin**: Dashboard, laporan sistem, dan moderasi konten
- **UI Modern**: Design premium dengan gradients, animations, dan responsive

## 🚀 Quick Start

### Prerequisites
- PHP 8.x dengan PDO MySQL extension
- MySQL/MariaDB (via Laragon)
- Composer

### Setup

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Konfigurasi Database**
   - Update `.env` dengan database credentials Anda

3. **Run Migrations**
   ```bash
   php artisan migrate
   ```

4. **Seed Admin Account**
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

5. **Setup Storage**
   ```bash
   php artisan storage:link
   ```

6. **Start Server**
   ```bash
   php artisan serve
   ```

7. **Akses Aplikasi**
   - URL: http://127.0.0.1:8000

## 🔑 Default Credentials

### Admin
- **Email**: admin@pecel-lele.com
- **Password**: admin123

### User
Daftar akun baru melalui halaman registrasi

## 📁 Struktur Database

### Tables
- **users**: Data pengguna dengan role (user/admin)
- **recipes**: Resep makanan dengan relasi ke user
- **comments**: Komentar pada resep
- **activity_logs**: Log semua aktivitas sistem

## 🎨 Tech Stack

- **Backend**: Laravel 10
- **Database**: MySQL
- **Frontend**: Blade Templates, Vanilla CSS & JavaScript
- **Styling**: Custom CSS dengan gradients & animations
- **Font**: Inter (Google Fonts)

## 📖 Dokumentasi Lengkap

Lihat [walkthrough.md](../brain/5b03fb49-982f-4a85-8fc7-206e7cf9854d/walkthrough.md) untuk:
- Panduan testing lengkap
- Penjelasan fitur detail
- Database schema
- Security features
- Manual testing guide

## 🛡️ Security Features

✅ Password hashing (bcrypt)  
✅ CSRF protection  
✅ SQL injection prevention (Eloquent ORM)  
✅ Authorization & ownership checks  
✅ File upload validation  
✅ Input validation dengan error messages dalam Bahasa Indonesia

## 📝 License

Copyright © 2026 Sistem Resep Makanan. All rights reserved.

---

**Built with ❤️ using Laravel**
