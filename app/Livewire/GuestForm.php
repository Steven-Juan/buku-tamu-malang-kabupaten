<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class GuestForm extends Component
{
    /**
     * Avatar yang tersedia di public/images/avatars.
     */
    public const AVATARS = [
        'scholar-man.png',
        'officer-man.png',
        'guest-man.png',
        'scholar-woman.png',
        'officer-woman.png',
        'guest-woman.png',
    ];

    /**
     * Jenis foto kamera yang diterima (MIME hasil deteksi isi file => ekstensi file).
     */
    private const FOTO_MIMES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    private const MAX_FOTO_BYTES = 5 * 1024 * 1024;

    private const MAX_TTD_BYTES = 1024 * 1024;

    public $instansiTujuan;

    public $currentStep = 1;

    // Step 1: Identitas
    public $nama;

    public $jenis_kelamin;

    public $asal_instansi;

    public $keperluan;

    public $pesan_kesan;

    // Step 2: Avatar / Kamera & TTD
    public $foto_metode = 'avatar'; // Pilihan: 'avatar' atau 'kamera'

    public $selectedAvatar;

    public $foto_base64; // Menampung data kamera

    public $ttd_digital;

    public $turnstile_token;

    public function mount($slug)
    {
        $this->instansiTujuan = PerangkatDaerah::where('slug', $slug)->firstOrFail();
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validate($this->stepOneRules());
        } elseif ($this->currentStep == 2) {
            $this->validateStepTwo();
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        // Validasi ulang semua langkah: submit() bisa dipanggil langsung tanpa melewati nextStep().
        // Dilakukan sebelum Turnstile agar token (sekali pakai) tidak terbuang saat data tidak valid.
        $this->validate($this->stepOneRules());
        [$ttd, $foto] = $this->validateStepTwo();

        try {
            $this->validate([
                'turnstile_token' => 'required|turnstile',
            ], [
                'turnstile_token.required' => 'Silakan centang verifikasi keamanan.',
                'turnstile_token.turnstile' => 'Verifikasi keamanan gagal, silakan coba lagi.',
            ]);
        } catch (ValidationException $e) {
            // Minta client untuk mereset widget Turnstile agar user bisa mencoba lagi
            $this->dispatch('reset-turnstile');
            throw $e;
        }

        // Proses penyimpanan Foto (Avatar vs Kamera)
        if ($foto) {
            // Ekstensi berasal dari isi file yang sudah diverifikasi, bukan dari data kiriman browser
            $fotoPath = 'guests/photos/'.Str::uuid().'.'.$foto['ext'];
            Storage::disk('public')->put($fotoPath, $foto['binary']);
        } else {
            $fotoPath = 'images/avatars/'.$this->selectedAvatar;
        }

        Guest::create([
            'perangkat_daerah_id' => $this->instansiTujuan->id,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'asal_instansi' => $this->asal_instansi,
            'keperluan' => $this->keperluan,
            'pesan_kesan' => $this->pesan_kesan,
            'foto' => $fotoPath,
            // Disimpan ulang dari hasil decode agar isinya pasti data URI PNG yang bersih
            'ttd_digital' => 'data:image/png;base64,'.base64_encode($ttd['binary']),
        ]);

        $this->instansiTujuan->refresh();

        $this->dispatch(
            'tamu-berhasil-disimpan',
            id_survey: $this->instansiTujuan->id_survey,
            redirect_url: route('department.detail', $this->instansiTujuan->slug)
        );
    }

    public function render()
    {
        return view('livewire.guest-form');
    }

    public function resetStepOne()
    {
        $this->nama = '';
        $this->asal_instansi = '';
        $this->keperluan = '';
        $this->pesan_kesan = '';

        $this->resetValidation(['nama', 'asal_instansi', 'keperluan']);
    }

    protected function stepOneRules(): array
    {
        return [
            'nama' => 'required|string|min:3|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_instansi' => 'required|string|max:255',
            'keperluan' => 'required|string|max:1000',
            'pesan_kesan' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Validasi tanda tangan dan foto, termasuk memeriksa isi gambarnya.
     *
     * @return array{0: array{binary: string, mime: string, ext: string}, 1: array{binary: string, mime: string, ext: string}|null}
     */
    protected function validateStepTwo(): array
    {
        $this->validate([
            'ttd_digital' => ['required', 'string'],
            'foto_metode' => ['required', 'in:avatar,kamera'],
            'selectedAvatar' => [Rule::requiredIf($this->foto_metode === 'avatar'), 'nullable', Rule::in(self::AVATARS)],
            'foto_base64' => [Rule::requiredIf($this->foto_metode === 'kamera'), 'nullable', 'string'],
        ], [
            'selectedAvatar.required' => 'Silakan pilih salah satu avatar terlebih dahulu.',
            'selectedAvatar.in' => 'Silakan pilih salah satu avatar terlebih dahulu.',
            'foto_base64.required' => 'Silakan ambil foto kamera terlebih dahulu.',
        ]);

        $ttd = $this->decodeImage($this->ttd_digital, ['image/png' => 'png'], self::MAX_TTD_BYTES);

        if (! $ttd) {
            throw ValidationException::withMessages([
                'ttd_digital' => 'Tanda tangan tidak valid, silakan ulangi tanda tangan.',
            ]);
        }

        $foto = null;

        if ($this->foto_metode === 'kamera') {
            $foto = $this->decodeImage($this->foto_base64, self::FOTO_MIMES, self::MAX_FOTO_BYTES);

            if (! $foto) {
                throw ValidationException::withMessages([
                    'foto_base64' => 'Foto tidak valid (hanya JPG/PNG/WEBP, maks. 5 MB). Silakan ambil ulang foto.',
                ]);
            }
        }

        return [$ttd, $foto];
    }

    /**
     * Decode data URI base64 dan pastikan isinya benar-benar gambar dengan jenis yang diizinkan.
     *
     * @param  array<string, string>  $allowedMimes  MIME => ekstensi
     * @return array{binary: string, mime: string, ext: string}|null
     */
    protected function decodeImage(mixed $dataUri, array $allowedMimes, int $maxBytes): ?array
    {
        if (! is_string($dataUri) || ! preg_match('/^data:image\/[a-z0-9.+-]+;base64,/i', $dataUri, $prefix)) {
            return null;
        }

        // Tolak sebelum decode jika jelas melebihi batas (base64 ~4/3 ukuran asli)
        if (strlen($dataUri) > (int) ceil($maxBytes * 4 / 3) + strlen($prefix[0]) + 4) {
            return null;
        }

        $binary = base64_decode(substr($dataUri, strlen($prefix[0])), true);

        if ($binary === false || $binary === '' || strlen($binary) > $maxBytes) {
            return null;
        }

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($binary);

        if (! isset($allowedMimes[$mime]) || @getimagesizefromstring($binary) === false) {
            return null;
        }

        return ['binary' => $binary, 'mime' => $mime, 'ext' => $allowedMimes[$mime]];
    }
}
