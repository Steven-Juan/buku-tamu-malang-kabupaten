<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\PerangkatDaerah;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Livewire\Component;

class DepartmentDetail extends Component
{
    public $instansiTujuan;

    public $totalKunjungan;

    public $riwayatTerbaru;

    public $qrCode; // Variabel untuk menampung SVG QR Code

    public function mount($slug)
    {
        $this->instansiTujuan = PerangkatDaerah::where('slug', $slug)->firstOrFail();

        $this->totalKunjungan = Guest::where('perangkat_daerah_id', $this->instansiTujuan->id)->count();
        $this->riwayatTerbaru = Guest::where('perangkat_daerah_id', $this->instansiTujuan->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Generate QR Code menggunakan package yang sudah ada (BaconQrCode)
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd
        );
        $writer = new Writer($renderer);

        // Link yang akan di-scan (mengarah ke Form Tamu spesifik instansi)
        $url = route('guest.form', $this->instansiTujuan->slug);
        $this->qrCode = $writer->writeString($url);
    }

    public function render()
    {
        return view('livewire.department-detail');
    }
}
