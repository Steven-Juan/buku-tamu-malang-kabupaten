<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class GuestForm extends Component
{
    public $instansiTujuan;

    public $currentStep = 1;

    // Step 1: Identitas
    public $nama;

    public $asal_instansi;

    public $keperluan;

    public $pesan_kesan;

    // Step 2: Avatar / Kamera & TTD
    public $foto_metode = 'avatar'; // Pilihan: 'avatar' atau 'kamera'

    public $selectedAvatar = 'man-young.png';

    public $foto_base64; // Menampung data kamera

    public $ttd_digital;

    public function mount($slug)
    {
        $this->instansiTujuan = PerangkatDaerah::where('slug', $slug)->firstOrFail();
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'nama' => 'required|min:3',
                'asal_instansi' => 'required',
                'keperluan' => 'required',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'ttd_digital' => 'required',
            ]);

            // Validasi khusus berdasarkan metode foto yang dipilih
            if ($this->foto_metode === 'avatar') {
                if (empty($this->selectedAvatar)) {
                    $this->addError('selectedAvatar', 'Silakan pilih salah satu avatar terlebih dahulu.');

                    return;
                }
            } elseif ($this->foto_metode === 'kamera') {
                if (empty($this->foto_base64)) {
                    $this->addError('foto_base64', 'Silakan ambil foto kamera terlebih dahulu.');

                    return;
                }
            }
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public $turnstile_token;

    public function submit()
    {
        $this->validate([
            'turnstile_token' => 'required|turnstile',
            'turnstile_token.required' => 'Silakan centang verifikasi keamanan.',
            'turnstile_token.turnstile' => 'Verifikasi keamanan gagal, silakan coba lagi.',
        ]);

        // Proses penyimpanan Foto (Avatar vs Kamera)
        $fotoPath = '';
        if ($this->foto_metode === 'avatar') {
            $fotoPath = 'images/avatars/' . $this->selectedAvatar; // Simpan path avatar
        } else {
            // Konversi Base64 dari kamera menjadi file fisik agar terbaca di Filament
            if (preg_match('/^data:image\/(\w+);base64,/', $this->foto_base64, $type)) {
                $data = substr($this->foto_base64, strpos($this->foto_base64, ',') + 1);
                $type = strtolower($type[1]);
                $data = base64_decode($data);
                $filename = 'guests/photos/' . Str::uuid() . '.' . $type;
                Storage::disk('public')->put($filename, $data);
                $fotoPath = $filename;
            }
        }

        $this->instansiTujuan->refresh();
        $idSurvey = $this->instansiTujuan->id_survey;
        $redirectUrl = route('department.detail', $this->instansiTujuan->slug);

        $this->dispatch(
            'tamu-berhasil-disimpan',
            id_survey: $idSurvey,
            redirect_url: $redirectUrl
        );

        Guest::create([
            'perangkat_daerah_id' => $this->instansiTujuan->id,
            'nama' => $this->nama,
            'asal_instansi' => $this->asal_instansi,
            'keperluan' => $this->keperluan,
            'pesan_kesan' => $this->pesan_kesan,
            'foto' => $fotoPath,
            'ttd_digital' => $this->ttd_digital,
        ]);
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
}
