<?php

namespace App\Http\Livewire\Informes;

use Livewire\Component;

class Informes extends Component
{
    public $tab = "tab1";
    public $movimiento;
    protected $listeners = ['seleccionarProducto' => 'selectProducto'];

    public function render()
    {
        return view('livewire.informes.informes');
    }

    public function cambioTab($tab){
        $this->tab = $tab;
    }
    public function selectProducto($factura){
        $this->movimiento = $factura;
        $this->tab = "tab3";
    }
}
