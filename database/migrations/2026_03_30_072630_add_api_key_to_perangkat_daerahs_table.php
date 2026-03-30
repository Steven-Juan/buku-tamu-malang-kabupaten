<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perangkat_daerahs', function (Blueprint $table) {
            // Tambahkan kolom api_key, nullable agar data lama tidak error, dan unique agar tidak ada kunci ganda
            $table->string('api_key')->nullable()->unique()->after('slug');
        });
    }

    public function down(): void
    {
        Schema::table('perangkat_daerahs', function (Blueprint $table) {
            $table->dropColumn('api_key');
        });
    }
};
