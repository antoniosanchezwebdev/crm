<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\Compras;
use Livewire\Component;
use App\Models\Proveedores;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $identificador;
    public $dni;
    public $nombre;
    public $email;
    public $telefono;
    public $direccion;
    public $observaciones;
    public $compras;
    public $compraActual;
    public $productoId;
    public $cantidad;
    public $fechaPedido;
    public $fechaLlegada;
    public $archivo;

    public $isOpen = false;


    public function mount(){
        $proveedor = Proveedores::find($this->identificador);
        $this->compras = $proveedor->compras()->get();
        $this->dni = $proveedor->dni;
        $this->nombre = $proveedor->nombre;
        $this->direccion = $proveedor->direccion;
        $this->telefono = $proveedor->telefono;
        $this->email = $proveedor->email;
        }

    public function render()
    {

        return view('livewire.proveedores.edit-component');
    }



    public function update()
    {
        // Validación de datos
        $this->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'telefono' => 'required',
            'direccion' => 'required',
        ],
            // Mensajes de error
            [
                'dni.required' => 'El DNI es obligatorio.',
                'nombre.required' => 'El nombre es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
                'telefono.required' => 'El teléfono es obligatorio.',
                'direccion.required' => 'La dirección es obligatoria.',
            ]);

        // Guardar datos validados
        // Encuentra el alumno identificado
        $proveedor = Proveedores::find($this->identificador);

        // Guardar datos validados
        $proveedoresSave = $proveedor->update([
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'observaciones' => $this->observaciones,

        ]);

        // Alertas de guardado exitoso
        if ($proveedoresSave) {
            $this->alert('success', '¡Proveedor actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del proveedor!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    public function destroy(){
        // $product = Productos::find($this->identificador);
        // $product->delete();

        $this->alert('warning', '¿Seguro que desea borrar el proveedor? No hay vuelta atrás', [
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
        return redirect()->route('proveedores.index');

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $proveedor = Proveedores::find($this->identificador);
        $proveedor->delete();
        return redirect()->route('proveedores.index');

    }

    public function agregarCompraModal()
    {
        $this->isOpen = true;
        $this->resetInput();
    }
    private function resetInput()
    {
    $this->productoId = null;
    $this->cantidad = null;
    $this->fechaPedido = null;
    $this->fechaLlegada = null;
    $this->archivo = null;
    $this->compraActual = null;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInput();

    }

    public function guardarCompra()
    {
        $this->validate([
            'productoId' => 'required',
            'cantidad' => 'required|numeric',
            'fechaPedido' => 'required|date',
            'fechaLlegada' => 'nullable|date',
            'archivo' => 'nullable|file|max:10240' // 10MB Max
        ]);

        $compra = $this->compraActual ? Compras::find($this->compraActual) : new Compras;
        $compra->proveedores_id = $this->identificador;
        $compra->productos_id = $this->productoId;
        $compra->cantidad = $this->cantidad;
        $compra->fecha_pedido = $this->fechaPedido;
        $compra->fecha_llegada = $this->fechaLlegada;
        if ($this->archivo) {
            $compra->archivo_path = $this->archivo->store('archivos_compras', 'public');
        }
        $compra->save();

        $this->compras = Proveedores::find($this->identificador)->compras()->get();
        $this->closeModal();
        $this->resetInput();
    }

    public function editarCompra($compraId)
    {
        $compra = Compras::find($compraId);
        $this->compraActual = $compra->id;
        $this->productoId = $compra->productos_id;
        $this->cantidad = $compra->cantidad;
        $this->fechaPedido = $compra->fecha_pedido;
        $this->fechaLlegada = $compra->fecha_llegada;
        $this->archivo = null; // Reset archivo
        $this->isOpen = true;
    }
    public function eliminarCompra($compraId)
    {
        $compra = Compras::find($compraId);
        if ($compra->archivo_path) {
        Storage::delete($compra->archivo_path);
        }
        $compra->delete();
        $this->compras = Proveedores::find($this->identificador)->compras()->get();
    }
    public function descargarArchivo($compraId)
    {
        $compra = Compras::find($compraId);

        if ($compra && Storage::exists($compra->archivo_path)) {
            return response()->download(storage_path('public/' . $compra->archivo_path));
        } else {
            $this->alert('error', 'Archivo no encontrado o ha sido eliminado.');
        }
    }
}
