<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;

class RequestPasswordReset extends BaseRequestPasswordReset
{
    public $turnstile_token = '';

    /**
     * Get the form for the resource.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email Perangkat Daerah')
                    ->email()
                    ->required()
                    ->autocomplete()
                    ->autofocus()
                    ->placeholder('Masukkan email yang terdaftar di akun admin Anda')
                    ->helperText('Masukkan email yang terdaftar pada akun admin Perangkat Daerah Anda.'),
                View::make('filament.turnstile-widget'),
            ]);
    }
}
