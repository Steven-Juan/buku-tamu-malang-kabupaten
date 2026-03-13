<div class="relative flex items-center gap-3">

    {{-- Logo (Clean - No Hover Effect) --}}
    <div class="relative flex-shrink-0">
        <img src="{{ asset('logos/logo_kabmalang.svg') }}" alt="Logo Kabupaten Malang"
            class="w-10 h-10 object-contain filter drop-shadow-sm">
    </div>

    {{-- Text Section --}}
    <div class="flex flex-col leading-none">
        {{-- Main Text --}}
        <span class="font-extrabold text-xl tracking-tighter">
            <span
                class="bg-gradient-to-r from-[#0100CC] to-[#0166FE] dark:from-[#3b82f6] dark:to-[#60a5fa] bg-clip-text text-transparent">
                Malang<span class="text-[#0100CC] dark:text-[#3b82f6] italic">Kab</span>
            </span>
        </span>

        {{-- Sub-text --}}
        <span
            class="text-[9px] font-bold text-gray-400 uppercase tracking-widest
                         group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors duration-300">
            Buku Tamu Digital
        </span>
    </div>

</div>
