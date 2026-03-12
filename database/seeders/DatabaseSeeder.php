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

        // 3. Seed Guests (Data Dummy)
        $allPD = PerangkatDaerah::all();
        if ($allPD->count() > 0) {
            $daftarNama = ['Budi Santoso', 'Siti Aminah', 'Ahmad Hidayat', 'Dewi Lestari', 'Eko Prasetyo', 'Rina Wijaya'];
            $daftarUniversitas = ['Universitas Brawijaya', 'Universitas Negeri Malang', 'Universitas Merdeka Malang'];

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
}
