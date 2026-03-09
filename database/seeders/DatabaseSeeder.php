<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'perangkat_daerah_id' => null,
            'name' => 'Super Admin 1',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'perangkat_daerah_id' => null,
            'name' => 'Super Admin 2',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        $daftarPD = [
            ['nama' => 'Dinas Komunikasi dan Informatika', 'slug' => 'diskominfo'],
            ['nama' => 'Dinas Kesehatan', 'slug' => 'dinkes'],
            ['nama' => 'Dinas Pendidikan', 'slug' => 'disdik'],
            ['nama' => 'Dinas Perhubungan', 'slug' => 'dishub'],
            ['nama' => 'Satuan Polisi Pamong Praja', 'slug' => 'satpolpp'],
        ];

        foreach ($daftarPD as $pd) {
            $perangkat = PerangkatDaerah::create([
                'nama_pd' => $pd['nama'],
                'slug' => $pd['slug'],
                'alamat' => 'Jl. Raya Kabupaten Malang No. '.rand(1, 100),
                'telepon' => '0341-'.rand(111111, 999999),
                'api_token' => Str::random(32),
            ]);

            User::create([
                'perangkat_daerah_id' => $perangkat->id,
                'name' => 'Admin '.$pd['slug'],
                'email' => $pd['slug'].'@malangkab.go.id',
                'password' => Hash::make('admin123'),
            ]);
        }

        $allPD = PerangkatDaerah::all();

        $daftarNama = [
            'Budi Santoso',
            'Siti Aminah',
            'Ahmad Hidayat',
            'Dewi Lestari',
            'Eko Prasetyo',
            'Rina Wijaya',
            'Agus Setiawan',
            'Sri Wahyuni',
            'Fajar Ramadhan',
            'Putri Utami',
            'Bambang Pamungkas',
            'Indah Permata',
            'Hadi Kusuma',
            'Luluk Mardiana',
            'Joko Susilo',
            'Mega Saputri',
            'Rian Ardiansyah',
            'Siska Amelia',
            'Taufik Hidayat',
            'Yuni Shara',
        ];

        $daftarUniversitas = [
            'Universitas Merdeka Malang',
            'Universitas Brawijaya',
            'Universitas Negeri Malang',
            'Universitas Muhammadiyah Malang',
            'Universitas Islam Malang',
            'Universitas Indonesia',
            'Universitas Gadjah Mada',
            'Institut Teknologi Bandung',
            'Institut Teknologi Sepuluh Nopember',
            'Universitas Airlangga',
        ];

        for ($i = 1; $i <= 25; $i++) {
            Guest::create([
                'perangkat_daerah_id' => $allPD->random()->id,
                'nama' => $daftarNama[array_rand($daftarNama)],
                'asal_instansi' => $daftarUniversitas[array_rand($daftarUniversitas)],
                'keperluan' => 'Keperluan urusan dinas nomor '.$i,
                'pesan_kesan' => 'Pelayanan memuaskan.',
                'ttd_digital' => 'data:image/png;base64,sample'.$i,
                'foto' => 'images/user.png',
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
