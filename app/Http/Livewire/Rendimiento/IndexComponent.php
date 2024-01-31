<?php

namespace App\Http\Livewire\Trabajadores;

use App\Models\User;
use Livewire\Component;

class IndexComponent extends Component
{
    // public $search;
    public $trabajadores;

    public function mount()
    {
        $this->trabajadores = User::all();
    }

    public function render()
    {
        return view('livewire.rendimiento.index-component');
    }
    
}
