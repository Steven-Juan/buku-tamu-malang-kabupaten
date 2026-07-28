@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-2"
        x-data
        @click="document.getElementById('daftar-instansi')?.scrollIntoView({ behavior: 'smooth' })">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-2xl bg-gray-100 dark:bg-gray-800/60 text-gray-400 dark:text-gray-600 text-xs font-semibold cursor-not-allowed border border-gray-100 dark:border-gray-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Sebelumnya
            </span>
        @else
            <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-2xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 text-xs font-semibold hover:border-primary dark:hover:border-primary hover:text-primary dark:hover:text-primary transition-all duration-300 shadow-sm active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Sebelumnya
            </button>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden sm:flex items-center gap-1.5 px-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-xs font-semibold text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-r from-primary to-secondary text-white font-bold text-xs shadow-md shadow-primary/20 scale-105">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 font-semibold text-xs hover:border-primary hover:text-primary transition-all duration-200 shadow-sm">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Mobile Indicator --}}
        <span class="sm:hidden px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-2xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 text-xs font-semibold hover:border-primary dark:hover:border-primary hover:text-primary dark:hover:text-primary transition-all duration-300 shadow-sm active:scale-95">
                Selanjutnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @else
            <span class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-2xl bg-gray-100 dark:bg-gray-800/60 text-gray-400 dark:text-gray-600 text-xs font-semibold cursor-not-allowed border border-gray-100 dark:border-gray-800">
                Selanjutnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif

    </nav>
@endif
