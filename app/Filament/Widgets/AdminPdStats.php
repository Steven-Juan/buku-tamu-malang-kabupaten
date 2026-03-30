<?php

namespace App\Filament\Widgets;

use App\Models\Guest;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminPdStats extends BaseWidget
{
    public static function canView(): bool
    {
        // Hanya muncul jika user PUNYA perangkat_daerah_id (Bukan Superadmin)
        return auth()->user()?->perangkat_daerah_id !== null;
    }

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $pdId = auth()->user()->perangkat_daerah_id;

        // Query dasar terfilter PD
        $baseQuery = Guest::where('perangkat_daerah_id', $pdId);

        // Hitung Tamu Hari Ini & Kemarin untuk Kalkulasi Growth
        $todayCount = (clone $baseQuery)->whereDate('created_at', Carbon::today())->count();
        $yesterdayCount = (clone $baseQuery)->whereDate('created_at', Carbon::yesterday())->count();

        // Kalkulasi persentase kenaikan/penurunan
        $diff = $todayCount - $yesterdayCount;
        $trend = $diff >= 0 ? 'naik' : 'turun';
        $color = $diff >= 0 ? 'success' : 'danger';
        $icon = $diff >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';

        return [
            Stat::make('Total Tamu', (clone $baseQuery)->count())
                ->description('Total keseluruhan data')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Tamu Hari Ini', $todayCount)
                ->description($diff !== 0 ? abs($diff)." tamu $trend dari kemarin" : 'Sama dengan kemarin')
                ->descriptionIcon($icon)
                ->color($color),

            Stat::make('Tamu Minggu Ini', (clone $baseQuery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count())
                ->description('Akumulasi minggu berjalan')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),
        ];
    }
}
