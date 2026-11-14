# Catatan Pengerjaan: Docker, Audit Keamanan, Perbaikan, dan Pengujian

Tanggal: 14 November 2026
Branch: `feat/docker-security-fixes` (dibuat dari `main` di commit `a24d56e`, belum di-push/merge)

Dokumen ini merangkum semua yang sudah dikerjakan dan apa yang tersisa, supaya pekerjaan bisa dilanjutkan.

## Ringkasan

| Tahap | Hasil | Commit |
| --- | --- | --- |
| 1. Menjalankan proyek dengan Docker | Aplikasi jalan di `http://127.0.0.1:8000` (PHP 8.3 + Apache, MySQL 8.0) | `bfe88bd` |
| 2. Audit kode (tanpa mengubah file) | 7 area diperiksa, 5 temuan prioritas | — |
| 3. Perbaikan 5 temuan prioritas | Semua diperbaiki dan diuji di container | `cad9253` |
| 4. Pengujian otomatis TP-25..TP-34 | 19 tes lulus, 0 gagal; 2 temuan baru | `b2d5232` |

Laporan lengkap (Claude Docs):

- Laporan Audit Kode: https://claude.ai/artifact/CZxnVBDW2hgpYTaFQLxYMP
- Laporan Perbaikan: https://claude.ai/artifact/XjzZi4koXRybVHAaJrDF1F
- Laporan Pengujian: https://claude.ai/artifact/978tP6crDPKx3bNhupEApq

## 1. Docker

| File | Fungsi |
| --- | --- |
| `Dockerfile` | Multi-stage: dependency Composer, build aset Vite (butuh `vendor/filament`), runtime PHP 8.3 + Apache |
| `docker-compose.yml` | Service `app` (port 8000) dan `db` MySQL 8.0 (port host 3307 agar tidak bentrok dengan MySQL lokal) |
| `docker/entrypoint.sh` | Saat start: `migrate`, `db:seed` hanya jika tabel users kosong, `storage:link` |
| `docker/php.ini` | Upload 20 MB, memori 512 MB, zona waktu Asia/Jakarta |
| `.dockerignore` | `.env`, `vendor`, `node_modules`, `tests`, `docker/test` tidak ikut ke image |

Perintah:

```bash
docker compose up -d --build   # build & jalankan
docker compose logs -f app     # lihat log
docker compose down            # stop (data DB tetap ada di volume db-data)
```

Catatan:

- Pengaturan `DB_*` di `.env` di-override oleh `docker-compose.yml` (user/pass/db: `bukutamu`), jadi `.env` untuk menjalankan tanpa Docker tidak perlu diubah.
- `storage/app/public` di-mount dari folder proyek, jadi file upload tersimpan di host.
- Kode disalin ke image; setelah mengubah kode jalankan `docker compose up -d --build`.
- Seeder pertama kali butuh sekitar 2–3 menit (sekitar 526 akun dengan bcrypt).

## 2. Audit kode

Audit dilakukan tanpa mengubah file. Ringkasan per area:

| No | Area | Kesimpulan |
| --- | --- | --- |
| 1 | Isolasi data antarinstansi | Aman lewat `getEloquentQuery()` (404) dan `canViewAny()` (403). Tidak ada Policy untuk Guest/PerangkatDaerah/User. |
| 2 | Halaman publik `/instansi/{slug}` | Menampilkan nama, asal, nomor ID, dan waktu dari 5 tamu terbaru tanpa login; foto tidak ditampilkan. |
| 3 | API | `api_key` plaintext, dicocokkan di SQL tanpa membedakan huruf besar/kecil, tanpa rate limit. Sanctum terpasang tetapi tidak dipakai. |
| 4 | Data 524 Perangkat Daerah | 378 desa, 39 puskesmas, 33 kecamatan, 25 dinas, dan lain-lain. Bug: 89 telepon tersimpan `-`. |
| 5 | Keamanan input | XSS lewat `ttd_digital` di admin; ekstensi foto diambil dari data URI kiriman browser; Turnstile login admin terpasang. |
| 6 | Data pribadi | Tidak ada persetujuan privasi dan tidak ada retensi/penghapusan otomatis. |
| 7 | Versi | Laravel 12.53.0, Filament 3.3.49, Livewire 3.7.11, PHP `^8.2`. |

## 3. Perbaikan 5 temuan prioritas

