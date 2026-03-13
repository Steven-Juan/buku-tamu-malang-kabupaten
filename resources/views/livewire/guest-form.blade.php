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
                    FORMULIR TAMU DIGITAL
                </span>
            </div>

            <h1
                class="text-center text-text-dark dark:text-text-light text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight mx-auto px-4">
                Buku Tamu
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
    <div class="w-full max-w-4xl px-4 pb-24">

        {{-- Progress Steps --}}
        <div class="flex items-center justify-between mb-12 relative">
            <div class="absolute h-1 bg-gray-200 dark:bg-gray-700 w-full top-1/2 -z-10"></div>
            @foreach(['Identitas', 'Avatar & TTD', 'Verifikasi'] as $index => $step)
            <div class="flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300 
                                {{ $currentStep >= ($index + 1) ? 'bg-gradient-to-r from-primary to-accent text-white shadow-lg shadow-primary/30' : 'bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400' }}">
                    {{ $index + 1 }}
                </div>
                <span class="text-xs mt-2 font-semibold text-gray-600 dark:text-gray-400">{{ $step }}</span>
            </div>
            @endforeach
        </div>

        {{-- Success Message --}}
        @if (session()->has('success'))
        <div
            class="w-full max-w-3xl mx-auto mb-6 p-4 text-sm text-green-800 bg-green-100 rounded-2xl flex items-center shadow-sm animate-fade-in-up">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-10 shadow-xl border border-gray-200 dark:border-gray-700 
                  hover:shadow-2xl transition-all duration-500 relative overflow-hidden">

            {{-- Decorative elements --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/5 to-accent/5 rounded-bl-full">
            </div>
            <div
                class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-primary/5 to-accent/5 rounded-tr-full">
            </div>

            <form wire:submit.prevent="submit" class="relative z-10 space-y-8">

                {{-- STEP 1: IDENTITAS --}}
                @if($currentStep == 1)
                <div class="space-y-6 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-text-dark dark:text-text-light flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        Informasi Pengunjung
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Nama Lengkap
                                <span class="text-red-500">*</span></label>
                            <input wire:model="nama" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-primary transition-all"
                                placeholder="Masukkan nama lengkap Anda">
                            @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Asal Instansi
                                <span class="text-red-500">*</span></label>
                            <input wire:model="asal_instansi" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-primary transition-all"
                                placeholder="Contoh: Universitas Brawijaya">
                            @error('asal_instansi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Keperluan Kunjungan
                            <span class="text-red-500">*</span></label>
                        <textarea wire:model="keperluan" rows="3"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-primary transition-all"
                            placeholder="Jelaskan tujuan kedatangan Anda secara singkat"></textarea>
                        @error('keperluan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Pesan & Kesan <span
                                class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea wire:model="pesan_kesan" rows="2"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-primary transition-all"
                            placeholder="Tinggalkan pesan atau kesan untuk instansi ini"></textarea>
                    </div>
                </div>
                @endif

                {{-- STEP 2: AVATAR & TTD --}}
                @if($currentStep == 2)
                <div class="space-y-8 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-text-dark dark:text-text-light flex items-center gap-2">
                        <span class="w-8 h-8 bg-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        Pilih Avatar & Tanda Tangan
                    </h2>

                    {{-- Avatar Selection --}}
                    <div>
                        <label class="block text-sm font-bold mb-4 text-gray-700 dark:text-gray-300">Pilih Avatar <span
                                class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach([
                            ['file' => 'man-young.png', 'label' => 'Pria Muda'],
                            ['file' => 'woman-young.png', 'label' => 'Wanita Muda'],
                            ['file' => 'man-old.png', 'label' => 'Pria Dewasa'],
                            ['file' => 'woman-old.png', 'label' => 'Wanita Dewasa']
                            ] as $avatar)
                            <div wire:click="$set('selectedAvatar', '{{ $avatar['file'] }}')"
                                class="cursor-pointer border-4 rounded-2xl p-3 transition-all duration-300 hover:scale-105
                                                {{ $selectedAvatar == $avatar['file'] ? 'border-primary bg-primary/5 shadow-lg shadow-primary/20' : 'border-transparent bg-gray-50 dark:bg-gray-700/50 hover:border-gray-300 dark:hover:border-gray-600' }}">
                                <div
                                    class="aspect-square bg-gradient-to-br from-primary/10 to-accent/10 rounded-xl flex items-center justify-center">
                                    <span
                                        class="text-4xl">{{ $avatar['label'] == 'Pria Muda' ? '👨' : ($avatar['label'] == 'Wanita Muda' ? '👩' : ($avatar['label'] == 'Pria Dewasa' ? '👴' : '👵')) }}</span>
                                </div>
                                <p
                                    class="text-center text-[10px] uppercase font-bold mt-2 text-gray-500 dark:text-gray-400">
                                    {{ $avatar['label'] }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @error('selectedAvatar') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Signature Pad --}}
                    <div x-data="signaturePad(@entangle('ttd_digital'))">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Tanda Tangan Digital
                                <span class="text-red-500">*</span></label>
                            <button type="button" @click="clear()"
                                class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors">
                                Bersihkan
                            </button>
                        </div>

                        <div
                            class="relative w-full h-48 bg-gray-50 dark:bg-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-500 rounded-2xl overflow-hidden">
                            <canvas x-ref="canvas" @mousedown="start($event)" @mousemove="draw($event)"
                                @mouseup="stop()" @mouseleave="stop()" @touchstart.prevent="start($event)"
                                @touchmove.prevent="draw($event)" @touchend.prevent="stop()"
                                class="absolute top-0 left-0 w-full h-full cursor-crosshair"
                                style="touch-action: none;"></canvas>

                            <div
                                class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-20">
                                <span class="text-2xl font-bold select-none text-gray-400">Tanda Tangan Disini</span>
                            </div>
                        </div>
                        @error('ttd_digital') <span class="text-red-500 text-xs mt-1 block">Tanda tangan wajib
                            diisi.</span> @enderror
                    </div>
                </div>
                @endif

                {{-- STEP 3: VERIFIKASI --}}
                @if($currentStep == 3)
                <div class="space-y-6 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-text-dark dark:text-text-light flex items-center gap-2">
                        <span class="w-8 h-8 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        Verifikasi Data
                    </h2>

                    {{-- Data Preview Card --}}
                    <div
                        class="bg-gradient-to-br from-primary/5 to-accent/5 p-6 rounded-2xl border border-gray-200 dark:border-gray-700">
                        <h3 class="font-bold text-sm text-gray-600 dark:text-gray-400 mb-4">Review Data Anda</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between pb-2 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-gray-500">Nama Lengkap</span>
                                <span class="font-semibold">{{ $nama }}</span>
                            </div>
                            <div class="flex justify-between pb-2 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-gray-500">Asal Instansi</span>
                                <span class="font-semibold">{{ $asal_instansi }}</span>
                            </div>
                            <div class="flex justify-between pb-2 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-gray-500">Keperluan</span>
                                <span class="font-semibold text-right max-w-[200px]">{{ $keperluan }}</span>
                            </div>
                            @if($pesan_kesan)
                            <div class="flex justify-between pb-2 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-gray-500">Pesan & Kesan</span>
                                <span class="font-semibold text-right max-w-[200px]">{{ $pesan_kesan }}</span>
                            </div>
                            @endif
                        </div>

                        {{-- Avatar & Signature Preview --}}
                        <div class="flex items-center gap-6 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-2">Avatar Terpilih</p>
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center text-3xl mx-auto">
                                    {{ $selectedAvatar == 'man-young.png' ? '👨' : ($selectedAvatar == 'woman-young.png' ? '👩' : ($selectedAvatar == 'man-old.png' ? '👴' : '👵')) }}
                                </div>
                            </div>
                            <div class="text-center flex-1">
                                <p class="text-xs text-gray-500 mb-2">Tanda Tangan</p>
                                @if($ttd_digital)
                                <img src="{{ $ttd_digital }}"
                                    class="h-16 border rounded bg-white dark:bg-gray-900 px-2 mx-auto">
                                @else
                                <div
                                    class="h-16 border rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-xs text-gray-400">Belum diisi</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Captcha --}}
                    <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-2xl">
                        <label class="block mb-2 font-bold text-gray-700 dark:text-gray-300">
                            Berapakah hasil dari {{ $captcha_val1 }} + {{ $captcha_val2 }} ? <span
                                class="text-red-500">*</span>
                        </label>
                        <input wire:model="captcha_answer" type="number"
                            class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-primary transition-all"
                            placeholder="Masukkan jawaban">
                        @error('captcha_answer') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif

                {{-- Navigation Buttons --}}
                <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                    @if($currentStep > 1)
                    <button type="button" wire:click="previousStep"
                        class="group inline-flex items-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-bold rounded-xl transition-all">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </button>
                    @else
                    <div></div>
                    @endif

                    @if($currentStep < 3) <button type="button" wire:click="nextStep"
                        class="group inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-primary to-accent hover:from-accent hover:to-primary text-white font-bold rounded-xl shadow-lg shadow-primary/30 hover:shadow-xl transition-all">
                        Lanjut
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                        </button>
                        @else
                        <button type="submit"
                            class="group inline-flex items-center gap-2 px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg shadow-green-500/30 hover:shadow-xl transition-all">
                            <svg wire:loading wire:target="submit" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span wire:loading.remove wire:target="submit">Kirim Data Kunjungan</span>
                            <span wire:loading wire:target="submit">Memproses...</span>
                        </button>
                        @endif
                </div>
            </form>
        </div>
    </div>
</section>

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
</style>
@endpush

@script
<script>
Alpine.data('signaturePad', (entangledSignature) => ({
    signature: entangledSignature,
    canvas: null,
    ctx: null,
    isDrawing: false,

    init() {
        this.canvas = this.$refs.canvas;
        this.ctx = this.canvas.getContext('2d');

        // Set ukuran internal canvas agar sesuai dengan tampilan CSS-nya
        this.resizeCanvas();
        window.addEventListener('resize', () => this.resizeCanvas());

        // Style coretan pena
        this.ctx.lineWidth = 3;
        this.ctx.lineCap = 'round';
        this.ctx.lineJoin = 'round';
        this.ctx.strokeStyle = '#000000'; // Warna tinta hitam
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

        // Dukungan untuk layar sentuh (HP/Tablet)
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

        // Simpan gambar canvas menjadi Base64 dan kirim ke properti Livewire ($ttd_digital)
        this.signature = this.canvas.toDataURL('image/png');
    },

    clear() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.signature = null; // Kosongkan data di Livewire
    }
}));
</script>
@endscript