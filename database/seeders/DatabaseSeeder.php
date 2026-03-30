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

                    // Logika Tanggal: Antara 27 Maret hingga 30 Maret 2026
                    $hariAcak = rand(27, 30);

                    // Logika Jam: Antara jam 08:00 pagi (8) hingga 16:00 sore (16)
                    $jamAcak = rand(8, 16);
                    $menitAcak = rand(0, 59);

                    $timestamp = \Carbon\Carbon::create(2026, 3, $hariAcak, $jamAcak, $menitAcak);

                    Guest::create([
                        'perangkat_daerah_id' => $pd->id,
                        'nama' => $daftarNama[array_rand($daftarNama)],
                        'asal_instansi' => $daftarUniversitas[array_rand($daftarUniversitas)],
                        'keperluan' => 'Koordinasi teknis data ke-'.$i.' di '.$pd->nama_pd,
                        'pesan_kesan' => 'Pelayanan cepat dan informatif.',
                        'ttd_digital' => 'data:image/png;base64,sample_seed_'.$pd->id.'_'.$i,
                        'foto' => 'images/user.png',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ]);
                }
            }
        }
    }
}
