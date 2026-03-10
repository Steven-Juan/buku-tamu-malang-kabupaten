@props(['hideClock' => false])

<header class="fixed top-4 left-0 right-0 z-50 transition-all duration-300" x-data="{ scrolled: false }"
    @scroll.window="scrolled = window.scrollY > 20">
    <x-container size="lg">
        <nav class="flex items-center justify-between px-4 md:px-6 py-3 shadow-lg rounded-full transition-all duration-300
                   {{-- Dynamic background based on scroll --}}
                   bg-white/80 dark:bg-gray-900/80 backdrop-blur-md 
                   border border-white/20 dark:border-gray-800
                   {{-- Hover effect --}}
                   hover:shadow-xl hover:shadow-primary/10
                   {{-- Scroll state --}}
                   :class=" scrolled ? 'shadow-primary/5' : ''"
                   x-bind:class=" scrolled ? 'py-2' : 'py-3'">
            
            {{-- Logo with enhanced animation --}}
            <a wire:navigate href=" /" class="flex items-center gap-2 group" aria-label="Buku Tamu Digital">
            <div class="relative">
                {{-- Animated background --}}
                <div
                    class="absolute inset-0 bg-primary/20 rounded-xl blur-md group-hover:blur-lg transition-all opacity-0 group-hover:opacity-100">
                </div>

                {{-- Icon container --}}
                <div class="relative bg-gradient-to-br from-primary to-primary/80 p-2.5 rounded-xl 
                                group-hover:rotate-12 group-hover:scale-110 transition-all duration-300 
                                shadow-lg shadow-primary/30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                        <path d="M8 7h6" />
                        <path d="M8 11h8" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-col leading-none">
                <span class="font-extrabold text-lg tracking-tighter text-text-dark dark:text-text-light">
                    Malang<span class="text-primary italic relative">
                        Kab
                        {{-- Underline effect --}}
                        <span
                            class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary/30 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                    </span>
                </span>
                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Buku Tamu Digital</span>
            </div>
            </a>

            {{-- Right section --}}
            <div class="flex items-center gap-2 md:gap-4">

                {{-- Digital Clock with improved visibility --}}
                @unless($hideClock)
                <div class="hidden md:flex flex-col items-end leading-none border-r border-gray-200 dark:border-gray-700 pr-4 mr-1
                          relative overflow-hidden group/clock">
                    {{-- Background effect --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-l from-primary/5 to-transparent opacity-0 group-hover/clock:opacity-100 transition-opacity">
                    </div>

                    <span id="digital-clock" class="font-mono font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent
                               tracking-widest text-sm relative">
                        00:00:00
                    </span>
                    <span class="text-[9px] uppercase font-bold text-gray-400 flex items-center gap-1">
                        <span class="w-1 h-1 rounded-full bg-green-500 animate-pulse"></span>
                        WIB
                    </span>
                </div>
                @endunless

                {{-- Theme toggle with animation --}}
                <button @click="darkMode = !darkMode; $dispatch('theme-toggled', darkMode)" class="relative p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 
                               border border-gray-200 dark:border-gray-700 transition-all 
                               text-gray-600 dark:text-gray-400
                               hover:scale-110 active:scale-95
                               group/theme" aria-label="Toggle theme">
                    {{-- Sun icon --}}
                    <svg x-show="!darkMode"
                        class="w-4 h-4 transition-transform group-hover/theme:rotate-90 duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.727 12.727L13 13l4-4" />
                    </svg>

                    {{-- Moon icon --}}
                    <svg x-show="darkMode"
                        class="w-4 h-4 transition-transform group-hover/theme:-rotate-12 duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>

                    {{-- Glow effect --}}
                    <span
                        class="absolute inset-0 rounded-full bg-primary/20 scale-0 group-hover/theme:scale-100 transition-transform"></span>
                </button>

                {{-- Dynamic button with user status --}}
                <x-button :url="Filament\Pages\Dashboard::getUrl()" :color="Auth::check() ? 'primary' : 'outline'"
                    size="xs" :icon="Auth::check() ? 'heroicon-o-cog-8-tooth' : 'heroicon-s-user'"
                    :iconRight="Auth::check() ? 'heroicon-o-arrow-right-circle' : null" class="group/btn">

                    <span x-data="{ user: {{ Auth::check() ? 'true' : 'false' }} }">
                        <span x-show="user" class="flex items-center gap-1">
                            <span class="hidden sm:inline">Dashboard</span>
                            <span class="sm:hidden">Manage</span>
                        </span>
                        <span x-show="!user">Login Admin</span>
                    </span>
                </x-button>
            </div>
        </nav>
    </x-container>
</header>

{{-- Add Alpine.js store for theme persistence if not already present --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        dark: localStorage.getItem('darkMode') === 'true',

        toggle() {
            this.dark = !this.dark;
            localStorage.setItem('darkMode', this.dark);

            if (this.dark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
});
</script>