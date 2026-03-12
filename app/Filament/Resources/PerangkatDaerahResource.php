<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerangkatDaerahResource\Pages;
use App\Models\PerangkatDaerah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PerangkatDaerahResource extends Resource
{
    /**
     * The resource record title.
     */
    protected static ?string $recordTitleAttribute = 'nama_pd';

    /**
     * The resource model.
     */
    protected static ?string $model = PerangkatDaerah::class;

    /**
     * The resource icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    /**
     * The resource navigation sort order.
     */
    protected static ?int $navigationSort = 2;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getEloquentQuery()->count());
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user && $user->perangkat_daerah_id) {
            return $query->where('id', $user->perangkat_daerah_id);
        }

        return $query;
    }

    public static function canCreate(): bool
    {
        return Auth::user()->perangkat_daerah_id === null;
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
                        Forms\Components\Section::make('Informasi Utama')
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('nama_pd')
                                    ->label('Nama Perangkat Daerah')
                                    ->placeholder('Contoh: Dinas Komunikasi dan Informatika')
                                    ->live(onBlur: true) // PERBAIKAN: Gunakan onBlur agar tidak menghapus ketikan
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),

                                Forms\Components\Textarea::make('alamat')
                                    ->placeholder('Masukkan alamat lengkap kantor')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('telepon')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->placeholder('0341-xxxxxx')
                                    ->maxLength(20),
                            ]),

                        Forms\Components\Section::make('Pengaturan & Metadata')
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\TextInput::make('slug')
                                    ->placeholder('auto-generated-slug')
                                    ->alphaDash()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('api_token')
                                    ->label('API Token')
                                    ->default(fn () => Str::random(32))
                                    ->password()
                                    ->revealable()
                                    ->readOnly()
                                    ->helperText('Token otomatis untuk integrasi sistem.'),

                                Forms\Components\FileUpload::make('logo')
                                    ->image()
                                    ->directory('logos')
                                    ->imageEditor(),
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
            ->contentGrid(fn () => Auth::user()->perangkat_daerah_id ? null : [
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Tables\Columns\TextColumn::make('nama_pd')
                    ->label('Nama Instansi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('slug')
                    ->fontFamily('mono')
                    ->copyable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Kontak')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
                    ->visible(fn () => auth()->user()->perangkat_daerah_id === null),
            ])

            ->content(function () {
                if (Auth::user()->perangkat_daerah_id) {
                    return null;
                }
            });
    }

    /**
     * Get the pages for the resource.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerangkatDaerahs::route('/'),
            'create' => Pages\CreatePerangkatDaerah::route('/create'),
            'edit' => Pages\EditPerangkatDaerah::route('/{record}/edit'),
        ];
    }
}
