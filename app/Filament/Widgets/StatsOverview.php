<?php

namespace App\Filament\Widgets;

use App\Models\Guest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Ambil data user yang sedang login
        $user = auth()->user();

        // 2. Buat query dasar
        $query = Guest::query();

        // 3. Jika bukan Super Admin (punya perangkat_daerah_id), filter datanya
        if ($user->perangkat_daerah_id !== null) {
            $query->where('perangkat_daerah_id', $user->perangkat_daerah_id);
        }

        return [
            Stat::make('Total Tamu', (clone $query)->count())
                ->description('Total tamu di instansi Anda')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Tamu Hari Ini', (clone $query)->whereDate('created_at', today())->count())
                ->description('Kunjungan baru hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
        ];
    }
}
