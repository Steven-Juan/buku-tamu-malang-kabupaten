@props(['hideClock' => false])

<header class="fixed top-4 left-0 right-0 z-50 transition-all duration-500"
    x-data="{ scrolled: false, isHovered: false }" @scroll.window="scrolled = window.scrollY > 20"
    @mouseenter="isHovered = true" @mouseleave="isHovered = false">

    <x-container size="lg">
        <nav class="flex items-center justify-between px-4 md:px-6 py-3 rounded-2xl transition-all duration-500
                    bg-white/80 dark:bg-gray-900/80 backdrop-blur-md
                    border border-white/20 dark:border-gray-800/50
                    shadow-lg shadow-black/5" :class="{
                   'lg:rounded-full': !scrolled,
                   'lg:rounded-2xl shadow-xl shadow-primary/10 scale-[0.98]': scrolled,
                   'ring-2 ring-primary/20': isHovered
               }">

            {{-- Logo Section with enhanced animation --}}
            <a wire:navigate href="/" class="flex items-center gap-2 group relative overflow-hidden"
                aria-label="Buku Tamu Digital">

                {{-- Background shimmer effect --}}
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent 
                          -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

                <div class="relative flex items-center gap-2">
                    {{-- Icon container with 3D effect --}}
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/30 rounded-xl blur-md 
                                  group-hover:blur-xl transition-all opacity-0 group-hover:opacity-100"></div>
                        <div class="relative bg-gradient-to-br from-primary to-secondary p-2.5 rounded-xl
                                  group-hover:rotate-6 group-hover:scale-110 transition-all duration-500
                                  shadow-lg shadow-primary/30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="filter drop-shadow-md">
                                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                                <path d="M8 7h6" />
                                <path d="M8 11h8" />
                            </svg>
                        </div>
                    </div>

                    {{-- Text with gradient effect --}}
                    <div class="flex flex-col leading-none">
                        <span class="font-extrabold text-lg tracking-tighter">
                            <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                                Malang<span class="text-primary italic">Kab</span>
                            </span>
                        </span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest
                                  group-hover:text-gray-500 dark:group-hover:text-gray-300 transition-colors">
                            Buku Tamu Digital
                        </span>
                    </div>
                </div>
            </a>

            {{-- Right section with improved spacing --}}
            <div class="flex items-center gap-2 md:gap-3">

                {{-- Date & Digital Clock with glass morphism --}}
                @unless ($hideClock)
                <div class="hidden md:flex flex-col items-end leading-none pr-4 mr-1 relative">
                    {{-- Decorative line --}}
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-8 
                                  bg-gradient-to-b from-transparent via-gray-300 dark:via-gray-700 to-transparent">
                    </div>

                    {{-- Tanggal dengan efek glass --}}
                    <span class="text-sm md:text-base font-bold mb-1 px-3 py-1 rounded-full
                                   bg-gradient-to-r from-primary/10 to-accent/10 
                                   text-primary dark:text-accent">
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </span>

                    {{-- Jam dengan desain lebih modern --}}
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1.5 bg-gray-100/80 dark:bg-gray-800/80 
                                      px-2 py-1 rounded-lg border border-gray-200/50 dark:border-gray-700/50
                                      backdrop-blur-sm">
                            <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                            <span id="digital-clock" class="font-mono font-bold text-[13px] tracking-widest
                                                           text-gray-700 dark:text-gray-300">
                                00:00:00
                            </span>
                            <span class="text-[8px] font-black uppercase px-1.5 py-0.5 
                                           bg-gray-200/50 dark:bg-gray-700/50 rounded
                                           text-gray-500 dark:text-gray-400">
                                WIB
                            </span>
                        </div>
                    </div>
                </div>
                @endunless

                {{-- Theme toggle with improved animation --}}
                <button @click="darkMode = !darkMode; $dispatch('theme-toggled', darkMode)" class="p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 
                               border border-gray-200 dark:border-gray-700 transition-all duration-300
                               text-gray-600 dark:text-gray-400 relative group/theme
                               hover:border-primary/50 hover:text-primary dark:hover:text-accent
                               hover:shadow-lg hover:shadow-primary/10">

                    {{-- Tooltip --}}
                    <span class="absolute -bottom-8 left-1/2 -translate-x-1/2 text-[10px] 
                                 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900
                                 px-2 py-1 rounded opacity-0 group-hover/theme:opacity-100 
                                 transition-opacity duration-200 whitespace-nowrap pointer-events-none">
                    </span>

                    <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2.5" stroke="currentColor" class="w-5 h-5 transition-transform duration-500 
                                group-hover/theme:rotate-180">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>

                    <svg x-show="darkMode" class="w-5 h-5 transition-transform duration-500 
                                                   group-hover/theme:rotate-12" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                {{-- Login Button - TETAP SEPERTI ASLINYA, TIDAK DIUBAH --}}
                <x-button :url="Filament\Pages\Dashboard::getUrl()" :color="Auth::check() ? 'primary' : 'dark'"
                    size="sm" :icon="Auth::check() ? 'heroicon-o-cog-6-tooth' : 'heroicon-s-user'">
                    <span>{{ Auth::check() ? 'Dashboard' : 'Login Admin' }}</span>
                </x-button>
            </div>
        </nav>
    </x-container>
</header>