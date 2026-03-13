<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use Livewire\Component;
use Livewire\WithFileUploads;

class GuestForm extends Component
{
    use WithFileUploads;

    public $instansiTujuan;

    public $currentStep = 1;

    // Step 1: Identitas
    public $nama;

    public $asal_instansi;

    public $keperluan;

    public $pesan_kesan;

    // Step 2: Avatar & TTD
    public $selectedAvatar = 'man-young.png';

    public $ttd_digital;

    // Step 3: Captcha (Simulasi sederhana)
    public $captcha_answer;

    public $captcha_val1;

    public $captcha_val2;

    public function mount($slug)
    {
        $this->instansiTujuan = PerangkatDaerah::where('slug', $slug)->firstOrFail();
        $this->generateCaptcha();
    }

    public function generateCaptcha()
    {
        $this->captcha_val1 = rand(1, 10);
        $this->captcha_val2 = rand(1, 10);
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
                'selectedAvatar' => 'required',
            ]);
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $this->validate([
            'captcha_answer' => 'required|numeric',
        ]);

        if (intval($this->captcha_answer) !== ($this->captcha_val1 + $this->captcha_val2)) {
            $this->addError('captcha_answer', 'Jawaban captcha salah.');

            return;
        }

        Guest::create([
            'perangkat_daerah_id' => $this->instansiTujuan->id,
            'nama' => $this->nama,
            'asal_instansi' => $this->asal_instansi,
            'keperluan' => $this->keperluan,
            'pesan_kesan' => $this->pesan_kesan,
            'foto' => 'avatars/'.$this->selectedAvatar,
            'ttd_digital' => $this->ttd_digital,
        ]);

        session()->flash('success', 'Data berhasil dikirim!');

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.guest-form');
    }
}
