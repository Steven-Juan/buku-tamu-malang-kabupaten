<?php

namespace App\Filament\Resources\PerangkatDaerahResource\Pages;

use App\Filament\Resources\PerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPerangkatDaerah extends EditRecord
{
    protected static string $resource = PerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->perangkat_daerah_id === null),
        ];
    }

    // Tambahkan ini agar setelah Edit langsung kembali ke daftar tabel
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
