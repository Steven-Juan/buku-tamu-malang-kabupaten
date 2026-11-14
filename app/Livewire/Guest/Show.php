<?php

namespace App\Livewire\Guest;

use App\Concerns\HasPreview;
use App\Models\Guest;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Show extends Component
{
    use HasPreview;

    /**
     * The guest instance.
     *
     * @var \App\Models\Guest
     */
    public $guest;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount(Guest $guest)
    {
        // Admin Perangkat Daerah hanya boleh melihat tamu instansinya sendiri
        $user = auth()->user();
        abort_if($user->perangkat_daerah_id && (int) $user->perangkat_daerah_id !== (int) $guest->perangkat_daerah_id, 404);

        $this->guest = $guest->load('perangkatDaerah');

        /**
         * Handle preview logic from Filament Peek.
         */
        $this->handlePreview();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        seo()
            ->title('Guest Visit: '.$this->guest->nama)
            ->description('Visit details for '.$this->guest->nama.' at '.$this->guest->perangkatDaerah->nama_pd)
            ->addSchema(
                Schema::article()
                    ->headline('Guest Visit: '.$this->guest->nama)
                    ->articleBody($this->guest->keperluan)
                    ->image($this->guest->foto)
                    ->datePublished($this->guest->created_at)
                    ->dateModified($this->guest->updated_at)
                    ->author(Schema::person()->name($this->guest->nama))
            );

        if ($this->guest->foto) {
            seo()->image(asset('storage/'.$this->guest->foto));
        }

        return view('livewire.guest.show');
    }
}
