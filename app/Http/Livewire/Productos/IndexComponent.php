<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;
use App\Models\Productos;
use App\Models\Neumatico;
use App\Models\Almacen;
use App\Models\TipoProducto;
use App\Models\ProductosCategories;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PDF;

/**
 * Summary of IndexComponent
 */
class IndexComponent extends Component

{
    use LivewireAlert;
    public $tipos_producto;
    public $categorias;
    public $tipo_producto = "";

    public $busqueda_articulo = "";

    public $busqueda_descripcion = "";

    public $productos;
    public $neumaticos;
    public $almacenes;

    protected $listeners = ['refreshComponent' => '$refresh'];


    public function mount()
    {
        $this->categorias = ProductosCategories::all();
        $this->tipos_producto = TipoProducto::all();
        $this->productos = Productos::all();
        $this->neumaticos = Neumatico::all();
        $this->almacenes = Almacen::all();
    }
    public function render()
    {
        return view('livewire.productos.index-component');
        
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

    /**
     * @return void
     */
    public function select_producto(){
        if($this->tipo_producto == ""){
            if($this->busqueda_descripcion == "" && $this->busqueda_articulo == ""){
                $this->productos = Productos::all()->paginate(10);
            } else{
                if($this->busqueda_articulo != ""){
                    $this->productos = Productos::where('cod_producto', 'LIKE','%'.$this->busqueda_articulo.'%')->get()->paginate(10);
                } else if($this->busqueda_descripcion != ""){
                    $this->productos = Productos::where('descripcion', 'LIKE','%'.$this->busqueda_descripcion.'%')->get()->paginate(10);
                }
            }
        } else{
            if($this->busqueda_descripcion == "" && $this->busqueda_articulo == ""){
                $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->get()->paginate(10);
            } else{
                if($this->busqueda_articulo != ""){
                    $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->where('cod_producto', 'LIKE','%'.$this->busqueda_articulo.'%')->get()->paginate(10);
                } else if($this->busqueda_descripcion != ""){
                    $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->where('descripcion', 'LIKE','%'.$this->busqueda_descripcion.'%')->get()->paginate(10);
                }
            }
        }
    
        $this->emit('refreshComponent');
    }
}
