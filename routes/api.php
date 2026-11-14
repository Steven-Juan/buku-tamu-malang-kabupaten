<?php

use App\Http\Controllers\Api\KunjunganController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

// throttle dipasang sebelum CheckApiKey agar percobaan dengan key salah ikut dibatasi (60 request/menit per IP)
Route::prefix('v1')->middleware(['throttle:60,1', CheckApiKey::class])->group(function () {
    Route::get('/kunjungan/{slug}', [KunjunganController::class, 'getKunjunganByDinas']);
});
