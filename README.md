# 📖 Buku Tamu Digital Kabupaten Malang

Sistem buku tamu terintegrasi untuk berbagai Perangkat Daerah di Kabupaten Malang yang dikembangkan menggunakan **Laravel 12** dan **Filament v3 Admin Panel**.

---

## 📌 Deskripsi Proyek

Implementasi sistem pendataan kunjungan modern untuk instansi pemerintahan dengan fitur utama:

### Client-side (Frontend)
- Halaman pengisian tamu dinamis berdasarkan Perangkat Daerah (PD) yang dituju
- Mendukung **pengambilan foto** via kamera perangkat atau pemilihan avatar
- **Tanda tangan digital** (Signature Pad) langsung di browser
- Menampilkan **QR Code** per instansi untuk kemudahan akses form kunjungan
- Integrasi **Cloudflare Turnstile** sebagai anti-spam pada form tamu

### Admin Panel (Filament)
- **Dashboard** interaktif dengan statistik kunjungan, grafik pertumbuhan tamu, dan analisis jam sibuk
- Manajemen data kunjungan tamu oleh **Super Admin** dan **Admin Perangkat Daerah**
- **Export data** kunjungan ke format Excel dan PDF
- **API** akses data kunjungan dengan key unik per instansi
- **Two-Factor Authentication (2FA)** untuk keamanan akun admin
- **Activity Log** untuk pencatatan aktivitas di panel admin
- **Forgot Password** via SMTP Gmail untuk admin Perangkat Daerah
- **Job Monitor** untuk pemantauan antrian pekerjaan

---

## 🚀 Teknologi Digunakan

| Kategori | Teknologi |
|---|---|
| **Backend** | Laravel 12, Filament v3 |
| **Frontend** | Livewire 3, Alpine.js, TailwindCSS, Vite |
| **Security** | Cloudflare Turnstile (Anti-Spam), Filament Breezy (2FA) |
| **Email** | SMTP Gmail (Reset Password Admin PD) |
| **Export** | Maatwebsite Excel, DomPDF |
| **Logging** | Filament Logger (Activity Log) |
| **API** | Laravel Sanctum |

---

## 🛠️ Langkah Instalasi & Konfigurasi

### 1. Clone Repository & Install Dependencies

```bash
git clone https://github.com/Steven-Juan/buku-tamu-malang-kabupaten.git
cd buku-tamu-malang-kabupaten

# Install PHP & JS dependencies
composer install
npm install
npm run build
```

### 2. Konfigurasi Environment (.env)

```bash
# Salin file .env.example menjadi .env
copy .env.example .env
```

Sesuaikan file `.env` dengan variabel berikut:

```env
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
TURNSTILE_SITEKEY=your-turnstile-sitekey
TURNSTILE_SECRET=your-turnstile-secret

# Mail Configuration (SMTP Gmail - untuk fitur Reset Password)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

> **Catatan:** Untuk `MAIL_PASSWORD`, gunakan [App Password](https://support.google.com/accounts/answer/185833) dari akun Gmail Anda, bukan password akun Gmail biasa.

### 3. Database & File Storage

```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 4. Menjalankan Aplikasi

```bash
php artisan serve --host=0.0.0.0 --port=8000
npm run dev
```

---

## 🔑 Akses Login Super Admin

Untuk mengelola data tamu dan pengaturan Perangkat Daerah, silakan akses panel administrasi:

| | |
|---|---|
| **URL** | `http://localhost:8000/admin` |
| **Username** | `Super Admin 1` |
| **Password** | `admin` |

---

## 📁 Struktur Proyek

```
├── app/
│   ├── Exports/            # Export Excel (GuestExport)
│   ├── Filament/
│   │   ├── Auth/           # Custom Login & Forgot Password
│   │   ├── Pages/          # Halaman admin (IKM Detail)
│   │   ├── Resources/      # CRUD: Guest, PerangkatDaerah, User
│   │   └── Widgets/        # Dashboard charts & statistik
│   ├── Http/
│   │   ├── Controllers/    # API Controller (Kunjungan)
│   │   └── Middleware/     # CheckApiKey, AddSeoDefaults
│   ├── Livewire/           # Komponen frontend (Home, GuestForm, dll)
│   ├── Models/             # Guest, PerangkatDaerah, User
│   ├── Notifications/      # ResetPasswordNotification (Bahasa Indonesia)
│   └── Policies/           # Authorization policies
├── database/
│   ├── migrations/         # Skema database
│   └── seeders/            # Data awal (Super Admin, Perangkat Daerah)
├── resources/views/
│   ├── livewire/           # Blade templates frontend
│   ├── filament/           # Widget Turnstile & custom views
│   └── exports/            # Template export PDF
└── routes/
    ├── web.php             # Route frontend
    └── api.php             # Route API (v1/kunjungan)
```

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE.md).
