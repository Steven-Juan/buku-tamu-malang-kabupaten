<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class GuestGrowthChart extends ChartWidget
{
    protected static ?string $heading = 'Pertumbuhan Tamu Tahunan (Global)';

    public static function canView(): bool
    {
        // Hanya muncul jika user TIDAK PUNYA perangkat_daerah_id (Superadmin)
        return auth()->user()?->perangkat_daerah_id === null;
    }

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = collect(range(1, 12))->map(function ($month) {
            return [
                'month' => date('M', mktime(0, 0, 0, $month, 1)),
                'count' => \App\Models\Guest::whereMonth('created_at', $month)
                    ->whereYear('created_at', date('Y'))
                    ->count(),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Tamu',
                    'data' => $data->pluck('count')->toArray(),
                    'borderColor' => '#10b981', // Hijau Emerald
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
