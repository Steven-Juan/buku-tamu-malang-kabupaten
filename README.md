Aplikasi Informatika - Buku Tamu Digital Kabupaten Malang
Ini adalah proyek tugas mata kuliah Pemrograman Web berupa website Buku Tamu Digital terintegrasi untuk berbagai Perangkat Daerah di Kabupaten Malang yang dikembangkan menggunakan Laravel Filament Starter sebagai admin panel.

📌 Deskripsi Proyek
Proyek ini adalah implementasi sistem buku tamu modern untuk efisiensi pendataan kunjungan pada instansi pemerintahan. Website memiliki dua bagian utama:

Client-side (Frontend) — Halaman pengisian tamu dinamis berdasarkan Perangkat Daerah (PD) yang dituju, mendukung pengambilan foto webcam, tanda tangan digital, dan scan QR Code.

Admin Panel (Filament) — Dashboard untuk Superadmin dan Admin Perangkat Daerah untuk mengelola data kunjungan, generate QR Code, dan menyediakan akses data melalui API.

🚀 Teknologi Digunakan
Laravel 12 + Filament Admin Panel

Livewire & Alpine.js (Form interaktif & Signature Pad)

TailwindCSS & Vite

Webcam API & QR Code Generator

PHP 8.2+, Node.js 18+, Composer

---

## 🚀 Clone & Setup

```bash
# 1. Download file dari GitHub
git clone [https://github.com/Steven-Juan/buku-tamu-malang-kabupaten.git](https://github.com/Steven-Juan/buku-tamu-malang-kabupaten.git)
cd buku-tamu-malang-kabupaten

# 2. Install PHP dependencies
composer install

# 3. Install frontend assets
npm install
npm run build

# 4. Konfigurasi .env & jalankan migrasi
copy .env.example .env
# Update database dan nama database di file .env
php artisan key:generate
php artisan migrate --seed

# 5. Jalankan server
php artisan serve
🔑 Akses Login
Untuk mengelola data tamu dan pengaturan Perangkat Daerah, silakan akses panel administrasi:
URL: http://localhost:8000/admin
Username: admin
Password: admin
