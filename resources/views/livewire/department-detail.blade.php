<section
    class="bg-light dark:bg-dark text-text-dark dark:text-text-light min-h-screen transition-colors duration-300 flex flex-col items-center">

    {{-- HERO SECTION with animated background --}}
    <div class="w-full relative overflow-hidden bg-transparent py-16 md:py-24">

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

        {{-- Title Section --}}
        <div class="relative animate-fade-in-up px-4">
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
            <div class="flex flex-wrap justify-center gap-4 mt-6 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Pemerintah Kabupaten Malang</span>
                </div>
            </div>

            {{-- Back button with improved design --}}
            <div class="flex justify-center mt-8 group">
                <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-primary 
                           transition-all duration-300 hover:gap-3 gap-2 bg-gray-100 dark:bg-gray-800 
                           px-4 py-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>

    {{-- CONTENT SECTION --}}
    <div class="w-full max-w-6xl px-4 pb-24">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- QR CODE CARD --}}
            <div class="md:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 
                          hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 group/qr
                          relative overflow-hidden h-full flex flex-col">

                    {{-- Decorative elements --}}
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/5 to-accent/5 rounded-bl-full">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-primary/5 to-accent/5 rounded-tr-full">
                    </div>

                    {{-- Header --}}
                    <div class="relative z-10">
                        <span class="bg-gradient-to-r from-primary to-accent text-white text-xs font-bold px-4 py-2 rounded-full 
                                   shadow-lg shadow-primary/30 inline-block mb-6">
                            PORTAL LAYANAN TAMU
                        </span>

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
                    <div class="relative flex justify-center mb-8 flex-1">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-accent/20 rounded-3xl blur-2xl 
                                  group-hover/qr:blur-3xl transition-all opacity-50 group-hover/qr:opacity-70"></div>

                        <div class="relative bg-white p-6 rounded-2xl shadow-xl border-2 border-gray-100 
                                  group-hover/qr:scale-105 group-hover/qr:rotate-1 transition-all duration-500">
                            <div class="w-[200px] h-[200px]">
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

                    {{-- CTA Button --}}
                    <div class="relative z-10">
                        <p class="text-sm text-gray-500 mb-4 text-center flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-primary animate-pulse" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Scan QR Code di atas atau isi manual
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
            <div class="md:col-span-2 flex flex-col gap-6">
                {{-- STATISTICS CARD --}}
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

                    {{-- Stats grid --}}
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-4 bg-gradient-to-br from-primary/5 to-accent/5 rounded-2xl text-center">
                            <span
                                class="text-3xl md:text-4xl font-black bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                                {{ $totalKunjungan }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">Total Kunjungan</p>
                        </div>

                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <span class="text-2xl font-bold text-secondary">{{ $kunjunganHariIni }}</span>
                            <p class="text-xs text-gray-500">Hari Ini</p>
                        </div>

                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <span class="text-2xl font-bold text-blue-500">{{ $kunjunganMingguIni }}</span>
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
                        <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 
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

                            <div class="text-right">
                                <p class="text-[10px] font-bold text-primary uppercase">
                                    {{ $tamu->created_at->format('H:i') }}</p>
                            </div>
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
    </div>
</section>

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

.animation-delay-1000 {
    animation-delay: 1000ms;
}

@keyframes slide-in {
    0% {
        transform: scaleX(0);
    }

    100% {
        transform: scaleX(1);
    }
}

.animate-slide-in {
    animation: slide-in 0.8s ease-out forwards;
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
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