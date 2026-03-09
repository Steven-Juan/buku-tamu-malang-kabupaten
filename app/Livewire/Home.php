<?php

namespace App\Livewire;

use App\Models\PerangkatDaerah;
use Livewire\Component;

class Home extends Component
{
    // Variabel untuk menangkap ketikan di kotak pencarian
    public $search = '';

    public function render()
    {
        // Cari perangkat daerah berdasarkan nama yang diketik, atau tampilkan semua jika kosong
        $daftarPd = PerangkatDaerah::where('nama_pd', 'like', '%'.$this->search.'%')
            ->orderBy('nama_pd')
            ->get();

        return view('livewire.home', [
            'daftarPd' => $daftarPd,
        ])->title('Portal Buku Tamu Digital - Kabupaten Malang');
    }
}
