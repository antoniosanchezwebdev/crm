<?php

namespace App\Http\Livewire\Facturas;

use Livewire\Component;

class FacturasComponent extends Component
{
    public $tab = "tab1";
    public $factura;
    protected $listeners = ['seleccionarProducto' => 'selectProducto'];
    
    public function render()
    {
        return view('livewire.facturas.facturas-component');
    }

    public function cambioTab($tab){
        $this->tab = $tab;
    }
    public function selectProducto($factura){
        $this->tab = "tab2";
        $this->factura = $factura;
    }
}
