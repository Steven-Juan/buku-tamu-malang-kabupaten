<header class="fixed top-4 left-0 right-0 z-50 transition-all duration-300">
    <x-container size="lg">
        <nav
            class="flex items-center justify-between px-4 md:px-6 py-3 shadow-lg rounded-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border border-white/20 dark:border-gray-800 transition-colors">

            <a wire:navigate href="/" class="flex items-center gap-2 group" aria-label="Buku Tamu Digital">
                <div
                    class="bg-primary p-2 rounded-xl group-hover:rotate-12 transition-transform shadow-md shadow-primary/30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                        <path d="M8 7h6" />
                        <path d="M8 11h8" />
                    </svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-extrabold text-lg tracking-tighter text-text-dark dark:text-text-light">
                        Malang<span class="text-primary italic">Kab</span>
                    </span>
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Buku Tamu</span>
                </div>
            </a>

            <div class="flex items-center gap-2 md:gap-4">

                <div
                    class="hidden md:flex flex-col items-end leading-none border-r border-gray-200 dark:border-gray-700 pr-4 mr-1">
                    <span id="digital-clock"
                        class="font-mono font-bold text-primary dark:text-accent tracking-widest text-sm">00:00:00</span>
                    <span class="text-[9px] uppercase font-bold text-gray-400">WIB</span>
                </div>

                <button @click="darkMode = !darkMode"
                    class="p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-700 transition-all text-gray-600 dark:text-gray-400">
                    <svg x-show="!darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.727 12.727L13 13l4-4" />
                    </svg>
                    <svg x-show="darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <x-button :url="Filament\Pages\Dashboard::getUrl()" :color="Auth::check() ? 'primary' : 'dark'" size="xs" :icon="Auth::check() ? 'heroicon-o-cog' : 'heroicon-s-user'">
                    {{ Auth::check() ? 'Manage' : 'Login Admin' }}
                </x-button>
            </div>
        </nav>
    </x-container>
</header>
