<?php

namespace App\Http\Livewire\Presupuestos;

use Livewire\Component;

class PresupuestosComponent extends Component
{

    public $tab = "tab1";
    public $presupuesto;


    public function render()
    {
        return view('livewire.presupuestos.presupuestos-component');
    }

    public function cambioTab($tab){
        $this->tab = $tab;
    }
}
