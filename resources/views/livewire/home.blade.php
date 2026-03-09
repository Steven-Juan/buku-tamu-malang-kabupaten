<section
    class='flex flex-col items-center bg-light dark:bg-dark text-text-dark dark:text-text-light px-4 pb-10 min-h-screen transition-colors duration-300'>
    {{-- ... (Bagian Navbar & Header Anda tetap sama) ... --}}

    <div
        class="mt-10 flex items-center bg-white dark:bg-gray-800 h-14 border border-accent rounded-2xl w-full max-w-lg focus-within:ring-2 focus-within:ring-primary/50 transition-all shadow-sm pr-1 pl-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class='text-accent shrink-0'>
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.34-4.34" />
        </svg>
        <input wire:model.live.debounce.300ms="search"
            class="px-3 w-full h-full outline-none placeholder:text-gray-400 text-text-dark dark:text-text-light bg-transparent"
            type="text" placeholder="Cari Perangkat Daerah..." />
        {{-- Tombol Cari bisa dihilangkan fungsinya karena pencarian sudah otomatis saat mengetik --}}
    </div>

    <div class='max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 md:px-0 mt-16 w-full'>

        @forelse ($daftarPd as $pd)
        <div
            class='group bg-white dark:bg-gray-800/50 hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 border border-accent dark:border-gray-700 rounded-3xl p-6 flex flex-col justify-between min-h-[220px]'>
            <div>
                <div class='flex items-center justify-between mb-4'>
                    <div class="bg-primary/10 p-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="#0100CC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">ID:
                        {{ $pd->id }}</span>
                </div>

                <h3
                    class='text-xl font-bold text-text-dark dark:text-text-light group-hover:text-primary transition-colors'>
                    {{ $pd->nama_pd }}
                </h3>

                <p class='text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2'>
                    {{ $pd->alamat ?? 'Pemerintah Kabupaten Malang' }}
                </p>
            </div>

            <a href="{{ route('guest.form', $pd->slug) }}" wire:navigate
                class="mt-6 flex items-center justify-center gap-2 w-full py-3 bg-accent/30 dark:bg-gray-700 text-text-dark dark:text-text-light text-xs font-bold rounded-xl group-hover:bg-primary group-hover:text-white transition-all">
                Isi Buku Tamu
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>
        @empty
        <div class="col-span-full py-10 text-center text-gray-500">
            Perangkat Daerah tidak ditemukan.
        </div>
        @endforelse

    </div>

    {{-- ... (Footer Anda) ... --}}
</section>