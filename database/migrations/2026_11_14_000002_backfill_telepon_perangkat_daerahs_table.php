<?php

use Database\Seeders\PerangkatDaerahSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Isi ulang nomor telepon yang hilang akibat bug seeder lama
     * (seeder hanya membaca key 'telp', padahal 89 entri memakai 'telepon').
     * Hanya baris yang teleponnya masih '-' atau kosong yang diubah, jadi data yang
     * sudah diedit admin tidak tertimpa.
     */
    public function up(): void
    {
        foreach (PerangkatDaerahSeeder::data() as $item) {
            $telepon = PerangkatDaerahSeeder::telepon($item);

            if ($telepon === '-') {
                continue;
            }

            DB::table('perangkat_daerahs')
                ->where('slug', $item['slug'])
                ->where(fn ($query) => $query->whereNull('telepon')->orWhereIn('telepon', ['-', '']))
                ->update(['telepon' => $telepon]);
        }
    }

    public function down(): void
    {
        //
    }
};
