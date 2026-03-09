<?php

namespace App\Filament\Resources\PerangkatDaerahResource\Pages;

use App\Filament\Resources\PerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPerangkatDaerah extends EditRecord
{
    use HasPreviewModal;

    /**
     * The resource model.
     *
     * @var string
     */
    protected static string $resource = PerangkatDaerahResource::class;

    /**
     * The preview modal URL.
     * * This will open the specific guest book page for this office.
     */
    protected function getPreviewModalUrl(): ?string
    {
        return route('guest.show', [
            'slug' => $this->record->slug,
        ]);
    }

    /**
     * Get the header actions.
     *
     * @return array<string, \Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make()
                ->label('Preview Form'),

            Actions\Action::make('view_form')
                ->label('Open Live Form')
                ->color('gray')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->url(fn($record) => route('guest.form', $record->slug))
                ->openUrlInNewTab(),

            Actions\DeleteAction::make(),
        ];
    }
}
