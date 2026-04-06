<section
    class="flex flex-col items-center bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-4 py-10 min-h-screen transition-colors duration-300">

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <div class="w-full max-w-4xl mb-6">
        <a href="{{ route('department.detail', $instansiTujuan->slug) }}" wire:navigate
            class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-blue-600 transition-colors group">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Departemen
        </a>
    </div>

    <div class="w-full max-w-4xl text-center mb-10">
        <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4">
            Buku Tamu <span
                class="bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] bg-clip-text text-transparent italic">{{ $instansiTujuan->nama_pd }}</span>
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base leading-relaxed max-w-2xl mx-auto">
            Terima kasih atas kunjungan Anda di kantor kami. Mohon kesediaan Anda untuk mengisi formulir di bawah ini
            sebagai bagian dari prosedur administrasi dan peningkatan layanan kami.
        </p>
    </div>

    {{-- PROGRESS STEPS WITH CONNECTING LINE --}}
    <div class="w-full max-w-4xl mb-12">
        <div class="flex items-center justify-between relative">
            {{-- Garis penghubung background --}}
            <div class="absolute h-1 bg-gray-200 dark:bg-gray-700 w-full top-1/2 -translate-y-1/2 -z-10"></div>

            {{-- Garis penghubung aktif yang akan terisi sesuai progress --}}
            <div class="absolute h-1 bg-gradient-to-r from-[#0100CC] via-[#0166FE] to-[#18D1FF] w-0 top-1/2 -translate-y-1/2 -z-10 transition-all duration-500 ease-out"
                style="width: {{ ($currentStep - 1) * 50 }}%; max-width: 100%;"></div>

            @foreach (['Identitas', 'Foto & TTD', 'Verifikasi'] as $index => $step)
                @php $stepNumber = $index + 1; @endphp
                <div class="flex flex-col items-center">
                    {{-- Step Circle --}}
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300
                                {{ $currentStep >= $stepNumber ? 'bg-gradient-to-r from-[#0100CC] to-[#18D1FF] text-white shadow-lg shadow-blue-500/30 scale-110' : 'bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400' }}">
                        @if ($currentStep > $stepNumber)
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            {{ $stepNumber }}
                        @endif
                    </div>

                    {{-- Step Label --}}
                    <span
                        class="text-xs md:text-sm mt-3 font-semibold transition-all duration-300
                                 {{ $currentStep >= $stepNumber ? 'text-[#0100CC] dark:text-[#18D1FF]' : 'text-gray-500 dark:text-gray-400' }}">
                        {{ $step }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div
            class="w-full max-w-3xl p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-2xl flex items-center shadow-sm animate-fade-in">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div
        class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 md:p-10">
        <form wire:submit.prevent="submit" class="space-y-8">

            {{-- STEP 1: IDENTITAS --}}
            @if ($currentStep == 1)
                <div class="space-y-6 animate-fade-in-up">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <span
                            class="w-8 h-8 bg-gradient-to-r from-[#0100CC] to-[#18D1FF] rounded-lg flex items-center justify-center text-white text-sm">1</span>
                        Informasi Pengunjung
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="nama" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#0100CC] transition-all"
                                placeholder="Masukkan nama lengkap Anda">
                            @error('nama')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Pilihan Jenis Kelamin --}}
                        <div class="mb-4" x-data="{ jk: @entangle('jenis_kelamin') }">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                                Jenis Kelamin
                            </label>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Opsi Laki-laki --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="jk" value="Laki-laki" class="hidden"
                                        wire:model.live="jenis_kelamin" x-model="jk">
                                    <div :class="jk === 'Laki-laki' ? 'border-[#0100CC] bg-blue-50 dark:bg-blue-900/20' :
                                        'border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800'"
                                        class="p-4 rounded-2xl border-2 transition-all flex items-center gap-3 hover:border-blue-300">
                                        <span class="text-2xl">👨</span>
                                        <span :class="jk === 'Laki-laki' ? 'text-[#0100CC]' : 'text-gray-500'"
                                            class="font-semibold text-sm transition-colors">Laki-laki</span>
                                    </div>
                                </label>

                                {{-- Opsi Perempuan --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="jk" value="Perempuan" class="hidden"
                                        wire:model.live="jenis_kelamin" x-model="jk">
                                    <div :class="jk === 'Perempuan' ? 'border-[#0100CC] bg-blue-50 dark:bg-blue-900/20' :
                                        'border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800'"
                                        class="p-4 rounded-2xl border-2 transition-all flex items-center gap-3 hover:border-blue-300">
                                        <span class="text-2xl">👩</span>
                                        <span :class="jk === 'Perempuan' ? 'text-[#0100CC]' : 'text-gray-500'"
                                            class="font-semibold text-sm transition-colors">Perempuan</span>
                                    </div>
                                </label>
                            </div>

                            @error('jenis_kelamin')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">
                                Asal Instansi/Alamat <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="asal_instansi" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#0100CC] transition-all"
                                placeholder="Contoh: Universitas Merdeka Malang">
                            @error('asal_instansi')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div x-data="{
                        open: false,
                        selectedKeperluan: @entangle('keperluan'),
                        search: @entangle('keperluan'),
                        {{-- Hubungkan langsung dengan wire:model --}}
                        keperluanOptions: [
                            'Konsultasi layanan', 'Konsultasi Tanda Tangan Elektronik',
                            'Pengajuan permohonan', 'Pengurusan perizinan',
                            'Pengambilan dokumen', 'Penyerahan berkas', 'Klarifikasi data',
                            'Verifikasi dokumen', 'Koordinasi kegiatan', 'Permintaan informasi',
                            'Pengaduan masyarakat', 'Permohonan tanda tangan',
                            'Verifikasi Tanda Tangan Elektronik', 'Legalisasi dokumen',
                            'Pengambilan hasil layanan', 'Kunjungan dinas', 'Audiensi',
                            'Rapat / meeting', 'Studi banding', 'Monitoring dan evaluasi',
                            'Pendampingan kegiatan', 'Supervisi', 'Koordinasi antar instansi',
                            'Undangan kegiatan', 'Kunjungan kerja pimpinan', 'Keperluan pribadi',
                            'Bertemu pegawai', 'Magang / PKL', 'Penelitian / skripsi',
                            'Kunjungan edukasi', 'Kunjungan umum', 'Observasi lapangan',
                            'Wawancara', 'Studi lapangan', 'Pengajuan bantuan', 'Permintaan data',
                            'Konsultasi teknis', 'Pelaporan kegiatan', 'Tindak lanjut program',
                            'Sinkronisasi data', 'Validasi data', 'Input / update data',
                            'Pengambilan data', 'Lainnya'
                        ],
                        get filtered() {
                            if (!this.search) return this.keperluanOptions;
                            return this.keperluanOptions.filter(opt =>
                                opt.toLowerCase().includes(this.search.toLowerCase())
                            );
                        }
                    }" class="relative">

                        <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">
                            Keperluan Kunjungan <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            {{-- Input Utama: Tamu bisa mengetik bebas di sini --}}
                            <input type="text" x-model="search" @focus="open = true"
                                @input="open = true; selectedKeperluan = search" {{-- Sync saat mengetik --}}
                                @click.away="open = false"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#0100CC] transition-all"
                                placeholder="Ketik keperluan Anda...">

                            {{-- Icon Dropdown --}}
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            {{-- Dropdown Pilihan (Autofill) --}}
                            <div x-show="open && filtered.length > 0"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute z-30 w-full mt-1 bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-xl shadow-xl max-h-60 overflow-y-auto">

                                <template x-for="option in filtered" :key="option">
                                    <div @click="selectedKeperluan = option; search = option; open = false"
                                        class="px-4 py-3 cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/30 border-b last:border-0 dark:border-gray-700 text-gray-700 dark:text-gray-200">
                                        <span x-text="option"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        @error('keperluan')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">
                            Pesan & Kesan <span class="text-gray-400 font-normal">(Opsional)</span>
                        </label>

                        <!-- Quick options -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach (['Pelayanan sangat memuaskan', 'Proses cepat dan membantu', 'Pelayanan baik dan ramah', 'Cukup baik', 'Perlu peningkatan', 'Pelayanan kurang memuaskan'] as $item)
                                <button type="button" wire:click="$set('pesan_kesan', '{{ $item }}')"
                                    class="text-xs px-3 py-1.5 rounded-full border
                       border-gray-300 dark:border-gray-600
                       hover:bg-primary hover:text-white transition">
                                    {{ $item }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Manual input -->
                        <textarea wire:model="pesan_kesan" rows="2"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
               rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#0100CC]"
                            placeholder="Atau tulis pesan Anda sendiri..."></textarea>
                    </div>
                </div>
            @endif

            {{-- STEP 2: FOTO & TTD (dengan perbaikan signature pad) --}}
            @if ($currentStep == 2)
                <div class="space-y-8 animate-fade-in-up">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <span
                            class="w-8 h-8 bg-gradient-to-r from-[#0100CC] to-[#18D1FF] rounded-lg flex items-center justify-center text-white text-sm">2</span>
                        Pilih Foto & Tanda Tangan
                    </h2>

                    {{-- Toggle Avatar/Kamera --}}
                    <div>
                        <div class="flex bg-gray-100 dark:bg-gray-700 p-1 rounded-xl mb-6 w-fit">
                            <button type="button" wire:click="$set('foto_metode', 'avatar')"
                                class="px-6 py-2 rounded-lg font-semibold text-sm transition-all {{ $foto_metode == 'avatar' ? 'bg-white dark:bg-gray-800 text-[#0100CC] shadow' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                                Gunakan Avatar
                            </button>
                            <button type="button" wire:click="$set('foto_metode', 'kamera')"
                                class="px-6 py-2 rounded-lg font-semibold text-sm transition-all {{ $foto_metode == 'kamera' ? 'bg-white dark:bg-gray-800 text-[#0100CC] shadow' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                                Ambil Foto Kamera
                            </button>
                        </div>

                        @if ($foto_metode == 'avatar')
                            {{-- Logika Filter Avatar Berdasarkan Gender --}}
                            @php
                                $allAvatars = [
                                    ['file' => 'scholar-man.png', 'gender' => 'Laki-laki'],
                                    ['file' => 'officer-man.png', 'gender' => 'Laki-laki'],
                                    ['file' => 'guest-man.png', 'gender' => 'Laki-laki'],
                                    ['file' => 'scholar-woman.png', 'gender' => 'Perempuan'],
                                    ['file' => 'officer-woman.png', 'gender' => 'Perempuan'],
                                    ['file' => 'guest-woman.png', 'gender' => 'Perempuan'],
                                ];

                                // Filter: Hanya ambil yang sesuai dengan $jenis_kelamin yang dipilih di Step 1
                                $filteredAvatars = collect($allAvatars)->where('gender', $jenis_kelamin)->toArray();
                            @endphp

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @forelse ($filteredAvatars as $avatar)
                                    <div wire:click="$set('selectedAvatar', '{{ $avatar['file'] }}')"
                                        class="cursor-pointer border-4 rounded-2xl p-2 transition-all duration-300 hover:scale-105
                {{ $selectedAvatar == $avatar['file'] ? 'border-[#0100CC] bg-blue-50 dark:bg-blue-900/20' : 'border-transparent bg-gray-50 dark:bg-gray-700/50 hover:border-gray-300 dark:hover:border-gray-600' }}">

                                        <div
                                            class="aspect-square rounded-xl overflow-hidden flex items-center justify-center bg-white">
                                            <img src="{{ asset('images/avatars/' . $avatar['file']) }}"
                                                alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                @empty
                                    {{-- Fallback jika user belum pilih gender tapi entah kenapa bisa ke step 2 --}}
                                    <div
                                        class="col-span-full p-4 text-center bg-yellow-50 text-yellow-700 rounded-xl border border-yellow-200">
                                        ⚠️ Silakan kembali ke langkah pertama dan pilih Jenis Kelamin terlebih dahulu.
                                    </div>
                                @endforelse
                            </div>

                            @error('selectedAvatar')
                                <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                            @enderror
                        @endif

                        @if ($foto_metode == 'kamera')
                            <div x-data="cameraApp()" x-init="initCamera()"
                                class="flex flex-col items-center p-6 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-600">

                                <div x-show="!$wire.foto_base64"
                                    class="relative w-full max-w-sm rounded-xl overflow-hidden bg-black aspect-video flex items-center justify-center">
                                    <video x-ref="video" autoplay playsinline
                                        class="w-full h-full object-cover"></video>
                                    <div x-show="!streamReady"
                                        class="absolute text-white text-sm bg-black/50 px-3 py-1 rounded-full">
                                        Mengakses Kamera...
                                    </div>
                                </div>

                                <div x-show="$wire.foto_base64"
                                    class="relative w-full max-w-sm rounded-xl overflow-hidden border-2 border-[#0100CC]">
                                    <img :src="$wire.foto_base64" class="w-full h-full object-cover">
                                </div>

                                <div class="mt-4 flex gap-3">
                                    <button x-show="!$wire.foto_base64" type="button" @click="takePhoto()"
                                        class="bg-gradient-to-r from-[#0100CC] to-[#18D1FF] text-white px-6 py-2 rounded-full font-bold text-sm shadow-lg hover:shadow-xl transition-all">
                                        📸 Jepret Foto
                                    </button>
                                    <button x-show="$wire.foto_base64" type="button" @click="retakePhoto()"
                                        class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-300 dark:hover:bg-gray-500 transition-all">
                                        🔄 Ulangi Foto
                                    </button>
                                </div>
                                @error('foto_base64')
                                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    {{-- SIGNATURE PAD DENGAN PERBAIKAN --}}
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">
                                Tanda Tangan Digital <span class="text-red-500">*</span>
                            </label>
                            {{-- Tombol bersihkan sekarang mengirim event ke Alpine component --}}
                            <button type="button" @click="$dispatch('clear-signature')"
                                class="text-xs font-semibold text-red-500 bg-red-50 dark:bg-red-500/10 px-3 py-1 rounded-full hover:bg-red-100 dark:hover:bg-red-500/20 transition-colors">
                                🧹 Bersihkan
                            </button>
                        </div>

                        {{-- Alpine component mendengarkan event clear-signature --}}
                        <div wire:ignore x-data="signaturePad(@entangle('ttd_digital'))" x-on:clear-signature.window="clear()">
                            <div
                                class="relative w-full h-48 bg-gray-50 dark:bg-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-500 rounded-2xl overflow-hidden">
                                <canvas x-ref="canvas" @mousedown="start" @mousemove="draw" @mouseup="stop"
                                    @mouseleave="stop" @touchstart.prevent="start" @touchmove.prevent="draw"
                                    @touchend.prevent="stop"
                                    class="absolute top-0 left-0 w-full h-full cursor-crosshair"
                                    style="touch-action: none;">
                                </canvas>
                                <div
                                    class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-20">
                                    <span class="text-2xl font-bold select-none text-gray-400">Tanda Tangan
                                        Disini</span>
                                </div>
                            </div>
                        </div>
                        @error('ttd_digital')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- STEP 3: VERIFIKASI --}}
            @if ($currentStep == 3)
                <div class="space-y-6 animate-fade-in-up">
                    @error('turnstile_token')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <span
                            class="w-8 h-8 bg-gradient-to-r from-[#0100CC] to-[#18D1FF] rounded-lg flex items-center justify-center text-white text-sm">3</span>
                        Verifikasi Data Anda
                    </h2>

                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-3xl border border-blue-200 dark:border-blue-800 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="currentColor"
                                class="text-blue-600">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                            </svg>
                        </div>

                        <div class="flex flex-col md:flex-row gap-8 items-start relative z-10">
                            {{-- Foto Profil --}}
                            <div class="shrink-0 text-center">
                                @if ($foto_metode == 'avatar' && $selectedAvatar)
                                    {{-- Preview Avatar --}}
                                    <div class="relative w-28 h-28 mx-auto rounded-full group">

                                        {{-- Efek Glow/Shadow Halus di Bawah Gambar --}}
                                        <div
                                            class="absolute inset-2 rounded-full bg-blue-400/20 dark:bg-blue-600/10 blur-xl transition-all duration-300 group-hover:blur-2xl opacity-0 group-hover:opacity-100">
                                        </div>

                                        {{-- Gambar Mentah dengan Shadow Floating --}}
                                        <img src="{{ asset('images/avatars/' . $selectedAvatar) }}"
                                            alt="Preview Avatar"
                                            class="relative w-full h-full object-contain rounded-full shadow-[0_15px_30px_-5px_rgba(0,0,0,0.1)] transition-transform duration-500 hover:scale-110">
                                    </div>
                                @elseif($foto_metode == 'kamera' && $foto_base64)
                                    <img src="{{ $foto_base64 }}"
                                        class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                                @else
                                    <div
                                        class="w-24 h-24 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-4xl border-4 border-white shadow-lg">
                                        👤
                                    </div>
                                @endif
                                <span
                                    class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase mt-2 block">Foto
                                    Profil</span>
                            </div>

                            {{-- Data Diri --}}
                            <div class="space-y-3 flex-1">
                                <div>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold">Nama
                                        Lengkap
                                    </p>
                                    <p class="font-bold text-lg">{{ $nama }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4 border-t border-blue-200 dark:border-blue-800 pt-3">
                                    <div>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold">
                                            Instansi
                                            Tujuan</p>
                                        <p class="font-semibold text-[#0100CC]">{{ $instansiTujuan->nama_pd }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold">Asal
                                            Instansi</p>
                                        <p class="font-semibold">{{ $asal_instansi }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-blue-200 dark:border-blue-800 pt-3">
                                    <p class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold">Keperluan
                                    </p>
                                    <p class="text-sm">{{ $keperluan }}</p>
                                </div>
                                @if ($pesan_kesan)
                                    <div class="border-t border-blue-200 dark:border-blue-800 pt-3">
                                        <p class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold">Pesan &
                                            Kesan
                                        </p>
                                        <p class="text-sm italic">"{{ $pesan_kesan }}"</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Tanda Tangan --}}
                            <div class="shrink-0 text-center">
                                <p class="text-[10px] text-gray-400 dark:text-gray-500 uppercase font-bold mb-2">Tanda
                                    Tangan</p>
                                @if ($ttd_digital)
                                    <div
                                        class="h-20 w-32 border-2 border-white shadow-md rounded-xl bg-white dark:bg-gray-900 overflow-hidden p-1 transition-all">
                                        <img src="{{ $ttd_digital }}"
                                            class="h-full w-full object-contain dark:invert dark:brightness-200">
                                    </div>
                                @else
                                    <div
                                        class="h-20 w-32 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center bg-gray-50 dark:bg-gray-800">
                                        <span class="text-xs text-gray-400">Belum diisi</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- CLOUDFLARE TURNSTILE CAPTCHA --}}
                    <div
                        class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-3xl border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center min-h-[140px]">
                        <label class="block mb-4 font-bold text-gray-700 dark:text-gray-300">
                            🔐 Verifikasi Keamanan
                        </label>

                        {{-- Widget Turnstile --}}
                        @php $turnstileSitekey = config('services.turnstile.sitekey'); @endphp

                        @if ($turnstileSitekey)
                            <div wire:ignore wire:key="turnstile-widget" x-data="{
                                initTurnstile() {
                                    // Pastikan container ada
                                    const container = this.$refs.turnstile;
                                    if (!container) return;
                            
                                    if (typeof turnstile !== 'undefined') {
                                        // Hanya render jika belum ada anak (menghindari render ganda)
                                        if (container.childElementCount === 0) {
                                            try {
                                                const id = turnstile.render(container, {
                                                    sitekey: '{{ $turnstileSitekey }}',
                                                    callback: (token) => {
                                                        @this.set('turnstile_token', token);
                                                    }
                                                });
                                                this.widgetId = id;
                                                container.dataset.rendered = '1';
                            
                                                // Dengarkan event reset dari backend
                                                $wire.on('reset-turnstile', () => {
                                                    try {
                                                        if (typeof turnstile !== 'undefined' && this.widgetId) {
                                                            turnstile.reset(this.widgetId);
                                                        }
                                                        @this.set('turnstile_token', '');
                                                    } catch (err) {
                                                        console.error('Turnstile reset error', err);
                                                    }
                                                });
                                            } catch (e) {
                                                // Jika gagal, log error dan coba lagi
                                                console.error('Turnstile render error', e);
                                                setTimeout(() => this.initTurnstile(), 500);
                                            }
                                        }
                                    } else {
                                        // Jika script belum siap, coba lagi setelah 500ms
                                        setTimeout(() => this.initTurnstile(), 500);
                                    }
                                }
                            }"
                                x-init="initTurnstile()" x-ref="turnstile"></div>
                        @else
                            <p class="text-sm text-red-500">Turnstile belum dikonfigurasi. Periksa .env &
                                config/services.php</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- NAVIGATION BUTTONS --}}
            <div class="flex justify-between pt-6 border-t border-gray-100 dark:border-gray-700">
                @if ($currentStep > 1)
                    {{-- Tombol Kembali (Muncul di Step 2 & 3) --}}
                    <button type="button" wire:click="previousStep"
                        class="group inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-6 md:px-8 py-2 sm:py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-bold rounded-xl transition-all text-sm sm:text-base">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 group-hover:-translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        <span class="hidden xs:inline">Kembali</span>
                    </button>
                @else
                    {{-- TOMBOL CLEAR DATA (Hanya muncul di Step 1) --}}
                    <button type="button" wire:click="resetStepOne"
                        onclick="confirm('Bersihkan semua data yang telah diisi?') || event.stopImmediatePropagation()"
                        class="group inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-6 py-2 sm:py-3 bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 font-bold rounded-xl border border-red-100 dark:border-red-900/50 hover:bg-red-100 dark:hover:bg-red-900/50 transition-all text-sm sm:text-base">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Bersihkan</span>
                    </button>
                @endif

                @if ($currentStep < 3)
                    <button type="button" wire:click="nextStep"
                        class="group inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-6 md:px-10 py-2 sm:py-3 bg-gradient-to-r from-[#0100CC] to-[#18D1FF] text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-xl transition-all active:scale-95 text-sm sm:text-base">
                        <span class="hidden xs:inline">Lanjutkan Formulir</span>
                        <span class="xs:hidden">Lanjut</span>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @else
                    <button type="submit" wire:loading.attr="disabled"
                        class="group inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-6 md:px-10 py-2 sm:py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg shadow-green-500/30 hover:shadow-xl transition-all active:scale-95 text-sm sm:text-base">
                        <svg wire:loading wire:target="submit" class="animate-spin h-4 w-4 sm:h-5 sm:w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="submit" class="hidden xs:inline">Kirim & Simpan
                            Data</span>
                        <span wire:loading.remove wire:target="submit" class="xs:hidden">Kirim</span>
                        <span wire:loading wire:target="submit" class="inline">Memproses...</span>
                    </button>
                @endif
            </div>
        </form>
    </div>
