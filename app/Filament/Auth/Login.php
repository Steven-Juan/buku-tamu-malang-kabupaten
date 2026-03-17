<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Validation\ValidationException;

class Login extends BaseAuth
{
    public $turnstile_token = '';

    /**
     * Get the form for the resource.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getUsernameFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
                View::make('filament.turnstile-widget')
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    /**
     * Get the username form component.
     */
    protected function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    /**
     * Get the credentials from the form data.
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        $type = filter_var($data['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $type => $data['username'],
            'password' => $data['password'],
        ];
    }

    /**
     * Attempt to authenticate the user.
     */
    public function authenticate(): ?LoginResponse
    {
        // Validasi Turnstile
        $this->validate([
            'turnstile_token' => 'required|turnstile',
        ], [
            'turnstile_token.required' => 'Silakan centang verifikasi keamanan.',
            'turnstile_token.turnstile' => 'Verifikasi keamanan gagal, silakan coba lagi.',
        ]);

        try {
            $response = parent::authenticate();

            return $response;
        } catch (ValidationException $e) {

            throw ValidationException::withMessages([
                'data.username' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }
    }
}
