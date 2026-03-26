<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}
            {{ $this->registerAction }}
        </x-slot>
    @endif

    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        {{-- Widget Turnstile yang Benar --}}
        <div class="mt-4 flex justify-center" wire:ignore>
            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.sitekey') }}"
                data-callback="onTurnstileSuccess" data-theme="dark"></div>
        </div>

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    {{-- Script untuk Handle Token ke Livewire --}}
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
        function onTurnstileSuccess(token) {
            // Kirim token langsung ke properti 'turnstile_token' di class Login.php
            @this.set('turnstile_token', token);
        }

        // Reset widget jika login gagal (didengar dari backend)
        window.addEventListener('reset-turnstile', () => {
            if (window.turnstile) {
                turnstile.reset();
            }
        });
    </script>
</x-filament-panels::page.simple>
