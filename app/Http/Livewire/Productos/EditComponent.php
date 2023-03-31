<?php

namespace App\Http\Livewire\Productos;

use App\Models\Productos;
use App\Models\ProductosCategories;
use App\Models\TipoProducto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;
    public $tipos_producto;
    public $categorias;
    public $cod_producto;
    public $descripcion;
    public $nombre;
    public $tipo_producto;
    public $ecotasa;
    public $fabricante;
    public $etiquetado_eu;
    public $estado;
    public $categoria_id;
    public $precio_baremo;
    public $descuento;
    public $precio_costoNeto;
    public $precio_venta;
    public $stock = "1";

    public function mount()
    {
        $product = Productos::find($this->identificador);
        $this->cod_producto = $product->cod_producto;
        $this->descripcion = $product->descripcion;
        $this->nombre = $product->nombre;
        $this->tipo_producto = $product->tipo_producto;
        $this->ecotasa = $product->ecotasa;
        $this->fabricante = $product->fabricante;
        $this->etiquetado_eu = $product->etiquetado_eu;
        $this->estado = $product->estado;
        $this->categoria_id = $product->categoria_id;
        $this->precio_baremo = $product->precio_baremo;
        $this->descuento = $product->descuento;
        $this->precio_costoNeto = $product->precio_costoNeto;
        $this->precio_venta = $product->precio_venta;
        $this->stock = $product->stock;
        $this->categorias = ProductosCategories::all();
        $this->tipos_producto = TipoProducto::all();
    }

    public function render()
    {
        return view('livewire.productos.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        // Validación de datos
        $this->validate([
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

        // Encuentra el producto identificado
        $product = Productos::find($this->identificador);

        // Guardar datos validados
        $productSave = $product->update([
            'cod_producto' => $this->cod_producto,
            'descripcion' => $this->descripcion,
            'tipo_producto' => $this->tipo_producto,
            'ecotasa' => $this->ecotasa,
            'fabricante' => $this->fabricante,
            'etiquetado_eu' => $this->etiquetado_eu,
            'estado' => $this->estado,
            'categoria_id' => $this->categoria_id,
            'precio_baremo' => $this->precio_baremo,
            'descuento' => $this->descuento,
            'precio_costoNeto' => $this->precio_costoNeto,
            'precio_venta' => $this->precio_venta,
            'stock' => $this->stock,
        ]);

        if ($productSave) {
            $this->alert('success', '¡Producto actualizado correctamente!', [
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

        session()->flash('message', 'Product updated successfully.');

        $this->emit('productUpdated');
    }

      // Elimina el producto
      public function destroy(){
        // $product = Productos::find($this->identificador);
        // $product->delete();

        $this->alert('warning', '¿Seguro que desea borrar el producto? No hay vuelta atrás', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmDelete',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);

    }

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'confirmDelete'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('productos.index');

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $product = Productos::find($this->identificador);
        $product->delete();
        return redirect()->route('productos.index');

    }

    public function precio_costo() 
    {
        $this->precio_costoNeto = $this->precio_baremo - $this->descuento;
    }
}
