<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        $this->call(PerangkatDaerahSeeder::class);

        // 3. Seed Guests (Data Dummy Strategis untuk Chart)
        $targetPdIds = [1, 28, 30, 37, 46];
        $allPD = PerangkatDaerah::whereIn('id', $targetPdIds)->get();

        if ($allPD->count() > 0) {
            $daftarNama = ['Budi Santoso', 'Siti Aminah', 'Ahmad Hidayat', 'Dewi Lestari', 'Eko Prasetyo', 'Rina Wijaya', 'Slamet Riadi', 'Indah Permata'];
            $daftarUniversitas = ['Universitas Brawijaya', 'Universitas Negeri Malang', 'Universitas Merdeka Malang', 'Polinema'];

            foreach ($allPD as $pd) {
                // Buat 10 data per PD sesuai permintaan
                for ($i = 1; $i <= 10; $i++) {

                    $hariAcak = rand(1, 6);
                    $jamAcak = rand(8, 16);
                    $menitAcak = rand(0, 59);

                    $timestamp = \Carbon\Carbon::create(2026, 4, $hariAcak, $jamAcak, $menitAcak);

                    // Definisi daftar avatar yang tersedia
                    $daftarAvatar = [
                        'scholar-man.png',
                        'scholar-woman.png',
                        'officer-man.png',
                        'officer-woman.png',
                        'guest-man.png',
                        'guest-woman.png'
                    ];

                    Guest::create([
                        'perangkat_daerah_id' => $pd->id,
                        'nama'               => $daftarNama[array_rand($daftarNama)],
                        'asal_instansi'      => $daftarUniversitas[array_rand($daftarUniversitas)],
                        'keperluan'          => 'Koordinasi teknis data ke-' . $i . ' di ' . $pd->nama_pd,
                        'pesan_kesan'        => 'Pelayanan cepat dan informatif.',
                        'ttd_digital'        => 'data:image/png;base64,sample_seed_' . $pd->id . '_' . $i,

                        // Memilih avatar secara acak dari folder images/avatars
                        'foto'               => 'images/avatars/' . $daftarAvatar[array_rand($daftarAvatar)],

                        'created_at'         => $timestamp,
                        'updated_at'         => $timestamp,
                    ]);
                }
            }
        }
    }
}
