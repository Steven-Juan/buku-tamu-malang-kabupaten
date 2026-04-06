<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // Menambahkan kolom jenis_kelamin setelah kolom nama
            $table->string('jenis_kelamin')->after('nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn('jenis_kelamin');
        });
    }
};
