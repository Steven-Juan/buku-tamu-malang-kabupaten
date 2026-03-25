<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\PerangkatDaerah;

class KunjunganController extends Controller
{
    public function getKunjunganByDinas($slug)
    {
        // 1. Cari instansi berdasarkan slug
        $instansi = PerangkatDaerah::where('slug', $slug)->first();

        if (! $instansi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Perangkat Daerah tidak ditemukan',
            ], 404);
        }

        // 2. Ambil data tamu (misal: 10 tamu terbaru)
        // Kita Sembunyikan ttd_digital dan ID agar data sensitif aman
        $tamu = Guest::where('perangkat_daerah_id', $instansi->id)
            ->select('id', 'nama', 'asal_instansi', 'keperluan', 'pesan_kesan', 'foto', 'created_at')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                // Format ulang data agar URL foto bisa langsung dipakai web lain
                return [
                    'nama' => $item->nama,
                    'asal_instansi' => $item->asal_instansi,
                    'keperluan' => $item->keperluan,
                    'pesan_kesan' => $item->pesan_kesan,
                    // Cek apakah foto dari kamera (storage) atau avatar
                    'foto_url' => str_starts_with($item->foto, 'avatars/')
                                  ? asset('images/'.$item->foto)
                                  : asset('storage/'.$item->foto),
                    'waktu_kunjungan' => $item->created_at->format('d M Y H:i'),
                    'waktu_kunjungan_human' => $item->created_at->diffForHumans(),
                ];
            });

        // 3. Kembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'instansi' => $instansi->nama_pd,
            'total_semua_kunjungan' => Guest::where('perangkat_daerah_id', $instansi->id)->count(),
            'data' => $tamu,
        ], 200);
    }
}
