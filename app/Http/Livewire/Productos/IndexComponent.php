<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;
use App\Models\Productos;
use App\Models\TipoProducto;
use App\Models\ProductosCategories;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PDF;

class IndexComponent extends Component

{
    use LivewireAlert;
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
        return view('livewire.productos.index-component', [$tipo_producto = $this->tipo_producto]);
        
    }



    public function alerta($id){
        $producto = Productos::whereId($id)->get()[0];
        $descripcion = "Código de producto: " . $producto->cod_producto . "<br>" .
        "Tipo de producto: " . $producto->tipo_producto;
        $this->alert('info', $producto->descripcion, [
            'position' => 'center',
            'toast' => false,
            'html' => 
            "<strong> ID del producto: </strong>  $producto->id <br> 
            <strong> Código del producto: </strong>  $producto->cod_producto <br>
            <strong> Tipo del producto: </strong>  $producto->tipo_producto <br>
            <strong> Ecotasa: </strong>  $producto->ecotasa <br>
            <strong> Fabricante: </strong>  $producto->fabricante <br>
            <strong> Etiquetado europeo: </strong>  $producto->etiquetado_eu <br>
            <strong> Estado: </strong>  $producto->estado <br>
            <strong> Categoría: </strong>  $producto->categoria <br>
            <strong> Precio baremo: </strong>  $producto->precio_baremo <br>
            <strong> Descuento al precio: </strong>  $producto->descuento <br>
            <strong> Precio costo neto: </strong>  $producto->precio_costoNeto <br>
            <strong> Precio de venta: </strong>  $producto->precio_venta <br>
            <strong> Stock: </strong>  $producto->stock
            ",
        ]);
    }

    public function tipo_producto(){
        if($this->tipo_producto == ""){
            $this->productos = Productos::all();
        } else{
            $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->get();
        }
    }
}
