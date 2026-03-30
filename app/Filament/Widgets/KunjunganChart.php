<?php

namespace App\Filament\Widgets;

use App\Models\Guest;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class KunjunganChart extends ChartWidget
{
    // Heading akan berubah otomatis sesuai role
    public function getHeading(): ?string
    {
        return auth()->user()->perangkat_daerah_id
            ? 'Tren Kunjungan 7 Hari Terakhir (Instansi Anda)'
            : 'Tren Kunjungan 7 Hari Terakhir (Global)';
    }

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $user = auth()->user();

        // Mengambil data 7 hari terakhir
        $data = collect(range(6, 0))->map(function ($days) use ($user) {
            $date = Carbon::now()->subDays($days);

            // Buat query dasar
            $query = Guest::whereDate('created_at', $date);

            // Jika bukan Superadmin, filter berdasarkan PD user terkait
            if ($user->perangkat_daerah_id) {
                $query->where('perangkat_daerah_id', $user->perangkat_daerah_id);
            }

            return [
                'label' => $date->format('d M'),
                'count' => $query->count(),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Tamu',
                    'data' => $data->pluck('count')->toArray(),
                    'fill' => 'start',
                    'borderColor' => $user->perangkat_daerah_id ? 'rgb(16, 185, 129)' : 'rgb(59, 130, 246)', // Hijau jika PD, Biru jika Global
                    'backgroundColor' => $user->perangkat_daerah_id ? 'rgba(16, 185, 129, 0.1)' : 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $data->pluck('label')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
