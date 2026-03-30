<?php

namespace App\Filament\Widgets;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuperAdminStats extends BaseWidget
{
    public static function canView(): bool
    {
        // Hanya muncul jika user TIDAK PUNYA perangkat_daerah_id (Superadmin)
        return auth()->user()?->perangkat_daerah_id === null;
    }

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count())
                ->description('Semua akun admin')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total Instansi', PerangkatDaerah::count())
                ->description('Total Perangkat Daerah')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success'),

            Stat::make('Total Kunjungan', Guest::count())
                ->description('Seluruh tamu di Kabupaten')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('warning'),
        ];
    }
}
