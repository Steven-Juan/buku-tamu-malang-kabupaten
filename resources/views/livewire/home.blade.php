<div x-data="{ 
        searchFocused: false,
        greeting: new Date().getHours()
    }"
    class='bg-light dark:bg-dark text-text-dark dark:text-text-light min-h-screen transition-colors duration-300 flex flex-col items-center'>

    {{-- Hero Section with animated gradient --}}
    <x-hero class="bg-transparent !mb-0 !py-16 md:!py-24 w-full relative overflow-hidden">
        {{-- Animated background elements --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent/5 rounded-full blur-3xl animate-pulse animation-delay-1000">
            </div>
        </div>

        <x-slot name="title">
            <div class="relative">
                <h1
                    class="text-center text-text-dark dark:text-text-light text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight mx-auto px-4 animate-fade-in-up">
                    Layanan
                    <span class='relative inline-block'>
                        <span
                            class='bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] bg-clip-text text-transparent italic'>
                            Buku Tamu Digital
                        </span>
                        {{-- Animated underline --}}
                        <span
                            class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] rounded-full scale-x-0 animate-slide-in"></span>
                    </span>
                </h1>

                {{-- Greeting message --}}
                <p
                    class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4 animate-fade-in-up animation-delay-200">
                    <span x-text="
                        greeting < 10 ? 'Selamat Pagi' : 
                        greeting < 15 ? 'Selamat Siang' : 
                        greeting < 18 ? 'Selamat Sore' : 'Selamat Malam'
                    "></span>,
                    <span class="font-semibold text-primary">Pengunjung</span> 👋
                </p>
            </div>
        </x-slot>

        <x-slot name="afterTitle">
            <div class="flex flex-col items-center relative z-10">
                <p
                    class="text-gray-500 dark:text-gray-400 text-base md:text-lg text-center max-w-2xl mt-6 px-6 leading-relaxed font-medium mx-auto animate-fade-in-up animation-delay-400">
                    Selamat datang di portal resmi pendataan kunjungan.
                    Silakan cari dan pilih Perangkat Daerah tujuan Anda untuk memulai
                    pengisian daftar hadir secara digital.
                </p>

                {{-- Search Bar with enhanced interactions --}}
                <div class="mt-12 w-full max-w-lg mx-auto animate-fade-in-up animation-delay-600"
                    x-on:click.away="searchFocused = false">
                    <div class="relative group" x-bind:class="{ 'scale-105': searchFocused }">

                        {{-- Glow effect --}}
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-primary to-accent rounded-2xl opacity-0 
                                  group-hover:opacity-30 group-focus-within:opacity-50 transition-all blur"></div>

                        {{-- Search input container --}}
                        <div class="relative flex items-center bg-white dark:bg-gray-800 h-14 border-2 
                                  border-gray-200 dark:border-gray-700 rounded-2xl w-full 
                                  focus-within:border-primary dark:focus-within:border-primary 
                                  transition-all shadow-sm pr-1 pl-4"
                            x-bind:class="{ 'border-primary shadow-lg shadow-primary/20': searchFocused }"
                            @focusin="searchFocused = true" @focusout="searchFocused = false">

                            {{-- Search icon with animation --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class='text-gray-400 shrink-0 transition-all duration-300'
                                x-bind:class="{ 'text-primary scale-110': searchFocused, 'rotate-90': searchFocused }">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.34-4.34" />
                            </svg>

                            <input wire:model.live.debounce.300ms="search" class="px-3 w-full h-full outline-none border-none focus:ring-0 
                                       placeholder:text-gray-400 text-text-dark dark:text-text-light 
                                       bg-transparent text-sm md:text-base" type="text"
                                placeholder="Cari Perangkat Daerah (Misal: Diskominfo)..." x-ref="searchInput" />

                            {{-- Clear button --}}
                            <button wire:click="$set('search', '')" x-show="$wire.search.length > 0" x-cloak
                                class="p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Search stats --}}
                    <div class="flex justify-between items-center mt-3 text-xs text-gray-500 dark:text-gray-400">
                        <span x-show="$wire.daftarPd.length > 0">
                            Menampilkan <span class="font-semibold text-primary" x-text="$wire.daftarPd.length"></span>
                            Perangkat Daerah
                        </span>
                        <span x-show="$wire.daftarPd.length === 0 && $wire.search.length > 0" class="text-amber-500">
                            Tidak ada hasil untuk "{{ $search }}"
                        </span>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-hero>

    {{-- Grid Kartu Instansi with animation --}}
    <x-container size="lg" class="pb-24 w-full">
        <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full'>
            @forelse ($daftarPd as $index => $pd)
            <a href="{{ route('department.detail', $pd->slug) }}" wire:navigate class='group block bg-white dark:bg-gray-800/50 hover:shadow-xl hover:shadow-primary/10 
                      transition-all duration-500 border border-gray-200 dark:border-gray-700 
                      rounded-3xl p-6 min-h-[220px] hover:border-primary/50 dark:hover:border-primary/50
                      hover:-translate-y-1' style="animation: fadeInUp 0.5s ease-out {{ $index * 0.05 }}s both;">

                <div class="flex flex-col h-full justify-between">
                    {{-- Header section --}}
                    <div>
                        <div class='flex items-center justify-between mb-4'>
                            <div class="relative">
                                <div
                                    class="absolute inset-0 bg-primary/20 rounded-2xl blur-md group-hover:blur-xl transition-all opacity-0 group-hover:opacity-100">
                                </div>
                                <div
                                    class="relative bg-primary/10 p-3 rounded-2xl group-hover:bg-primary transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="text-primary group-hover:text-white transition-colors duration-300">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </div>
                            </div>

                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter 
                                       bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                                PD-{{ str_pad($pd->id, 3, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        <h3 class='text-xl font-bold text-text-dark dark:text-text-light 
                                   group-hover:text-primary transition-colors duration-300
                                   line-clamp-2 min-h-[3.5rem]'>
                            {{ $pd->nama_pd }}
                        </h3>

                        <p class='text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2 min-h-[2.5rem]'>
                            {{ $pd->alamat ?? 'Pemerintah Kabupaten Malang' }}
                        </p>

                        {{-- Optional: Show department type/category if available --}}
                        @if(isset($pd->jenis))
                        <span class="inline-block mt-3 text-xs px-2 py-1 bg-accent/10 text-accent rounded-full">
                            {{ $pd->jenis }}
                        </span>
                        @endif
                    </div>

                    {{-- Footer with animated arrow --}}
                    <div class="mt-6 flex items-center justify-between">
                        <span class="text-xs text-gray-400">
                            Klik untuk detail
                        </span>

                        <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center 
                                  group-hover:bg-primary group-hover:text-white group-hover:scale-110 
                                  transition-all duration-300 text-text-dark
                                  group-hover:rotate-0 rotate-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Hover gradient overlay --}}
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-primary/0 via-primary/0 to-primary/5 
                          opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center flex flex-col items-center justify-center space-y-4">
                <div class="bg-gray-100 dark:bg-gray-800 p-8 rounded-full animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-gray-700 dark:text-gray-300">Instansi Tidak Ditemukan</h4>
                    <p class="text-gray-500 max-w-md mx-auto">
                        @if(!empty($search))
                        Tidak ada hasil untuk "{{ $search }}". Coba gunakan kata kunci lain.
                        @else
                        Belum ada data instansi yang tersedia.
                        @endif
                    </p>
                    @if(!empty($search))
                    <button wire:click="$set('search', '')" class="mt-4 text-primary hover:text-primary/80 underline underline-offset-4 
                                   transition-colors">
                        Reset pencarian
                    </button>
                    @endif
                </div>
            </div>
            @endforelse
        </div>

        {{-- Optional: Add pagination if needed --}}
        @if(method_exists($daftarPd, 'links'))
        <div class="mt-8">
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
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        transform: scaleX(0);
    }

    to {
        transform: scaleX(1);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

.animate-slide-in {
    animation: slideIn 0.8s ease-out forwards;
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

.animation-delay-1000 {
    animation-delay: 1000ms;
}

[x-cloak] {
    display: none !important;
}
</style>
@endpush