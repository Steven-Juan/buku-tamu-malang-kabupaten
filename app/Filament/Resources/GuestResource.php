<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class GuestResource extends Resource
{
    /**
     * The resource record title.
     */
    protected static ?string $recordTitleAttribute = 'nama';

    /**
     * The resource model.
     */
    protected static ?string $model = Guest::class;

    /**
     * The resource icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    /**
     * The resource navigation sort order.
     */
    protected static ?int $navigationSort = 3;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    /**
     * Get the form for the resource.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\Section::make('Identitas & Keperluan')
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('nama')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('asal_instansi')
                                    ->label('Asal Instansi/Perusahaan')
                                    ->required(),

                                Forms\Components\Textarea::make('keperluan')
                                    ->required()
                                    ->rows(3),

                                Forms\Components\Textarea::make('pesan_kesan')
                                    ->label('Pesan & Kesan')
                                    ->rows(3),
                            ]),

                        Forms\Components\Section::make('Detail Kunjungan')
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\Select::make('perangkat_daerah_id')
                                    ->label('Tujuan Dinas')
                                    ->relationship('perangkatDaerah', 'nama_pd')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Forms\Components\FileUpload::make('foto')
                                    ->image()
                                    ->directory('guests/photos')
                                    ->default('images/user.png'),

                                Forms\Components\Placeholder::make('ttd_digital')
                                    ->label('Tanda Tangan')
                                    ->content(function ($record) {
                                        if (! $record || ! $record->ttd_digital) {
                                            return 'Awaiting signature...';
                                        }

                                        return new HtmlString("
            <div class='mt-2 p-2 bg-white border rounded-lg' style='width: fit-content;'>
                <img src='{$record->ttd_digital}'
                     alt='Tanda Tangan'
                     style='height: 100px; width: auto;'
                     class='block' />
            </div>
        ");
                                    }),
                            ]),
                    ]),
            ]);
    }

    /**
     * Get the table for the resource.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('perangkatDaerah.nama_pd')
                    ->label('Instansi Tujuan')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('asal_instansi')
                    ->label('Asal'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Datang')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('perangkat_daerah_id')
                    ->label('Filter per Dinas')
                    ->relationship('perangkatDaerah', 'nama_pd'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
