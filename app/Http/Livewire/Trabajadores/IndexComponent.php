<?php

namespace App\Http\Livewire\Trabajadores;

use App\Models\Trabajador;
use Livewire\Component;

class IndexComponent extends Component
{
    // public $search;
    public $trabajadores;

    public function mount()
    {
        $this->trabajadores = Trabajador::all();
    }

    public function render()
    {

        return view('livewire.trabajadores.index-component');
    }

}
