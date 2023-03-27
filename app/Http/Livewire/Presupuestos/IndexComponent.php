<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Trabajador;
use App\Models\Clients;
use App\Models\Presupuesto;
use Livewire\Component;

class IndexComponent extends Component
{
    // public $search;
    public $presupuestos;
    public $clientes;
    public $trabajadores;

    public function mount()
    {
        $this->presupuestos = Presupuesto::all();
        $this->clientes = Clients::all();
        $this->trabajadores = Trabajador::all();
    }

    public function render()
    {

        return view('livewire.presupuestos.index-component');
    }

}
