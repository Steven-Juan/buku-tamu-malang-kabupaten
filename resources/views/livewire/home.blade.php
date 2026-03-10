<div
    class='bg-light dark:bg-dark text-text-dark dark:text-text-light min-h-screen transition-colors duration-300 flex flex-col items-center'>
    <x-hero class="bg-transparent !mb-0 !py-12 md:!py-20 w-full">
        <x-slot name="title">
            <h1
                class="text-center text-text-dark dark:text-text-light text-4xl md:text-5xl font-extrabold leading-[1.1] tracking-tight mx-auto px-4">
                Layanan <span
                    class='bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] bg-clip-text text-transparent italic'>Buku
                    Tamu Digital</span>
            </h1>
        </x-slot>

        <x-slot name="afterTitle">
            <div class="flex flex-col items-center">
                <p
                    class="text-gray-500 dark:text-gray-400 text-base md:text-lg text-center max-w-2xl mt-6 px-6 leading-relaxed font-medium mx-auto">
                    Selamat datang di portal resmi pendataan kunjungan. Silakan cari dan pilih Perangkat Daerah tujuan
                    Anda untuk memulai pengisian daftar hadir secara digital.
                </p>

                {{-- Search Bar --}}
                <div
                    class="mt-12 flex items-center bg-white dark:bg-gray-800 h-14 border border-accent rounded-2xl w-full max-w-lg mx-auto focus-within:ring-2 focus-within:ring-primary/50 transition-all shadow-sm pr-1 pl-4 group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class='text-accent shrink-0 group-focus-within:text-primary transition-colors'>
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.34-4.34" />
                    </svg>
                    <input wire:model.live.debounce.300ms="search"
                        class="px-3 w-full h-full outline-none border-none focus:ring-0 placeholder:text-gray-400 text-text-dark dark:text-text-light bg-transparent text-sm md:text-base"
                        type="text" placeholder="Cari Perangkat Daerah (Misal: Diskominfo)..." />
                </div>
            </div>
        </x-slot>
    </x-hero>

    {{-- Grid Kartu Instansi --}}
    <x-container size="lg" class="pb-24 w-full">
        <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full'>

            @forelse ($daftarPd as $pd)
                <div
                    class='group bg-white dark:bg-gray-800/50 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 border border-accent/20 dark:border-gray-700 rounded-[2rem] p-7 flex flex-col justify-between min-h-[240px] relative overflow-hidden'>

                    <div
                        class="absolute -right-4 -top-4 w-20 h-20 bg-primary/5 rounded-full blur-2xl group-hover:bg-accent/20 transition-all">
                    </div>

                    <div>
                        <div class='flex items-center justify-between mb-5'>
                            <div
                                class="bg-primary/10 dark:bg-primary/20 p-3 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#0100CC" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest bg-gray-50 dark:bg-gray-900 px-2 py-1 rounded-lg">
                                ID: {{ str_pad($pd->id, 3, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        <h3
                            class='text-xl font-extrabold text-text-dark dark:text-text-light group-hover:text-primary transition-colors leading-tight mb-3'>
                            {{ $pd->nama_pd }}
                        </h3>

                        <p class='text-sm text-gray-500 dark:text-gray-400 line-clamp-2 italic'>
                            {{ $pd->alamat ?? 'Pemerintah Kabupaten Malang' }}
                        </p>
                    </div>

                    <a href="{{ route('guest.form', $pd->slug) }}" wire:navigate
                        class="mt-8 flex items-center justify-center gap-2 w-full py-3.5 bg-gray-50 dark:bg-gray-700/50 text-text-dark dark:text-text-light text-xs font-bold rounded-2xl group-hover:bg-gradient-to-r group-hover:from-primary group-hover:to-accent group-hover:text-white group-hover:shadow-lg group-hover:shadow-primary/25 transition-all duration-300">
                        Isi Buku Tamu
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @empty
                <div class="col-span-full py-20 text-center flex flex-col items-center justify-center space-y-4">
                    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-700 dark:text-gray-300">Instansi Tidak Ditemukan</h4>
                        <p class="text-gray-500">Coba gunakan kata kunci lain atau periksa kembali ejaan Anda.</p>
                    </div>
                </div>
            @endforelse

        </div>
    </x-container>

</div>
