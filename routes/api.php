<?php

use App\Http\Controllers\Api\KunjunganController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/kunjungan/{slug}', [KunjunganController::class, 'getKunjunganByDinas']);
});