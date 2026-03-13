<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Carbon;
use Livewire\Component;

class DepartmentDetail extends Component
{
    public $instansiTujuan;

    public $qrCode;

    // Variabel Statistik
    public $totalKunjungan;

    public $kunjunganHariIni;

    public $kunjunganMingguIni;

    public $riwayatTerbaru;

    public function mount($slug)
    {
        $this->instansiTujuan = PerangkatDaerah::where('slug', $slug)->firstOrFail();

        $query = Guest::where('perangkat_daerah_id', $this->instansiTujuan->id);

        // 1. Statistik
        $this->totalKunjungan = (clone $query)->count();
        $this->kunjunganHariIni = (clone $query)->whereDate('created_at', Carbon::today())->count();
        $this->kunjunganMingguIni = (clone $query)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // 2. Riwayat
        $this->riwayatTerbaru = (clone $query)->orderBy('created_at', 'desc')->take(5)->get();

        // 3. QR Code
        $renderer = new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd);
        $writer = new Writer($renderer);
        $this->qrCode = $writer->writeString(route('guest.form', $this->instansiTujuan->slug));
    }

    public function render()
    {
        return view('livewire.department-detail');
    }
}
