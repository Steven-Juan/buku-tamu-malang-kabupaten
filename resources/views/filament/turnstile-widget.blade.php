<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<div class="bg-gray-50 dark:bg-gray-900 rounded-xl flex flex-col items-center justify-center p-2">
    @php $turnstileSitekey = config('services.turnstile.sitekey'); @endphp

    @if ($turnstileSitekey)
        <div wire:ignore x-data="{
            initTurnstile() {
                if (window.turnstile) {
                    const container = $refs.turnstile;
                    // Render widget
                    const widgetId = turnstile.render(container, {
                        sitekey: '{{ $turnstileSitekey }}',
                        callback: (token) => {
                            @this.set('turnstile_token', token);
                        }
                    });
        
                    // Dengarkan event reset dari backend
                    $wire.on('reset-turnstile', () => {
                        turnstile.reset(widgetId);
                        @this.set('turnstile_token', ''); // Kosongkan token di Livewire
                    });
                } else {
                    // Jika script belum muat, coba lagi dalam 500ms
                    setTimeout(() => this.initTurnstile(), 500);
                }
            }
        }" x-init="initTurnstile()" x-ref="turnstile"></div>
    @else
        <p class="text-sm text-red-500">Turnstile belum dikonfigurasi.</p>
    @endif

    @error('turnstile_token')
        <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
    @enderror
</div>
