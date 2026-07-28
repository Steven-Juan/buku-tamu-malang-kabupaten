<?php

namespace App\Livewire;

use App\Models\PerangkatDaerah;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    // Variabel untuk menangkap ketikan di kotak pencarian
    public $search = '';

    // Reset halaman ke 1 setiap kali query pencarian berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Cari perangkat daerah berdasarkan nama atau slug yang diketik, dibatasi 12 per halaman
        $daftarPd = PerangkatDaerah::withCount('guests')
            ->where(function ($query) {
                $query->where('nama_pd', 'like', '%'.$this->search.'%')
                    ->orWhere('slug', 'like', '%'.$this->search.'%');
            })
            ->orderBy('nama_pd')
            ->paginate(12);

        return view('livewire.home', [
            'daftarPd' => $daftarPd,
        ])->title('Portal Buku Tamu Digital - Kabupaten Malang');
    }
}
