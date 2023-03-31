<?php

namespace App\Http\Livewire\Productos;

use App\Models\Almacen;
use App\Models\Neumatico;
use App\Models\Productos;
use App\Models\ProductosCategories;
use App\Models\TipoProducto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateComponent extends Component
{

    use LivewireAlert;

    
    public $productos;
    public $categorias;
    public $tipos_producto;
    public $almacenes;
    public $neumaticos;
    
    public $cod_producto;
    public $descripcion;
    public $tipo_producto;
    public $ecotasa;
    public $fabricante;
    public $categoria_id;
    public $precio_baremo;
    public $descuento;
    public $coeficiente;
    public $precio_costoNeto;
    public $precio_venta;
    public $stock;

    public $articulo_id;
    public $resistencia_rodadura;
    public $agarre_mojado;
    public $emision_ruido;
    public $uso;
    public $ancho;
    public $serie;
    public $llanta;
    public $indice_carga;
    public $codigo_velocidad;

    public $existencias;


    public function mount(){
        $this->tipos_producto = TipoProducto::all();
        $this->categorias = ProductosCategories::all();
        $this->neumaticos = Neumatico::all();
        $this->almacenes = Almacen::all();
    }

    public function render()
    {
        return view('livewire.productos.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        $validatedData = $this->validate([
            'cod_producto' => 'required',
            'descripcion'  => 'required',
            'tipo_producto' => 'required',
            'ecotasa' => 'required',
            'fabricante' => 'required',
            'etiquetado_eu' => 'nullable',
            'estado' => 'nullable',
            'categoria_id' => 'nullable',
            'precio_baremo' => 'required',
            'descuento' => 'required',
            'precio_costoNeto' => 'required',
            'precio_venta' => 'required',
            'stock' => 'required|numeric',
        ], [
            'cod_producto.required' => 'required',
            'descripcion.required'  => 'required',
            'tipo_producto.required' => 'required',
            'ecotasa.required' => 'required|numeric',
            'fabricante.required' => 'required',
            'precio_baremo.required' => 'required|numeric',
            'descuento.required' => 'required|numeric',
            'precio_costoNeto.required' => 'required|numeric',
            'precio_venta.required' => 'required|numeric',
            'stock.required' => 'required|numeric',
        ]);

        // Guardar datos validados
        $productosSave = Productos::create($validatedData);

        // Alertas de guardado exitoso
        if ($productosSave) {
            $this->alert('success', '¡Produco registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del producto!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }



    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('productos.index');

    }

    public function precio_costo() 
    {
        $this->precio_costoNeto = $this->precio_baremo - $this->descuento;
    }

}
