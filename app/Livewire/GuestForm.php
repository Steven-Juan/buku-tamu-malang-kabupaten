<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use Livewire\Component;
use Livewire\WithFileUploads;

class GuestForm extends Component
{
    use WithFileUploads;

    public $instansiTujuan; // Untuk menyimpan objek Perangkat Daerah
    
    public $perangkat_daerah_id;
    public $nama;
    public $asal_instansi;
    public $keperluan;
    public $pesan_kesan;
    public $ttd_digital;

    /**
     * Dijalankan pertama kali saat halaman form dibuka.
     * Mengambil parameter {slug} dari URL route.
     */
    public function mount($slug)
    {
        // Cari dinas berdasarkan slug. Jika tidak ada, otomatis muncul error 404
        $this->instansiTujuan = PerangkatDaerah::where('slug', $slug)->firstOrFail();
        
        // Kunci ID dinas tujuan agar tamu tidak perlu memilih lagi
        $this->perangkat_daerah_id = $this->instansiTujuan->id;
    }

    public function submit()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'asal_instansi' => 'required|string|max:255',
            'keperluan' => 'required|string',
            'ttd_digital' => 'required|string',
        ]);

        Guest::create([
            'perangkat_daerah_id' => $this->perangkat_daerah_id,
            'nama' => $this->nama,
            'asal_instansi' => $this->asal_instansi,
            'keperluan' => $this->keperluan,
            'pesan_kesan' => $this->pesan_kesan,
            'ttd_digital' => $this->ttd_digital,
            'foto' => 'images/user.png', // Placeholder sementara sebelum ada webcam
        ]);

        $this->reset(['nama', 'asal_instansi', 'keperluan', 'pesan_kesan', 'ttd_digital']);

        session()->flash('success', 'Terima kasih, data kunjungan Anda ke ' . $this->instansiTujuan->nama_pd . ' telah tersimpan.');
    }

    public function render()
    {
        // Secara default, jika menggunakan full-page Livewire component, 
        // ia akan mencari layout di components/layouts/app.blade.php
        return view('livewire.guest-form')
            ->title('Buku Tamu - ' . $this->instansiTujuan->nama_pd);
    }
}