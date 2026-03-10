<div x-data="{ 
        activeTab: 'qr',
        showCopyNotification: false,
        stats: {
            visitors: {{ $totalKunjungan }},
            today: {{ $kunjunganHariIni ?? 0 }},
            week: {{ $kunjunganMingguIni ?? 0 }}
        }
    }"
    class="bg-light dark:bg-dark text-text-dark dark:text-text-light min-h-screen transition-colors duration-300 flex flex-col items-center">

    {{-- HERO SECTION with animated background --}}
    <x-hero class="bg-transparent !mb-0 !py-16 md:!py-24 w-full relative overflow-hidden">

        {{-- Animated background elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent/5 rounded-full blur-3xl animate-pulse animation-delay-1000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-primary/0 via-primary/5 to-accent/0 rounded-full blur-3xl animate-slow-spin">
            </div>
        </div>

        <x-slot name="title">
            <div class="relative animate-fade-in-up">
                {{-- Badge instansi --}}
                <div class="flex justify-center mb-4">
                    <span
                        class="inline-flex items-center gap-2 bg-primary/10 text-primary text-xs font-bold px-4 py-2 rounded-full border border-primary/20">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        PERANGKAT DAERAH
                    </span>
                </div>

                <h1
                    class="text-center text-text-dark dark:text-text-light text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight mx-auto px-4">
                    Portal
                    <span class="relative inline-block">
                        <span
                            class="bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] bg-clip-text text-transparent italic">
                            {{ $instansiTujuan->nama_pd }}
                        </span>
                        {{-- Animated underline --}}
                        <span
                            class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] rounded-full scale-x-0 animate-slide-in"></span>
                    </span>
                </h1>

                {{-- Info tambahan instansi --}}
                @if($instansiTujuan->alamat || $instansiTujuan->kontak)
                <div class="flex flex-wrap justify-center gap-4 mt-6 text-sm text-gray-500 dark:text-gray-400">
                    @if($instansiTujuan->alamat)
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $instansiTujuan->alamat }}</span>
                    </div>
                    @endif

                    @if($instansiTujuan->kontak)
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $instansiTujuan->kontak }}</span>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="afterTitle">
            <div class="flex flex-col items-center relative z-10 animate-fade-in-up animation-delay-400">
                <p
                    class="text-gray-500 dark:text-gray-400 text-base md:text-lg text-center max-w-2xl mt-6 px-6 leading-relaxed font-medium mx-auto">
                    Silakan scan QR Code atau klik tombol di bawah untuk mengisi buku tamu digital
                    pada instansi ini.
                </p>

                {{-- Back button with improved design --}}
                <div class="mt-8 group">
                    <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-primary 
                               transition-all duration-300 hover:gap-3 gap-2 bg-gray-100 dark:bg-gray-800 
                               px-4 py-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </x-slot>
    </x-hero>

    {{-- CONTENT SECTION --}}
    <x-container size="lg" class="pb-24 w-full">

        {{-- Tab Navigation for Mobile (optional) --}}
        <div class="flex md:hidden justify-center mb-6 gap-2">
            <button @click="activeTab = 'qr'" class="px-4 py-2 rounded-full text-sm font-bold transition-all"
                :class="activeTab === 'qr' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400'">
                QR Code
            </button>
            <button @click="activeTab = 'stats'" class="px-4 py-2 rounded-full text-sm font-bold transition-all"
                :class="activeTab === 'stats' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400'">
                Statistik
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- LEFT COLUMN: QR CODE CARD --}}
            <div x-show="activeTab === 'qr' || window.innerWidth >= 768"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" class="md:block">

                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 
                          hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 group/qr
                          relative overflow-hidden">

                    {{-- Decorative elements --}}
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/5 to-accent/5 rounded-bl-full">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-primary/5 to-accent/5 rounded-tr-full">
                    </div>

                    {{-- Header --}}
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            <span class="bg-gradient-to-r from-primary to-accent text-white text-xs font-bold px-4 py-2 rounded-full 
                                       shadow-lg shadow-primary/30">
                                PORTAL LAYANAN TAMU
                            </span>

                            {{-- Copy link button --}}
                            <button @click="
                                    navigator.clipboard.writeText(window.location.href);
                                    showCopyNotification = true;
                                    setTimeout(() => showCopyNotification = false, 2000);
                                " class="text-gray-400 hover:text-primary transition-colors relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>

                                {{-- Notification toast --}}
                                <div x-show="showCopyNotification" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1"
                                    class="absolute top-full right-0 mt-2 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg whitespace-nowrap">
                                    Link disalin!
                                </div>
                            </button>
                        </div>

                        <h2
                            class="text-2xl font-bold text-text-dark dark:text-text-light mb-2 group-hover/qr:text-primary transition-colors">
                            {{ $instansiTujuan->nama_pd }}
                        </h2>

                        <p class="text-gray-500 text-sm mb-8 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            Pemerintah Kabupaten Malang
                        </p>
                    </div>

                    {{-- QR Code with animation --}}
                    <div class="relative flex justify-center mb-8">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-accent/20 rounded-3xl blur-2xl 
                                  group-hover/qr:blur-3xl transition-all opacity-50 group-hover/qr:opacity-70"></div>

                        <div class="relative bg-white p-6 rounded-2xl shadow-xl border-2 border-gray-100 
                                  group-hover/qr:scale-105 group-hover/qr:rotate-1 transition-all duration-500">
                            <div class="w-[220px] h-[220px] md:w-[250px] md:h-[250px]">
                                {!! $qrCode !!}
                            </div>

                            {{-- Scan guide overlay --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/qr:opacity-100 
                                      transition-opacity duration-300 pointer-events-none">
                                <div class="bg-primary/90 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg 
                                          transform -rotate-12">
                                    SCAN ME
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Instruction and CTA --}}
                    <div class="relative z-10 text-center">
                        <p class="text-sm text-gray-500 mb-6 max-w-xs mx-auto flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-primary animate-pulse" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Scan QR Code di atas menggunakan kamera HP Anda
                        </p>

                        <a href="{{ route('guest.form', $instansiTujuan->slug) }}" wire:navigate class="group/btn w-full py-4 bg-gradient-to-r from-primary to-accent hover:from-accent hover:to-primary 
                                   text-white font-bold rounded-xl transition-all duration-300 
                                   shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40
                                   inline-flex items-center justify-center gap-2">
                            <span>Isi Buku Tamu Sekarang</span>
                            <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: STATISTICS + HISTORY --}}
            <div x-show="activeTab === 'stats' || window.innerWidth >= 768"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" class="flex flex-col gap-6">

                {{-- STATISTICS CARD with counter animation --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 
                          hover:shadow-2xl transition-all duration-500 group/stats">

                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-text-dark dark:text-text-light flex items-center gap-2">
                                <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </span>
                                Statistik Kunjungan
                            </h3>
                            <p class="text-xs text-gray-500 ml-10">
                                Data kunjungan terupdate
                            </p>
                        </div>

                        {{-- Live indicator --}}
                        <span
                            class="flex items-center gap-1.5 text-xs text-green-500 bg-green-50 dark:bg-green-500/10 px-2 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    {{-- Main stat --}}
                    <div class="mb-6 p-4 bg-gradient-to-br from-primary/5 to-accent/5 rounded-2xl">
                        <div class="flex items-end gap-3">
                            <span
                                class="text-5xl md:text-6xl font-black bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent"
                                x-text="stats.visitors" x-init="
                                    let start = 0;
                                    let end = {{ $totalKunjungan }};
                                    let duration = 1500;
                                    let increment = end / (duration / 16);
                                    
                                    function animate() {
                                        start += increment;
                                        if (start < end) {
                                            stats.visitors = Math.floor(start);
                                            requestAnimationFrame(animate);
                                        } else {
                                            stats.visitors = end;
                                        }
                                    }
                                    animate();
                                  ">
                                {{ $totalKunjungan }}
                            </span>
                            <span class="text-gray-500 font-medium mb-2">
                                Total Kunjungan
                            </span>
                        </div>
                    </div>

                    {{-- Additional stats --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <span class="text-2xl font-bold text-primary" x-text="stats.today">0</span>
                            <p class="text-xs text-gray-500">Hari Ini</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <span class="text-2xl font-bold text-accent" x-text="stats.week">0</span>
                            <p class="text-xs text-gray-500">Minggu Ini</p>
                        </div>
                    </div>
                </div>

                {{-- VISITOR HISTORY CARD --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 
                          hover:shadow-2xl transition-all duration-500 flex-1">

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-text-dark dark:text-text-light flex items-center gap-2">
                            <span class="w-8 h-8 bg-accent/10 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            Riwayat Kunjungan Terbaru
                        </h3>

                        @if($riwayatTerbaru->count() > 0)
                        <span class="text-xs text-gray-500">
                            {{ $riwayatTerbaru->count() }} kunjungan
                        </span>
                        @endif
                    </div>

                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($riwayatTerbaru as $index => $tamu)
                        <div x-show="true" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0" x-transition:delay="{{ $index * 50 }}ms"
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 
                                    transition-all group/item">

                            {{-- Avatar with gradient --}}
                            <div class="relative">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-primary/20 to-accent/20 
                                          flex items-center justify-center shrink-0 group-hover/item:scale-110 transition-transform">
                                    <span class="text-primary font-bold text-lg">
                                        {{ substr($tamu->nama, 0, 1) }}
                                    </span>
                                </div>
                                {{-- Online indicator --}}
                                <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white 
                                           dark:border-gray-800 rounded-full"></span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="font-bold text-sm text-text-dark dark:text-text-light truncate">
                                        {{ $tamu->nama }}
                                    </p>
                                    <span
                                        class="text-[10px] font-medium text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full">
                                        #{{ str_pad($tamu->id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <p class="text-xs text-gray-500 truncate flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $tamu->asal_instansi }}
                                </p>

                                <div class="flex items-center gap-2 mt-1.5">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-[10px] text-gray-400">
                                        {{ $tamu->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            {{-- View details icon on hover --}}
                            <button class="opacity-0 group-hover/item:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-gray-400 hover:text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <div
                                class="w-20 h-20 mx-auto bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Belum ada data kunjungan</p>
                            <p class="text-xs text-gray-400 mt-1">Jadilah yang pertama mengisi buku tamu</p>
                        </div>
                        @endforelse
                    </div>

                    @if($riwayatTerbaru->count() > 0)
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="#"
                            class="text-xs text-primary hover:text-accent transition-colors flex items-center justify-center gap-1">
                            Lihat Semua Riwayat
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </x-container>
</div>

{{-- Add custom styles --}}
@push('styles')
<style>
@keyframes slow-spin {
    from {
        transform: translate(-50%, -50%) rotate(0deg);
    }

    to {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

.animate-slow-spin {
    animation: slow-spin 20s linear infinite;
}

.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 20px;
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #4a5568;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #718096;
}
</style>
@endpush

@push('scripts')
<script>
// Optional: Add smooth counter animation when stats change
document.addEventListener('livewire:load', function() {
    // Any additional JavaScript can go here
});
</script>
@endpush