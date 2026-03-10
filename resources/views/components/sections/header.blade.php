@props(['hideClock' => false])

<header class="fixed top-4 left-0 right-0 z-50 transition-all duration-300" x-data="{ scrolled: false }"
    @scroll.window="scrolled = window.scrollY > 20">
    <x-container size="lg">
        <nav class="flex items-center justify-between px-4 md:px-6 py-3 shadow-lg rounded-full transition-all duration-300
                    bg-white/80 dark:bg-gray-900/80 backdrop-blur-md
                    border border-white/20 dark:border-gray-800
                    hover:shadow-xl hover:shadow-primary/10
                    :class="scrolled
            ? 'py-2 shadow-primary/5' : 'py-3'">

            {{-- Logo Section --}}
            <a wire:navigate href="/" class="flex items-center gap-2 group" aria-label="Buku Tamu Digital">
                <div class="relative">
                    {{-- Icon container: Solid bg-primary --}}
                    <div class="relative bg-primary p-2.5 rounded-xl
                                group-hover:rotate-6 group-hover:scale-105 transition-all duration-300
                                shadow-md shadow-primary/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d=" M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
        <path d="M8 7h6" />
        <path d="M8 11h8" />
        </svg>
        </div>
        </div>

        <div class="flex flex-col leading-none">
            <span class="font-extrabold text-lg tracking-tighter text-text-dark dark:text-text-light">
                Malang<span class="text-primary italic">Kab</span>
            </span>
            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Buku Tamu Digital</span>
        </div>
        </a>

        {{-- Right section --}}
        <div class="flex items-center gap-2 md:gap-4">

            {{-- Digital Clock: Warna Polos (Primary) --}}
            @unless ($hideClock)
                <div
                    class="hidden md:flex flex-col items-end leading-none border-r border-gray-200 dark:border-gray-700 pr-4 mr-1">
                    <span id="digital-clock"
                        class="font-mono font-bold text-primary dark:text-accent tracking-widest text-sm">
                        00:00:00
                    </span>
                    <span class="text-[9px] uppercase font-bold text-gray-400 flex items-center gap-1">
                        <span class="w-1 h-1 rounded-full bg-green-500 animate-pulse"></span>
                        WIB
                    </span>
                </div>
            @endunless

            {{-- Theme toggle --}}
            <button @click="darkMode = !darkMode; $dispatch('theme-toggled', darkMode)"
                class="p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-700 transition-all text-gray-600 dark:text-gray-400">
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2.5" stroke="currentColor"
                    class="w-4 h-4 transition-transform group-hover/theme:rotate-90 duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>

                <svg x-show="darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            {{-- Login Button: Solid color dari x-button --}}
            <x-button :url="Filament\Pages\Dashboard::getUrl()" :color="Auth::check() ? 'primary' : 'dark'" size="xs" :icon="Auth::check() ? 'heroicon-o-cog-8-tooth' : 'heroicon-s-user'">
                <span>{{ Auth::check() ? 'Dashboard' : 'Login Admin' }}</span>
            </x-button>
        </div>
        </nav>
    </x-container>
</header>
