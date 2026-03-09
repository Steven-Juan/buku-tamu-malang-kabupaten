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
     * @param  int  $id
     * @return void
     */
    public function mount($id)
    {
        /**
         * Retrieve the guest by ID with its office relationship.
         */
        $this->guest = Guest::with('perangkatDaerah')->findOrFail($id);

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
