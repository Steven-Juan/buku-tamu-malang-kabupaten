<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget;

class CustomWelcomeWidget extends AccountWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 1;

    protected static string $view = 'filament.widgets.custom-welcome-widget';
}
