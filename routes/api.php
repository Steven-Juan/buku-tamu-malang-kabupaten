<?php

use App\Http\Controllers\Api\KunjunganController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware([CheckApiKey::class])->group(function () {
    Route::get('/kunjungan/{slug}', [KunjunganController::class, 'getKunjunganByDinas']);
});
