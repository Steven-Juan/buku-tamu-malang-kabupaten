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
    }
}
