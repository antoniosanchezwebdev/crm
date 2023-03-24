<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;
use App\Models\Productos;
use App\Models\TipoProducto;
use App\Models\ProductosCategories;
use PDF;

class IndexComponent extends Component

{
    public $tipos_producto;
    public $categorias;
    public $tipo_producto = "";
    public $productos;


    public function mount()
    {
        $this->categorias = ProductosCategories::all();
        $this->tipos_producto = TipoProducto::all();
        $this->productos = Productos::all();
    }
    public function render()
    {
        return view('livewire.productos.index-component', [
            'productos' => $this->productos,
        ]);
        
    }

    public function pdf()
    {
        // Se llama a los productos
        $this->productos = Productos::all();

        // Se llama a la vista Liveware y se le pasa los productos. En la vista se epecifican los estilos del PDF
        $pdf = PDF::loadView('livewire.productos.pdf-component', ['productos'=>$this->productos]);
        return $pdf->stream();

    }

    public function tipo_producto(){
        if($this->tipo_producto == ""){
            $this->productos = Productos::all();
        } else{
            $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->get();
        }
    }
}
