📖 Buku Tamu Digital Kabupaten Malang
Sistem buku tamu terintegrasi untuk berbagai Perangkat Daerah di Kabupaten Malang yang dikembangkan menggunakan Laravel 12 dan Filament Admin Panel.

📌 Deskripsi Proyek
Implementasi sistem pendataan kunjungan modern untuk instansi pemerintahan dengan fitur utama:
- Client-side (Frontend) — Halaman pengisian tamu dinamis berdasarkan Perangkat Daerah (PD) yang dituju, mendukung pengambilan foto webcam, tanda tangan digital, scan QR Code, Integrasi Cloudflare Turnstile.
- Admin Panel (Filament) — Dashboard untuk Superadmin dan Admin Perangkat Daerah untuk mengelola data kunjungan, export data kunjungan tamu, keamanan sistem, dan menyediakan akses data kunjungan tamu melalui API dengan key unik per intansi.

🚀 Teknologi Digunakan
- Backend: Laravel 12 & Filament v3
- Frontend: Livewire, Alpine.js, TailwindCSS, & Vite
- Security: Cloudflare Turnstile (Anti-Spam)
- Services: SMTP Gmail (Notifikasi Email)
- Livewire & Alpine.js (Form interaktif & Signature Pad)

---

## 🛠️ Langkah Instalasi & Konfigurasi

```bash
# 1. Clone repository
git clone https://github.com/Steven-Juan/buku-tamu-malang-kabupaten.git
cd buku-tamu-malang-kabupaten
# Install PHP & JS dependencies
composer install
npm install
npm run build

# 2. Konfigurasi Environment (.env)
# Salin file .env.example menjadi .env menggunakan perintah berikut
copy .env.example .env
# Sesuaikan file .env seperti variabel berikut::
APP_NAME="Buku Tamu Kabupaten Malang"
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=

# Cloudflare Turnstile (Security)
TURNSTILE_SITEKEY=0x4AAAAAACrkObzzir_lBKq5
TURNSTILE_SECRET=0x4AAAAAACrkOV2zWni1w-vVAJaV1CA9aok

# Mail Configuration (SMTP Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=bukutamukabmalang@gmail.com
MAIL_PASSWORD=cynwznpdbzepvcbj
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="bukutamukabmalang@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

# Queue Configuration
QUEUE_CONNECTION=sync

# 3. Database & File Storage
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

# 4. Menjalankan Aplikasi
php artisan serve --host=0.0.0.0
npm run dev

🔑 Akses Login Super Admin
Untuk mengelola data tamu dan pengaturan Perangkat Daerah, silakan akses panel administrasi:
URL: http://localhost:8000/admin
Username: Super Admin 1
Password: admin
