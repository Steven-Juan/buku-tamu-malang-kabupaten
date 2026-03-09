<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\Section::make('Profile Information')
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->required(fn(string $operation): bool => $operation === 'create'),
                            ]),

                        Forms\Components\Section::make('Access Control')
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\Select::make('perangkat_daerah_id')
                                    ->label('Admin Instansi')
                                    ->relationship('perangkatDaerah', 'nama_pd')
                                    ->searchable()
                                    ->preload()
                                    ->helperText('Kosongkan jika ingin dijadikan Superadmin.'),

                                Forms\Components\Toggle::make('two_factor_enabled')
                                    ->label('2FA Active')
                                    ->disabled(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('perangkatDaerah.nama_pd')
                    ->label('Role')
                    ->badge()
                    ->default('Superadmin')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->perangkat_daerah_id && $state) {
                            return "Admin " . $state;
                        }
                        return $state;
                    })
                    ->icon(fn($record): string => $record->perangkat_daerah_id ? 'heroicon-m-building-office' : 'heroicon-m-shield-check')
                    ->color(fn($record): string => $record->perangkat_daerah_id ? 'primary' : 'danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
