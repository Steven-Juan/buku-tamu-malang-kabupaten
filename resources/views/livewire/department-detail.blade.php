<section
    class="flex flex-col items-center bg-light dark:bg-dark text-text-dark dark:text-text-light px-4 py-10 min-h-screen transition-colors duration-300">

    <div class="w-full max-w-5xl mb-6">
        <a href="{{ route('home') }}" wire:navigate
            class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-8">

        <div
            class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-accent dark:border-gray-700 flex flex-col items-center text-center">
            <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full mb-4">PORTAL LAYANAN
                TAMU</span>
            <h1 class="text-3xl font-bold mb-2 text-text-dark dark:text-text-light">
                {{ $instansiTujuan->nama_pd }}
            </h1>
            <p class="text-gray-500 mb-8 text-sm">Pemerintah Kabupaten Malang</p>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 inline-block mb-6">
                <div class="w-[200px] h-[200px]">
                    {!! $qrCode !!}
                </div>
            </div>

            <p class="text-sm text-gray-500 mb-6 max-w-xs">
                Scan QR Code di atas menggunakan kamera HP Anda untuk mengisi buku tamu secara langsung, atau klik
                tombol di bawah ini.
            </p>

            <a href="{{ route('guest.form', $instansiTujuan->slug) }}" wire:navigate
                class="w-full py-4 bg-primary hover:bg-secondary text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/30">
                Isi Buku Tamu Sekarang
            </a>
        </div>

        <div class="flex flex-col gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-accent dark:border-gray-700">
                <h3 class="text-lg font-bold mb-1 text-text-dark dark:text-text-light">Statistik Kunjungan</h3>
                <p class="text-xs text-gray-500 mb-4">Total tamu yang telah berkunjung dan terdata dalam sistem.</p>
                <div class="flex items-end gap-2">
                    <span class="text-5xl font-black text-primary">{{ $totalKunjungan }}</span>
                    <span class="text-gray-500 font-medium mb-1">Orang</span>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-accent dark:border-gray-700 flex-1">
                <h3 class="text-lg font-bold mb-6 text-text-dark dark:text-text-light">Riwayat Kunjungan Terbaru</h3>

                <div class="space-y-4">
                    @forelse($riwayatTerbaru as $tamu)
                    <div
                        class="flex items-start gap-4 pb-4 border-b border-gray-100 dark:border-gray-700 last:border-0 last:pb-0">
                        <div class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center shrink-0">
                            <span class="text-primary font-bold text-sm">{{ substr($tamu->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-text-dark dark:text-text-light">{{ $tamu->nama }}</p>
                            <p class="text-xs text-gray-500 line-clamp-1">{{ $tamu->asal_instansi }}</p>
                            <p class="text-[10px] text-gray-400 mt-1">{{ $tamu->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada data kunjungan.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</section>