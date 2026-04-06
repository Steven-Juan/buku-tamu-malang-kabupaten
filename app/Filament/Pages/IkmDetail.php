<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class IkmDetail extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationLabel = 'Statistik IKM';

    protected static ?string $title = 'Indeks Kepuasan Masyarakat';

    protected static ?string $navigationGroup = 'Laporan'; // Opsional, untuk grouping menu

    protected static string $view = 'filament.pages.ikm-detail';
}