| No | Temuan | Perbaikan | File utama |
| --- | --- | --- | --- |
| 1 | Stored XSS lewat `ttd_digital` | `Guest::signatureDataUri()` hanya meloloskan data URI gambar base64; dipakai di admin, ekspor PDF/Excel, dan halaman `/article` | `app/Models/Guest.php`, `app/Filament/Resources/GuestResource.php`, `app/Exports/GuestExport.php`, `resources/views/exports/guests.blade.php` |
| 2 | Ekstensi foto dari data URI kiriman browser | Decode ketat dan deteksi MIME dari isi file; foto JPG/PNG/WEBP maks. 5 MB, tanda tangan PNG maks. 1 MB; whitelist avatar; `submit()` memvalidasi ulang semua langkah | `app/Livewire/GuestForm.php` |
| 3 | API key plaintext, tanpa rate limit | Hash SHA-256 + `hash_equals`; `throttle:60,1`; kunci baru ditampilkan sekali dari form admin; migrasi meng-hash key lama | `app/Models/PerangkatDaerah.php`, `app/Http/Middleware/CheckApiKey.php`, `routes/api.php`, `app/Filament/Resources/PerangkatDaerahResource.php`, `database/migrations/2026_11_14_000001_*` |
| 4 | `emit()` tidak ada di Livewire 3; `/article` error 500 | `dispatch()`; route `/article/{guest}` wajib login dan dibatasi per instansi; nama di judul di-escape; breadcrumb `guest` ditambahkan | `app/Livewire/GuestForm.php`, `routes/web.php`, `app/Livewire/Guest/Show.php`, `resources/views/livewire/guest/show.blade.php`, `routes/breadcrumbs.php` |
| 5 | Telepon 89 PD tersimpan `-` | Seeder membaca `telepon` dan `telp`; migrasi backfill hanya mengisi baris yang masih `-` | `database/seeders/PerangkatDaerahSeeder.php`, `database/migrations/2026_11_14_000002_*` |

Perubahan perilaku:

- Tamu wajib memilih avatar atau mengambil foto (default lama `man-young.png` tidak ada filenya).
- Klien API yang mengirim lebih dari 60 request/menit dari satu IP mendapat HTTP 429.
- Pencocokan API key membedakan huruf besar/kecil.
- Setelah `php artisan migrate`, API key lama tidak bisa dilihat lagi di panel admin; buat ulang dari halaman edit instansi jika lupa. Klien API yang sudah ada tetap jalan tanpa perubahan.

## 4. Pengujian otomatis

File tes: `tests/Feature/BukuTamuSkenarioTest.php` (19 tes, 90 assertion, semua lulus).

| Kode TP | Skenario | Hasil |
| --- | --- | --- |
| TP-25 | Admin A membuka edit tamu milik B | 404 |
| TP-26 | Admin A membuka edit Perangkat Daerah B | 404 |
| TP-27 | Admin A membuka daftar/edit user | 403 |
| TP-31 | QR di `/instansi/diskominfo` di-decode | Menuju `/kunjungan/diskominfo` |
| TP-32 | Widget "Tamu Hari Ini" admin A | 1 → 2 (tamu A) → 2 (tamu B) |
| TP-33 | Reset password lewat halaman lupa password | Sandi baru berhasil, sandi lama gagal, token lebih dari 60 menit ditolak |
| TP-34 | Turnstile di login admin | Secret gagal/tanpa token ditolak; secret lolos berhasil |
| Tambahan | Formulir tamu publik sampai submit | Tersimpan ke instansi A (avatar dan foto kamera) |

Lingkungan: PHP 8.3.36, Laravel 12.53.0, PHPUnit 12.5.44, MySQL 8.0.46 di container terpisah, kunci uji resmi Cloudflare Turnstile.

Menjalankan tes (dari root repo; image aplikasi `buku-tamu-malang:latest` harus sudah di-build lewat `docker compose build`):

```bash
docker network create bukutamu-test
docker run -d --name bukutamu-testdb --network bukutamu-test --tmpfs /var/lib/mysql \
  -e MYSQL_DATABASE=bukutamu_test -e MYSQL_USER=test -e MYSQL_PASSWORD=test -e MYSQL_ROOT_PASSWORD=root mysql:8.0
docker build -f docker/test/Dockerfile.test -t buku-tamu-malang:test docker/test
docker run --rm --network bukutamu-test -v "$PWD/tests:/var/www/html/tests:ro" buku-tamu-malang:test php artisan test
docker rm -f bukutamu-testdb && docker network rm bukutamu-test
```

Di Git Bash (Windows), awali perintah `docker run` yang memakai path Linux dengan `MSYS_NO_PATHCONV=1`.

Catatan teknis: dalam satu metode tes, jangan berganti user setelah respons 403/404. Binding `redirect` Livewire tertinggal di container aplikasi tes dan memicu 500 palsu. Karena itu setiap metode tes hanya memakai satu user.

## 5. Yang belum dikerjakan

Temuan dari pengujian (sengaja belum diperbaiki):

- [ ] Halaman lupa password mengirim `Filament\Notifications\Auth\ResetPassword` (bahasa Inggris), sehingga `App\Notifications\ResetPasswordNotification` (bahasa Indonesia) tidak pernah terpakai.
- [ ] `app/Filament/Auth/RequestPasswordReset.php` merender widget Turnstile tetapi tidak memvalidasi token di server.

Temuan audit di luar 5 prioritas:

- [ ] Belum ada checkbox persetujuan/pemberitahuan privasi di formulir tamu.
- [ ] Belum ada retensi atau penghapusan otomatis data tamu (foto wajah dan tanda tangan).
- [ ] Halaman publik `/instansi/{slug}` menampilkan nama dan asal 5 tamu terbaru tanpa login.
- [ ] Upload foto/logo di admin belum punya `maxSize` (mengikuti default Livewire 12 MB).
- [ ] Ekspor Excel menulis file tanda tangan `sig_*.png` ke `storage/app/public` dan tidak pernah menghapusnya.

Langkah berikutnya:

- [ ] Push branch `feat/docker-security-fixes` dan buat PR ke `main`.
- [ ] Saat deploy: jalankan `php artisan migrate`, lalu beri tahu instansi pemakai API bahwa key tetap sama.
