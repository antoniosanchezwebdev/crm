<?php

namespace App\Http\Livewire\Caja;

use App\Models\Presupuesto;
use App\Models\CobroCaja;
use Livewire\Component;

class IndexComponent extends Component
{
    // public $search;
    public $presupuestos;
    public $movimientos;


    public function mount()
    {
        $this->presupuestos = Presupuesto::all();
        $this->movimientos = CobroCaja::all();
        $this->fechaInicio = now()->startOfMonth()->format('Y-m-d');
        $this->fechaFin = now()->endOfMonth()->format('Y-m-d');
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->totalMovimientos = CobroCaja::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])
        ->sum('cantidad');
    }

    public function render()
    {

        return view('livewire.caja.index-component');
    }

}
