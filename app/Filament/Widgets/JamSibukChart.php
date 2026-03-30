<?php

namespace App\Filament\Widgets;

use App\Models\Guest;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JamSibukChart extends ChartWidget
{
    protected static ?string $heading = 'Jam Sibuk Kunjungan';

    public static function canView(): bool
    {
        // Hanya muncul jika user PUNYA perangkat_daerah_id (Bukan Superadmin)
        return auth()->user()?->perangkat_daerah_id !== null;
    }

    protected static ?int $sort = 3;

    protected function getData(): array
    {

        $user = auth()->user();

        // Query ambil jam dari created_at
        $data = Guest::where('perangkat_daerah_id', $user->perangkat_daerah_id)
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour')
            ->toArray();

        // Menyusun label jam 08:00 - 16:00
        $labels = [];
        $values = [];
        for ($i = 8; $i <= 16; $i++) {
            $labels[] = sprintf('%02d:00', $i);
            $values[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tamu',
                    'data' => $values,
                    'backgroundColor' => 'rgb(249, 115, 22)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
