<?php

use App\Models\PerangkatDaerah;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah api_key yang masih plaintext menjadi hash SHA-256.
     * Klien API tetap mengirim kunci yang sama; yang berubah hanya cara penyimpanannya.
     */
    public function up(): void
    {
        DB::table('perangkat_daerahs')
            ->whereNotNull('api_key')
            ->orderBy('id')
            ->select(['id', 'api_key'])
            ->each(function ($row) {
                // Lewati yang sudah berupa hash (migrasi aman dijalankan ulang)
                if (preg_match('/^[a-f0-9]{64}$/', $row->api_key)) {
                    return;
                }

                DB::table('perangkat_daerahs')
                    ->where('id', $row->id)
                    ->update(['api_key' => PerangkatDaerah::hashApiKey($row->api_key)]);
            });
    }

    /**
     * Hash tidak bisa dikembalikan ke plaintext; buat ulang API key dari panel admin bila perlu.
     */
    public function down(): void
    {
        //
    }
};