</section>

@push('styles')
    <style>
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
            animation: fade-in-up 0.5s ease-out forwards;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }
    </style>
@endpush

@script
    <script>
        // Listener untuk Pop-Up Sukses & Survei Berantai
        $wire.on('tamu-berhasil-disimpan', (event) => {

            const idSurvey = event.id_survey;
            const redirectUrl = event.redirect_url;

            // MODAL 1: Notifikasi Berhasil
            Swal.fire({
                title: 'Berhasil Terkirim!',
                text: 'Terima kasih, data kunjungan Anda telah tersimpan.',
                icon: 'success',
                confirmButtonText: 'Selesai',
                confirmButtonColor: '#0100CC',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // MODAL 2: Pengalihan ke Sukma Jatim (Tanpa Tombol Batal)
                    Swal.fire({
                        title: 'Survei Kepuasan',
                        text: 'Mohon isi Survei Kepuasan Masyarakat (IKM) melalui tombol dibawah ini untuk membantu kami meningkatkan pelayanan.',
                        icon: 'info',
                        confirmButtonText: 'Isi Survei Sekarang',
                        confirmButtonColor: '#10b981',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then((surveyResult) => {
                        if (surveyResult.isConfirmed) {
                            // Gunakan variabel yang sudah kita ambil di atas
                            const urlSukma =
                                `https://sukma.jatimprov.go.id/home/survei?idUser=${event.id_survey}`;

                            // Buka survei di tab baru
                            window.open(urlSukma, '_blank');

                            // Redirect halaman asal ke detail PD
                            window.location.href = redirectUrl;
                        }
                    });
                }
            });
        });

        // Script Kamera Webcam
        Alpine.data('cameraApp', () => ({
            stream: null,
            streamReady: false,

            initCamera() {
                if (this.$wire.foto_base64) return; // Jika sudah ada foto, tidak usah nyalakan kamera

                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: 'user'
                        }
                    })
                    .then(stream => {
                        this.stream = stream;
                        this.$refs.video.srcObject = stream;
                        this.streamReady = true;
                    })
                    .catch(err => {
                        alert("Kamera tidak dapat diakses. Pastikan Anda memberikan izin kamera browser.");
                        console.error("Camera error:", err);
                    });
            },
            takePhoto() {
                let canvas = document.createElement('canvas');
                canvas.width = this.$refs.video.videoWidth;
                canvas.height = this.$refs.video.videoHeight;
                let ctx = canvas.getContext('2d');
                ctx.drawImage(this.$refs.video, 0, 0, canvas.width, canvas.height);

                // Simpan gambar ke variabel Livewire
                this.$wire.set('foto_base64', canvas.toDataURL('image/jpeg', 0.8));
                this.stopCamera(); // Matikan kamera setelah jepret
            },
            retakePhoto() {
                this.$wire.set('foto_base64', null);
                this.initCamera(); // Nyalakan kamera lagi
            },
            stopCamera() {
                if (this.stream) {
                    this.stream.getTracks().forEach(track => track.stop());
                    this.streamReady = false;
                }
            }
        }));

        // Script Tanda Tangan
        Alpine.data('signaturePad', (entangledSignature) => ({
            signature: entangledSignature,
            canvas: null,
            ctx: null,
            isDrawing: false,

            init() {
                this.canvas = this.$refs.canvas;
                this.ctx = this.canvas.getContext('2d');
                this.resizeCanvas();
                window.addEventListener('resize', () => this.resizeCanvas());
                this.ctx.lineWidth = 3;
                this.ctx.lineCap = 'round';
                this.ctx.strokeStyle = '#000000';
            },
            resizeCanvas() {
                const rect = this.canvas.parentElement.getBoundingClientRect();
                this.canvas.width = rect.width;
                this.canvas.height = rect.height;
            },
            getCoordinates(e) {
                const rect = this.canvas.getBoundingClientRect();
                let clientX = e.clientX;
                let clientY = e.clientY;
                if (e.touches && e.touches.length > 0) {
                    clientX = e.touches[0].clientX;
                    clientY = e.touches[0].clientY;
                }
                return {
                    x: clientX - rect.left,
                    y: clientY - rect.top
                };
            },
            start(e) {
                this.isDrawing = true;
                const pos = this.getCoordinates(e);
                this.ctx.beginPath();
                this.ctx.moveTo(pos.x, pos.y);
            },
            draw(e) {
                if (!this.isDrawing) return;
                const pos = this.getCoordinates(e);
                this.ctx.lineTo(pos.x, pos.y);
                this.ctx.stroke();
            },
            stop() {
                if (!this.isDrawing) return;
                this.isDrawing = false;
                this.signature = this.canvas.toDataURL('image/png');
            },
            clear() {
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.signature = null;
            }
        }));
    </script>
@endscript
