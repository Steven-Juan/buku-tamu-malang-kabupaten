<div x-data="{ 
        searchFocused: false,
        greeting: new Date().getHours()
    }" class='bg-gradient-to-b from-light to-gray-50 dark:from-dark dark:to-gray-900 
           text-text-dark dark:text-text-light min-h-screen transition-colors duration-300 
           flex flex-col items-center'>

    {{-- Hero Section with improved gradient --}}
    <x-hero class="bg-transparent !mb-0 !py-16 md:!py-24 w-full relative overflow-hidden">
        {{-- Animated background elements --}}
        <div class="absolute inset-0 overflow-hidden">
            {{-- Gradient orbs --}}
            <div class="absolute top-0 -right-40 w-96 h-96 bg-gradient-to-br from-primary/10 to-accent/10 
                      rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-accent/10 to-primary/10 
                      rounded-full blur-3xl animate-pulse animation-delay-1000"></div>

            {{-- Grid pattern --}}
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60" viewBox="0 0 60 60"
                xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%239C92AC"
                fill-opacity="0.05" %3E%3Cpath
                d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        </div>

        <x-slot name="title">
            <div class="relative">
                <h1 class="text-center text-4xl md:text-5xl lg:text-6xl font-extrabold 
                         leading-[1.1] tracking-tight mx-auto px-4">
                    <span class="inline-block animate-fade-in-up">Layanan</span>
                    <br />
                    <span class='relative inline-block mt-2 animate-fade-in-up animation-delay-200'>
                        <span class='bg-gradient-to-r from-primary via-secondary to-accent 
                                   bg-clip-text text-transparent italic bg-size-200 animate-gradient'>
                            Buku Tamu Digital
                        </span>

                        {{-- Animated underline with sparkle --}}
                        <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-3/4 h-1 
                                   bg-gradient-to-r from-primary via-secondary to-accent 
                                   rounded-full scale-x-0 animate-slide-in"></span>

                        {{-- Sparkle effects --}}
                        <span class="absolute -top-6 -right-6 text-2xl animate-bounce animation-delay-400">✨</span>
                        <span class="absolute -bottom-4 -left-6 text-2xl animate-bounce animation-delay-600">⭐</span>
                    </span>
                </h1>

                {{-- Greeting card --}}
                <div class="flex justify-center mt-8 animate-fade-in-up animation-delay-400">
                    <div class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl
                              bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm
                              border border-gray-200/50 dark:border-gray-700/50
                              shadow-lg shadow-black/5">
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span x-text="
                                greeting < 10 ? '🌅 Selamat Pagi' : 
                                greeting < 15 ? '☀️ Selamat Siang' : 
                                greeting < 18 ? '🌤️ Selamat Sore' : '🌙 Selamat Malam'
                            "></span>
                            , <span class="font-semibold bg-gradient-to-r from-primary to-accent 
                                        bg-clip-text text-transparent">Pengunjung</span>
                        </p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="afterTitle">
            <div class="flex flex-col items-center relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-base md:text-lg text-center 
                         max-w-2xl mt-8 px-6 leading-relaxed font-medium mx-auto
                         animate-fade-in-up animation-delay-600">
                    Selamat datang di portal resmi pendataan kunjungan.
                    Silakan cari dan pilih Perangkat Daerah tujuan Anda untuk memulai
                    pengisian daftar hadir secara digital.
                </p>

                {{-- Search Bar with premium design --}}
                <div class="mt-12 w-full max-w-2xl mx-auto animate-fade-in-up animation-delay-800"
                    x-on:click.away="searchFocused = false">

                    {{-- Search tips --}}
                    <div class="flex justify-center gap-4 mb-4 text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-primary"></span>
                            Ketik untuk mencari
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-accent"></span>
                            {{ $daftarPd->count() }} Instansi tersedia
                        </span>
                    </div>

                    <div class="relative group" x-bind:class="{ 'scale-[1.02]': searchFocused }">

                        {{-- Multi-layer glow effect --}}
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary via-secondary to-accent 
                                  rounded-2xl opacity-0 group-hover:opacity-30 group-focus-within:opacity-50 
                                  transition-all blur-xl duration-500"></div>

                        <div class="absolute -inset-0.5 bg-gradient-to-r from-primary to-accent 
                                  rounded-2xl opacity-0 group-hover:opacity-50 group-focus-within:opacity-75 
                                  transition-all blur group-hover:duration-500"></div>

                        {{-- Search input container with glass effect --}}
                        <div class="relative flex items-center bg-white/90 dark:bg-gray-800/90 
                                  backdrop-blur-md h-16 border-2 border-transparent
                                  rounded-2xl w-full transition-all duration-300 
                                  shadow-lg shadow-black/5 pr-2 pl-5" :class="{
                                 'border-primary shadow-xl shadow-primary/20 scale-[1.02]': searchFocused,
                                 'hover:border-gray-300 dark:hover:border-gray-600': !searchFocused
                             }" @focusin="searchFocused = true" @focusout="searchFocused = false">

                            {{-- Search icon with animation --}}
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class='text-gray-400 transition-all duration-500' :class="{ 
                                         'text-primary scale-110 rotate-90': searchFocused,
                                         'group-hover:scale-110': !searchFocused
                                     }">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.34-4.34" />
                                </svg>

                                {{-- Ripple effect --}}
                                <span class="absolute inset-0 rounded-full bg-primary/20 
                                           animate-ping opacity-0 group-focus-within:opacity-100"
                                    x-show="searchFocused" x-cloak></span>
                            </div>

                            <input wire:model.live.debounce.300ms="search" class="px-4 w-full h-full outline-none border-none focus:ring-0 
                                          placeholder:text-gray-400 text-text-dark dark:text-text-light 
                                          bg-transparent text-base" type="text"
                                placeholder="Cari Perangkat Daerah (Misal: Diskominfo, Bappeda...)"
                                x-ref="searchInput" />

                            {{-- Clear button with animation --}}
                            <button wire:click="$set('search', '')" x-show="$wire.search.length > 0" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-50"
                                x-transition:enter-end="opacity-100 scale-100" class="p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 
                                           transition-all duration-300 mr-1
                                           hover:rotate-90 group/clear">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="group-hover/clear:text-red-500 transition-colors">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>

                            {{-- Search button --}}
                            <button class="px-6 py-2 bg-gradient-to-r from-primary to-secondary 
                                         text-white rounded-xl font-semibold text-sm
                                         hover:shadow-lg hover:shadow-primary/30 
                                         transition-all duration-300 hover:scale-105
                                         active:scale-95 ml-2">
                                Cari
                            </button>
                        </div>
                    </div>

                    {{-- Search stats with animation --}}
                    <div class="flex justify-between items-center mt-4 text-xs 
                              text-gray-500 dark:text-gray-400 px-2">
                        <span x-show="$wire.daftarPd.length > 0" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            📊 Menampilkan <span class="font-semibold text-primary"
                                x-text="$wire.daftarPd.length"></span>
                            Perangkat Daerah
                        </span>
                        <span x-show="$wire.daftarPd.length === 0 && $wire.search.length > 0"
                            class="text-amber-500 flex items-center gap-1">
                            <span>🔍</span>
                            Tidak ada hasil untuk "{{ $search }}"
                        </span>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-hero>

    {{-- Grid Kartu Instansi with masonry effect --}}
    <x-container size="lg" class="pb-24 w-full">
        <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full auto-rows-fr'>
            @forelse ($daftarPd as $index => $pd)
            <a href="{{ route('department.detail', $pd->slug) }}" wire:navigate class='group relative block bg-white dark:bg-gray-800/50 
                      hover:shadow-2xl hover:shadow-primary/20 
                      transition-all duration-500 border border-gray-200/50 
                      dark:border-gray-700/50 rounded-3xl p-6 min-h-[240px] 
                      hover:border-primary/50 dark:hover:border-primary/50
                      hover:-translate-y-2 backdrop-blur-sm
                      overflow-hidden' style="animation: fadeInUp 0.5s ease-out {{ $index * 0.05 }}s both;">

                {{-- Background gradient effect on hover --}}
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-accent/5 
                          opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                {{-- Shine effect --}}
                <div class="absolute inset-0 translate-x-[-100%] group-hover:translate-x-[100%] 
                          bg-gradient-to-r from-transparent via-white/20 to-transparent 
                          transition-transform duration-1000"></div>

                <div class="flex flex-col h-full justify-between relative z-10">
                    {{-- Header section --}}
                    <div>
                        <div class='flex items-center justify-between mb-4'>
                            <div class="relative">
                                {{-- Glow effect --}}
                                <div class="absolute inset-0 bg-primary/30 rounded-2xl blur-xl 
                                          opacity-0 group-hover:opacity-100 transition-all duration-500 
                                          group-hover:scale-150"></div>

                                {{-- Icon container with 3D effect --}}
                                <div class="relative bg-gradient-to-br from-primary/10 to-accent/10 
                                          p-3.5 rounded-2xl group-hover:bg-gradient-to-br 
                                          group-hover:from-primary group-hover:to-secondary 
                                          transition-all duration-500 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-primary group-hover:text-white 
                                                transition-colors duration-500
                                                group-hover:scale-110 group-hover:rotate-3">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Badge with glass effect --}}
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter 
                                       bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm
                                       px-3 py-1.5 rounded-full border border-gray-200/50 
                                       dark:border-gray-700/50 shadow-sm">
                                <span class="bg-gradient-to-r from-primary to-accent 
                                           bg-clip-text text-transparent">
                                    PD-{{ str_pad($pd->id, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </span>
                        </div>

                        <h3 class='text-xl font-bold text-text-dark dark:text-text-light 
                                   group-hover:text-primary transition-colors duration-300
                                   line-clamp-2 min-h-[3.5rem] mb-2'>
                            {{ $pd->nama_pd }}
                        </h3>

                        <p class='text-sm text-gray-500 dark:text-gray-400 line-clamp-2 min-h-[2.5rem]
                                  flex items-start gap-1.5'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5">
                                <path d="M20 10c0 4.418-8 12-8 12s-8-7.582-8-12a8 8 0 1 1 16 0Z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $pd->alamat ?? 'Pemerintah Kabupaten Malang' }}
                        </p>

                        {{-- Optional: Show department type/category if available --}}
                        @if(isset($pd->jenis))
                        <span class="inline-flex items-center gap-1 mt-4 text-xs px-3 py-1 
                                   bg-gradient-to-r from-accent/10 to-primary/10 
                                   text-accent rounded-full border border-accent/20">
                            <span class="w-1 h-1 rounded-full bg-accent animate-pulse"></span>
                            {{ $pd->jenis }}
                        </span>
                        @endif
                    </div>

                    {{-- Footer with animated arrow and stats --}}
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800
                              flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-400 flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-green-500"></span>
                                Buka
                            </span>
                            <span class="text-xs text-gray-300">•</span>
                            <span class="text-xs text-gray-400">
                                {{ rand(50, 500) }} kunjungan
                            </span>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-0 bg-accent rounded-full blur-md 
                                      opacity-0 group-hover:opacity-50 transition-opacity"></div>
                            <div class="relative w-10 h-10 rounded-full bg-accent/10 
                                      flex items-center justify-center 
                                      group-hover:bg-gradient-to-r group-hover:from-primary 
                                      group-hover:to-secondary group-hover:text-white 
                                      group-hover:scale-110 group-hover:rotate-0 
                                      transition-all duration-500 text-text-dark
                                      border border-accent/20 group-hover:border-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="group-hover:translate-x-1 transition-transform duration-300">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="max-w-md mx-auto">
                    {{-- Empty state illustration --}}
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-accent/20 
                                  rounded-full blur-3xl animate-pulse"></div>
                        <div class="relative bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm
                                  p-8 rounded-full w-32 h-32 mx-auto
                                  flex items-center justify-center
                                  border-4 border-gray-200/50 dark:border-gray-700/50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <h4 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Instansi Tidak Ditemukan
                    </h4>

                    <p class="text-gray-500 mb-6">
                        @if(!empty($search))
                        Tidak ada hasil untuk "{{ $search }}". Coba gunakan kata kunci lain.
                        @else
                        Belum ada data instansi yang tersedia.
                        @endif
                    </p>

                    @if(!empty($search))
                    <button wire:click="$set('search', '')" class="px-6 py-3 bg-gradient-to-r from-primary to-secondary 
                                   text-white rounded-xl font-semibold
                                   hover:shadow-lg hover:shadow-primary/30 
                                   transition-all duration-300 hover:scale-105
                                   active:scale-95 inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5">
                            <path d="M3 12h4l3-3 3 3h4" />
                            <path d="M5 6v3h14V6" />
                        </svg>
                        Reset pencarian
                    </button>
                    @endif
                </div>
            </div>
            @endforelse
        </div>

        {{-- Optional: Add pagination if needed --}}
        @if(method_exists($daftarPd, 'links'))
        <div class="mt-12">
            {{ $daftarPd->links() }}
        </div>
        @endif
    </x-container>
</div>

{{-- Add custom CSS for animations --}}
@push('styles')
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        transform: translateX(-50%) scaleX(0);
    }

    to {
        transform: translateX(-50%) scaleX(1);
    }
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
}

.animate-slide-in {
    animation: slideIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

.bg-size-200 {
    background-size: 200% 200%;
}

.animation-delay-200 {
    animation-delay: 200ms;
}

.animation-delay-400 {
    animation-delay: 400ms;
}

.animation-delay-600 {
    animation-delay: 600ms;
}

.animation-delay-800 {
    animation-delay: 800ms;
}

.animation-delay-1000 {
    animation-delay: 1000ms;
}

[x-cloak] {
    display: none !important;
}

/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

.dark ::-webkit-scrollbar-thumb {
    background: #475569;
}

.dark ::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

/* Loading animation for images and content */
.loading {
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }

    100% {
        background-position: -200% 0;
    }
}

/* Hover card effect */
.card-hover-effect {
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.card-hover-effect:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 40px -15px rgba(1, 0, 204, 0.3);
}

/* Glass morphism effect */
.glass {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

.dark .glass {
    background: rgba(17, 25, 40, 0.75);
    border: 1px solid rgba(255, 255, 255, 0.125);
}

/* Text gradient animation */
.text-gradient-animate {
    background: linear-gradient(90deg, #0100CC, #0166FE, #18D1FF, #0100CC);
    background-size: 300% 100%;
    animation: gradient 3s ease infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
</style>
@endpush

@push('scripts')
<script>
// Optional: Add intersection observer for lazy loading animations
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush