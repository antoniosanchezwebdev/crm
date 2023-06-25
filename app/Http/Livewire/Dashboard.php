<?php

namespace App\Http\Livewire;

use App\Models\OrdenTrabajo;
use App\Models\Productos;
use Livewire\Component;

class Dashboard extends Component
{
    public $tareas;
    public $productos;

    public function mount()
    {
        $this->tareas = OrdenTrabajo::all();
        $this->productos = Productos::all();

    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
