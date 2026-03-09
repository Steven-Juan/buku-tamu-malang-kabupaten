<section
    class='flex flex-col items-center bg-light dark:bg-dark text-text-dark dark:text-text-light px-4 pb-10 min-h-screen transition-colors duration-300'>
    <nav class="flex items-center justify-between py-3 md:px-16 lg:px-24 xl:px-32 md:py-4 w-full">
        <a href="#" class="flex items-center gap-2">
            <div class="bg-white p-1 rounded-lg shadow-sm">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/Logo_Kabupaten_Malang_-_Jawa_Timur.png"
                    alt="Logo Kab Malang" class="h-10 w-auto">
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-lg tracking-tight text-primary leading-tight">Buku Tamu</span>
                <span class="text-secondary text-[10px] font-semibold uppercase tracking-wider">Kabupaten Malang</span>
            </div>
        </a>

        <div id="menu"
            class="max-md:w-0 max-md:absolute max-md:top-0 max-md:z-10 max-md:left-0 max-md:transition-all max-md:duration-300 max-md:overflow-hidden max-md:h-full max-md:bg-light/90 dark:max-md:bg-dark/90 max-md:backdrop-blur-xl max-md:flex-col max-md:justify-center flex items-center gap-8 text-sm font-medium">
            <a href="#"
                class="text-text-dark dark:text-text-light hover:text-primary transition menu-item">Beranda</a>
            <a href="#"
                class="text-text-dark dark:text-text-light hover:text-primary transition menu-item">Statistik</a>
            <a href="#"
                class="text-text-dark dark:text-text-light hover:text-primary transition menu-item">Panduan</a>

            <button class="md:hidden bg-primary text-white px-10 h-10 rounded-full text-sm transition active:scale-95">
                Login Admin
            </button>
            <button id="close-menu"
                class="md:hidden bg-accent/20 text-text-dark dark:text-text-light p-2 rounded-full mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>

        <button
            class="hidden md:block bg-primary hover:bg-secondary text-white px-8 h-10 rounded-full text-sm font-semibold transition-all shadow-lg shadow-primary/20 active:scale-95">
            Login Admin
        </button>

        <button id="open-menu" class="md:hidden p-2 text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="4" x2="20" y1="12" y2="12" />
                <line x1="4" x2="20" y1="18" y2="18" />
                <line x1="4" x2="20" y1="6" y2="6" />
            </svg>
        </button>
    </nav>

    <div class="mt-24 text-center px-4">
        <span
            class="inline-block bg-secondary/10 text-secondary text-[10px] font-bold px-4 py-1 rounded-full uppercase tracking-widest mb-4">Official
            Directory</span>
        <h1
            class="text-4xl md:text-6xl font-semibold text-text-dark dark:text-text-light max-w-[850px] leading-[1.1] tracking-tight">
            Selamat Datang di Portal <br> <span class="text-primary">Buku Tamu Digital</span>
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base max-w-xl mt-6 mx-auto leading-relaxed">
            Silakan pilih instansi tujuan Anda di bawah ini untuk melakukan pengisian daftar hadir secara mandiri dan
            aman.
        </p>
    </div>

    <div
        class="mt-10 flex items-center bg-white dark:bg-gray-800 h-14 border border-accent rounded-2xl w-full max-w-lg focus-within:ring-2 focus-within:ring-primary/50 transition-all shadow-sm pr-1 pl-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class='text-accent shrink-0'>
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.34-4.34" />
        </svg>
        <input
            class="px-3 w-full h-full outline-none placeholder:text-gray-400 text-text-dark dark:text-text-light bg-transparent"
            type="text" placeholder="Cari Perangkat Daerah..." />
        <button type="submit"
            class="bg-secondary hover:bg-primary text-white px-6 h-11 font-bold text-sm rounded-xl transition-all">Cari</button>
    </div>

    <div class='max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 md:px-0 mt-16 w-full'>

        <div
            class='group bg-white dark:bg-gray-800/50 hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 border border-accent dark:border-gray-700 rounded-3xl p-6 flex flex-col justify-between min-h-[220px]'>
            <div>
                <div class='flex items-center justify-between mb-4'>
                    <div class="bg-primary/10 p-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#0100CC" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">ID: PD-01</span>
                </div>
                <h3
                    class='text-xl font-bold text-text-dark dark:text-text-light group-hover:text-primary transition-colors'>
                    Diskominfo</h3>
                <p class='text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2'>Dinas Komunikasi dan Informatika
                    Kabupaten Malang.</p>
            </div>
            <a href="#"
                class="mt-6 flex items-center justify-center gap-2 w-full py-3 bg-accent/30 dark:bg-gray-700 text-text-dark dark:text-text-light text-xs font-bold rounded-xl group-hover:bg-primary group-hover:text-white transition-all">
                Isi Buku Tamu
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>

    </div>

    <footer class="mt-20 border-t border-accent w-full pt-8 text-center">
        <p class='text-gray-400 text-[10px] uppercase font-bold tracking-[0.2em]'>© 2026 Pemerintah Kabupaten Malang
        </p>
    </footer>
</section>
