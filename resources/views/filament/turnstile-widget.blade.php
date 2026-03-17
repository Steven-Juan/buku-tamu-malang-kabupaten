<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<div class=" bg-gray-50 dark:bg-gray-900 rounded-xl flex flex-col items-center justify-center">
    @php $turnstileSitekey = config('services.turnstile.sitekey'); @endphp

    @if ($turnstileSitekey)
        <div wire:ignore x-data="{
            initTurnstile() {
                if (window.turnstile) {
                    const container = $refs.turnstile;
                    if (container.children.length === 0) {
                        turnstile.render(container, {
                            sitekey: '{{ $turnstileSitekey }}',
                            callback: (token) => {
                                $wire.set('turnstile_token', token);
                            }
                        });
                    }
                }
            }
        }" x-init="initTurnstile()" x-ref="turnstile" data-turnstile-container></div>
    @else
        <p class="text-sm text-red-500">Turnstile belum dikonfigurasi.</p>
    @endif

    @error('turnstile_token')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
