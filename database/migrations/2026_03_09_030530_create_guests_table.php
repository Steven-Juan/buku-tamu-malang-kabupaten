<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perangkat_daerah_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('asal_instansi');
            $table->text('keperluan');
            $table->text('pesan_kesan')->nullable();
            $table->string('foto')->nullable();
            $table->longText('ttd_digital');
            $table->string('ip_address')->nullable();
            $table->string('device_info')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
