<footer
    class="py-8 mt-0 border-t bg-gradient-to-b from-gray-50/50 to-white
               dark:from-gray-900/50 dark:to-gray-900">
    <x-container>
        <div class="px-4 sm:px-0">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3 sm:gap-4 text-center md:text-left">

                {{-- Copyright --}}
                <div
                    class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 order-2 md:order-1 leading-relaxed max-w-[280px] sm:max-w-none">
                    &copy; {{ date('Y') }}
                    <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent font-semibold">
                        {{ config('app.name') }}
                    </span>
                    <span class="text-gray-400">— All rights reserved</span>
                </div>

                {{-- Footer links --}}
                <div class="flex flex-wrap justify-center items-center gap-3 sm:gap-4 order-1 md:order-2">
                    <a href="#" class="text-xs text-gray-400 hover:text-primary transition-colors relative group">
                        Kebijakan Privasi
                        <span
                            class="absolute -bottom-1 left-0 w-full h-px bg-primary scale-x-0
                               group-hover:scale-x-100 transition-transform"></span>
                    </a>

                    {{-- vertical divider --}}
                    <div class="h-3 sm:h-4 w-px bg-gray-300 dark:bg-gray-700"></div>

                    <a href="#" class="text-xs text-gray-400 hover:text-primary transition-colors relative group">
                        Syarat & Ketentuan
                        <span
                            class="absolute -bottom-1 left-0 w-full h-px bg-primary scale-x-0
                               group-hover:scale-x-100 transition-transform"></span>
                    </a>
                </div>

                {{-- Version --}}
                <div class="text-xs text-gray-400 order-3">
                    v{{ config('app.version', '1.0.0') }}
                </div>
            </div>

            {{-- Mobile Login Button --}}
            <div class="sm:hidden mt-6 flex justify-center">
                <x-button :url="Filament\Pages\Dashboard::getUrl()" :color="Auth::check() ? 'primary' : 'dark'" size="xs"
                    class="w-full max-w-[240px] sm:max-w-[280px] justify-center" :icon="Auth::check() ? 'heroicon-o-cog-6-tooth' : 'heroicon-s-user'">

                    <span class="text-[12px] sm:text-sm">
                        {{ Auth::check() ? 'Masuk ke Dashboard' : 'Login Admin' }}
                    </span>
                </x-button>
            </div>

            {{-- Decorative gradient line --}}
            <div class="mt-6 h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent"></div>
        </div>
    </x-container>
</footer>
