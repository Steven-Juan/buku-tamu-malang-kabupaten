<section
    class="flex flex-col items-center bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-4 py-10 min-h-screen transition-colors duration-300">

    <div class="w-full max-w-3xl mb-6">
        <a href="{{ route('home') }}" wire:navigate
            class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-blue-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    <div class="w-full max-w-3xl text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">
            Buku Tamu <span class="text-blue-600">Digital</span>
        </h1>
        <p class="text-gray-500 text-sm md:text-base">
            Anda sedang mengisi daftar hadir untuk instansi: <br>
            <strong class="text-lg text-gray-700 dark:text-gray-300">{{ $instansiTujuan->nama_pd }}</strong>
        </p>
    </div>

    @if (session()->has('success'))
    <div class="w-full max-w-3xl p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-2xl flex items-center shadow-sm">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div
        class="w-full max-w-3xl bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 md:p-10">
        <form wire:submit.prevent="submit" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input wire:model="nama" type="text"
                        class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Masukkan nama Anda">
                    @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Asal Instansi/Alamat
                        <span class="text-red-500">*</span></label>
                    <input wire:model="asal_instansi" type="text"
                        class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Contoh: Universitas Brawijaya">
                    @error('asal_instansi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Keperluan Kunjungan <span
                        class="text-red-500">*</span></label>
                <textarea wire:model="keperluan" rows="3"
                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                    placeholder="Jelaskan tujuan kedatangan Anda secara singkat"></textarea>
                @error('keperluan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Pesan & Kesan <span
                        class="text-gray-400 font-normal">(Opsional)</span></label>
                <textarea wire:model="pesan_kesan" rows="2"
                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                    placeholder="Tinggalkan pesan atau kesan untuk instansi ini"></textarea>
            </div>

            <div x-data="signaturePad(@entangle('ttd_digital'))" class="mt-8">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Tanda Tangan Digital <span
                            class="text-red-500">*</span></label>
                    <button type="button" @click="clear()"
                        class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors">
                        Bersihkan
                    </button>
                </div>

                <div
                    class="relative w-full h-48 bg-gray-50 dark:bg-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-500 rounded-2xl overflow-hidden">
                    <canvas x-ref="canvas" @mousedown="start($event)" @mousemove="draw($event)" @mouseup="stop()"
                        @mouseleave="stop()" @touchstart.prevent="start($event)" @touchmove.prevent="draw($event)"
                        @touchend.prevent="stop()" class="absolute top-0 left-0 w-full h-full cursor-crosshair"
                        style="touch-action: none;"></canvas>

                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-20">
                        <span class="text-2xl font-bold select-none">Tanda Tangan Disini</span>
                    </div>
                </div>
                @error('ttd_digital') <span class="text-red-500 text-xs mt-1 block">Tanda tangan wajib diisi.</span>
                @enderror
            </div>

            <div class="pt-6">
                <button type="submit"
                    class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg py-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 active:scale-[0.98]">
                    <svg wire:loading wire:target="submit" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Simpan Data Kunjungan
                </button>
            </div>
        </form>
    </div>
</section>

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