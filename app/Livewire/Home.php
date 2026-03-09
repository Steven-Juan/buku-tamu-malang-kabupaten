<?php

namespace App\Livewire;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\SchemaOrg\Schema;

class Home extends Component
{
    use WithPagination;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        seo()
            ->title($title = config('app.name'))
            ->description($description = 'Buku Tamu Digital Kabupaten Malang')
            ->canonical($url = route('home'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(Schema::organization()->name($title))
            );

        /**
         * Get the latest guests with their associated office (Perangkat Daerah).
         */
        $guests = Guest::with('perangkatDaerah')
            ->latest()
            ->paginate(6);

        return view('livewire.home', compact('guests'));
    }
}
