<?php

namespace App\Http\Livewire;

use App\Models\Film as ModelsFilm;
use App\Models\Person;
use Livewire\Component;

class Film extends Component
{
    public $film;

    public function mount(ModelsFilm $film)
    {
        $this->film = $film;
    }

    public function render()
    {
        return view('livewire.film', [
            'film' => $this->film::with('people')
        ]);
    }
}
