<section class="max-w-4xl mx-auto py-12 px-4">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="flex items-center justify-between mb-12 relative">
        <div class="absolute h-1 bg-gray-200 w-full top-1/2 -z-10"></div>
        @foreach(['Identitas', 'Foto & TTD', 'Verifikasi'] as $index => $step)
        <div class="flex flex-col items-center">
            <div
                class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $currentStep >= ($index + 1) ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-gray-200 text-gray-500' }} transition-all">
                {{ $index + 1 }}
            </div>
            <span
                class="text-xs mt-2 font-semibold {{ $currentStep >= ($index + 1) ? 'text-primary' : 'text-gray-500' }}">{{ $step }}</span>
        </div>
        @endforeach
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-accent">
        <form wire:submit.prevent="submit">

            @if($currentStep == 1)
            <div class="space-y-6 animate-fade-in-up">
                <h2 class="text-2xl font-bold mb-4">Informasi Pengunjung</h2>
                <div>
                    <input wire:model="nama" type="text" placeholder="Nama Lengkap *"
                        class="w-full border-gray-200 rounded-xl p-4 bg-gray-50 outline-none focus:ring-2 focus:ring-primary">
                    @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input wire:model="asal_instansi" type="text" placeholder="Asal Instansi/Alamat *"
                        class="w-full border-gray-200 rounded-xl p-4 bg-gray-50 outline-none focus:ring-2 focus:ring-primary">
                    @error('asal_instansi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <textarea wire:model="keperluan" rows="3" placeholder="Keperluan Kunjungan *"
                        class="w-full border-gray-200 rounded-xl p-4 bg-gray-50 outline-none focus:ring-2 focus:ring-primary"></textarea>
                    @error('keperluan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <textarea wire:model="pesan_kesan" rows="2" placeholder="Pesan & Kesan (Opsional)"
                    class="w-full border-gray-200 rounded-xl p-4 bg-gray-50 outline-none focus:ring-2 focus:ring-primary"></textarea>
            </div>
            @endif

            @if($currentStep == 2)
            <div class="space-y-8 animate-fade-in-up">

                <div>
                    <h2 class="text-2xl font-bold mb-4">Pilih Foto Profil</h2>
                    <div class="flex bg-gray-100 p-1 rounded-xl mb-6 w-fit">
                        <button type="button" wire:click="$set('foto_metode', 'avatar')"
                            class="px-6 py-2 rounded-lg font-semibold text-sm transition-all {{ $foto_metode == 'avatar' ? 'bg-white text-primary shadow' : 'text-gray-500 hover:text-gray-700' }}">Gunakan
                            Avatar</button>
                        <button type="button" wire:click="$set('foto_metode', 'kamera')"
                            class="px-6 py-2 rounded-lg font-semibold text-sm transition-all {{ $foto_metode == 'kamera' ? 'bg-white text-primary shadow' : 'text-gray-500 hover:text-gray-700' }}">Ambil
                            Foto Kamera</button>
                    </div>

                    @if($foto_metode == 'avatar')
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['man-young.png', 'woman-young.png', 'man-old.png', 'woman-old.png'] as $avatar)
                        <div wire:click="$set('selectedAvatar', '{{ $avatar }}')"
                            class="cursor-pointer border-4 rounded-2xl p-2 transition-all {{ $selectedAvatar == $avatar ? 'border-primary bg-primary/5' : 'border-transparent bg-gray-50' }}">
                            {{-- Pastikan gambar ini ada di public/images/avatars/ --}}
                            <img src="{{ asset('images/avatars/' . $avatar) }}" class="w-full rounded-xl">
                        </div>
                        @endforeach
                    </div>
                    @error('selectedAvatar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    @endif

                    @if($foto_metode == 'kamera')
                    <div x-data="cameraApp()" x-init="initCamera()"
                        class="flex flex-col items-center p-6 bg-gray-50 rounded-2xl border border-dashed border-gray-300">

                        <div x-show="!$wire.foto_base64"
                            class="relative w-full max-w-sm rounded-xl overflow-hidden bg-black aspect-video flex items-center justify-center">
                            <video x-ref="video" autoplay playsinline class="w-full h-full object-cover"></video>
                            <div x-show="!streamReady" class="absolute text-white text-sm">Mengakses Kamera...</div>
                        </div>

                        <div x-show="$wire.foto_base64"
                            class="relative w-full max-w-sm rounded-xl overflow-hidden border-2 border-primary">
                            <img :src="$wire.foto_base64" class="w-full h-full object-cover">
                        </div>

                        <div class="mt-4 flex gap-3">
                            <button x-show="!$wire.foto_base64" type="button" @click="takePhoto()"
                                class="bg-blue-600 text-white px-6 py-2 rounded-full font-bold text-sm shadow-lg hover:bg-blue-700">Jepret
                                Foto</button>
                            <button x-show="$wire.foto_base64" type="button" @click="retakePhoto()"
                                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-300">Ulangi
                                Foto</button>
                        </div>
                        @error('foto_base64') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                    </div>
                    @endif
                </div>

                <div class="pt-6 border-t border-gray-100">
                    <label class="block font-bold text-lg mb-2">Goreskan Tanda Tangan Anda *</label>

                    <div wire:ignore x-data="signaturePad(@entangle('ttd_digital'))">
                        <div class="flex justify-end mb-2">
                            <button type="button" @click="clear()"
                                class="text-xs font-semibold text-red-500 bg-red-50 px-3 py-1 rounded-full hover:bg-red-100 transition-colors">
                                Ulangi Tanda Tangan
                            </button>
                        </div>
                        <div
                            class="relative w-full h-48 bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl overflow-hidden">
                            <canvas x-ref="canvas" @mousedown="start" @mousemove="draw" @mouseup="stop"
                                @mouseleave="stop" @touchstart.prevent="start" @touchmove.prevent="draw"
                                @touchend.prevent="stop" class="absolute top-0 left-0 w-full h-full cursor-crosshair"
                                style="touch-action: none;">
                            </canvas>
                        </div>
                    </div>

                    @error('ttd_digital') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif

            @if($currentStep == 3)
            <div class="space-y-6 animate-fade-in-up">
                <h2 class="text-2xl font-bold text-center">Verifikasi Data Anda</h2>

                <div class="bg-blue-50/50 p-6 rounded-3xl text-sm border border-blue-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg width="100" height="100" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                        </svg>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8 items-start relative z-10">
                        <div class="shrink-0 text-center">
                            @if($foto_metode == 'avatar')
                            <img src="{{ asset('images/avatars/' . $selectedAvatar) }}"
                                class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
                            @else
                            <img src="{{ $foto_base64 }}"
                                class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover bg-black">
                            @endif
                            <span class="text-[10px] font-bold text-gray-500 uppercase mt-2 block">Foto Profil</span>
                        </div>

                        <div class="space-y-3 flex-1">
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold">Nama Lengkap</p>
                                <p class="font-bold text-lg">{{ $nama }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 border-t border-blue-100 pt-3">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold">Instansi Tujuan</p>
                                    <p class="font-semibold text-primary">{{ $instansiTujuan->nama_pd }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold">Asal Instansi/Alamat</p>
                                    <p class="font-semibold">{{ $asal_instansi }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="shrink-0">
                            <p class="text-[10px] text-center text-gray-400 uppercase font-bold mb-1">Tanda Tangan</p>
                            <img src="{{ $ttd_digital }}"
                                class="h-20 w-32 border-2 border-white shadow-sm rounded-xl bg-white object-contain px-2">
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 text-center">
                    <label class="block mb-4 font-bold text-gray-700">Keamanan: Berapakah hasil dari <span
                            class="text-xl text-primary">{{ $captcha_val1 }} + {{ $captcha_val2 }}</span> ?</label>
                    <input wire:model="captcha_answer" type="number"
                        class="w-32 text-center mx-auto border-gray-300 rounded-xl p-3 text-lg font-bold"
                        placeholder="?">
                    @error('captcha_answer') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
            @endif

            <div class="flex justify-between mt-10 pt-6 border-t border-gray-100">
                @if($currentStep > 1)
                <button type="button" wire:click="previousStep"
                    class="px-6 md:px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-colors text-sm md:text-base">Kembali</button>
                @else
                <div></div>
                @endif

                @if($currentStep < 3) <button type="button" wire:click="nextStep"
                    class="px-6 md:px-10 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/30 active:scale-95 transition-all text-sm md:text-base">
                    Lanjutkan Formulir</button>
                    @else
                    <button type="submit" wire:loading.attr="disabled"
                        class="px-6 md:px-10 py-3 bg-green-600 text-white font-bold rounded-xl shadow-lg shadow-green-500/30 active:scale-95 transition-all flex items-center gap-2 text-sm md:text-base">
                        <svg wire:loading wire:target="submit" class="animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Kirim & Simpan Data
                    </button>
                    @endif
            </div>
        </form>
    </div>
</section>

@script
<script>
// Listener untuk Pop-Up Sukses (SweetAlert2)
$wire.on('tamu-berhasil-disimpan', (event) => {
    Swal.fire({
        title: 'Berhasil!',
        text: 'Terima kasih, data kunjungan Anda telah tersimpan.',
        icon: 'success',
        confirmButtonText: 'Selesai',
        confirmButtonColor: '#0100CC',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke halaman detail instansi (halaman sebelumnya)
            window.location.href = event.redirect_url;
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

// Script Tanda Tangan (Sama seperti sebelumnya)
Alpine.data('signaturePad', (entangledSignature) => ({
    // ... (Masukkan logika signaturePad yang sudah Anda miliki sebelumnya di sini) ...
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