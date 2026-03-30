<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="flex items-center justify-between gap-x-3">
            {{-- Bagian Kiri: Profil --}}
            <div class="flex items-center gap-x-3">
                <x-filament-panels::avatar.user size="lg" :user="$user = filament()->auth()->user()" />
                <div class="flex-1">
                    <h2 class="grid text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        Welcome,
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->name }}
                    </p>
                </div>
            </div>

            {{-- Bagian Tengah: Jam & Tanggal (Real-time) --}}
            <div class="hidden md:flex flex-col items-center border-x border-gray-200 dark:border-white/10 px-8">
                <div class="text-2xl font-bold tracking-tight text-primary-600 dark:text-primary-400" id="clock">
                    00:00:00
                </div>
                <div class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            {{-- Bagian Kanan: Sign Out --}}
            <form action="{{ filament()->getLogoutUrl() }}" method="post" class="my-auto">
                @csrf
                <x-filament::button color="gray" icon="heroicon-m-arrow-left-on-rectangle"
                    icon-alias="panels::widgets.account.logout-button" labeled-from="sm" tag="button" type="submit">
                    Sign out
                </x-filament::button>
            </form>
        </div>
    </x-filament::section>

    {{-- Script Jam Real-time --}}
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getHours()).padStart(2, '0'); // Sesuaikan ke menit
            const seconds = String(now.getSeconds()).padStart(2, '0');

            // Perbaikan logika jam ke menit yang benar:
            const realMinutes = String(now.getMinutes()).padStart(2, '0');

            document.getElementById('clock').textContent = `${hours}:${realMinutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-filament-widgets::widget>
