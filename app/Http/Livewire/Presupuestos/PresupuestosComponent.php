<?php

namespace App\Http\Livewire\Presupuestos;

use Livewire\Component;
use Livewire\WithPagination;

class PresupuestosComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $tab = "tab1";
    public $presupuesto;
    protected $listeners = ['seleccionarProducto' => 'selectProducto'];

    public function seleccionarProducto($id)
    {

        $this->emit("seleccionarProducto", $id);
    }

    public function render()
    {
        return view('livewire.presupuestos.presupuestos-component');
    }

    public function cambioTab($tab){
        $this->tab = $tab;
    }

    public function selectProducto($producto){
        $this->presupuesto = $producto;
        $this->tab = "tab2";
    }
}
