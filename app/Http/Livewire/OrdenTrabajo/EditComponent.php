<?php

namespace App\Http\Livewire\OrdenTrabajo;

use App\Models\Presupuesto;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Clients;
use App\Models\OrdenTrabajo;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Productos;
use App\Models\Trabajador;
use Livewire\WithFileUploads;


class EditComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $identificador;
    public $tarea;
    public $numero_presupuesto;
    public $users;
    public $fecha_emision;
    public $cliente_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $matricula;
    public $kilometros;
    public $trabajador_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $precio = 0;
    public $origen;
    public $observaciones = "";
    public $tiempo_lista = [];
    public $trabajadores_name = [];


    public $realizables = [];
    public $solicitados = [];
    public $daños = [];
    public $documentos = [];
    public $documento;

    public $rutasDocumentos = [];
    public $rutasDocumentosMostrar = [];


    public $lista = [];
    public $listaArticulos;

    public $trabajadorSeleccionado;
    public $trabajadores = [];

    public $nuevoRealizar;
    public $nuevoSolicitado;
    public $nuevoDaño;

    public $producto;
    public $productos;

    public $cantidad;
    public $clientes;


    public function mount()
    {
        $this->tarea = OrdenTrabajo::find($this->identificador);
        $this->users = User::all();
        $this->productos = Productos::all(); // datos que se envian al select2
        $this->clientes = Clients::all();
        $this->numero_presupuesto = $this->tarea->presupuesto->numero_presupuesto;
        $this->fecha_emision = $this->tarea->presupuesto->fecha_emision;
        $this->cliente_id = $this->tarea->presupuesto->cliente_id;
        $this->trabajador_id = $this->tarea->presupuesto->trabajador_id;
        $this->lista = (array) json_decode($this->tarea->presupuesto->listaArticulos);
        $this->kilometros = $this->tarea->presupuesto->kilometros;
        $this->matricula = $this->tarea->presupuesto->matricula;
        $this->precio = $this->tarea->presupuesto->precio;
        $this->origen = $this->tarea->presupuesto->origen;
        $this->observaciones = $this->tarea->presupuesto->observaciones;
    }

    public function render()
    {
        return view('livewire.orden-trabajo.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        // Validación de datos
        $this->validate(
            [
                'fecha' => 'required',
                'id_cliente' => 'required',
                'id_presupuesto' => 'required',
                'observaciones' => 'required',
                'trabajos_solicitados' => 'required',
                'trabajos_realizar' => 'required',
                'operarios' => 'required',
                'estado' => 'required',
                'descripcion' => 'required',
                'documentos' => 'required',
                'operarios_tiempo' => 'required',
                'danos_localizados' => 'required',

            ],
            // Mensajes de error
            [
                'numero_presupuesto.required' => 'El número de presupuesto es obligatorio.',
                'fecha_emision.required' => 'La fecha de emision es obligatoria.',
                'alumno_id.required' => 'El alumno es obligatorio.',
                'curso_id.required' => 'El curso es obligatorio.',
                'detalles.required' => 'Los detalles son obligatorios',
                'precio.required' => 'El precio es obligaorio',
                'estado.required' => 'El estado es obligatorio',
                'observaciones.required' => 'La observación es obligatoria',
            ]
        );

        // Encuentra el identificador
        $presupuestos = Presupuesto::find($this->identificador);

        // Guardar datos validados
        $presupuestosSave = $presupuestos->update([
            'numero_presupuesto' => $this->numero_presupuesto,
            'fecha_emision' => $this->fecha_emision,
            'cliente_id' => $this->cliente_id,
            'trabajador_id' => $this->trabajador_id,
            'matricula' => $this->matricula,
            'precio' => $this->precio,
            'origen' => $this->origen,
            'listaArticulos' => $this->listaArticulos,
            'kilometros' => $this->kilometros,
            'observaciones' => $this->observaciones,

        ]);

        if ($presupuestosSave) {
            $this->alert('success', '¡Presupuesto actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del presupuesto!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }

        session()->flash('message', 'Presupuesto actualizado correctamente.');

        $this->emit('productUpdated');
    }

    // Eliminación
    public function destroy()
    {

        $this->alert('warning', '¿Seguro que desea borrar el presupuesto? No hay vuelta atrás', [
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
        return redirect()->route('presupuestos.index');
    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $presupuesto = Presupuesto::find($this->identificador);
        $presupuesto->delete();
        return redirect()->route('presupuestos.index');
    }

    public function agregarSolicitado()
    {
        array_push($this->solicitados, $this->nuevoSolicitado);
        $this->nuevoSolicitado = '';
    }
    public function agregarRealizar()
    {
        array_push($this->realizables, $this->nuevoRealizar);
        $this->nuevoRealizar = '';
    }

    public function numeroPresupuesto()
    {
        $fecha = new Carbon($this->fecha_emision);
        $year = $fecha->year;
        $presupuestos = Presupuesto::all();
        $contador = 1;
        foreach ($presupuestos as $presupuesto) {
            $fecha2 = new Carbon($presupuesto->fecha_emision);
            $year2 = $fecha2->year;
            if ($year == $year2) {
                if ($fecha->gt($fecha2)) {
                    $contador++;
                }
            }
        }

        if ($contador < 10) {
            $this->numero_presupuesto = "0" . $contador . "/" . $year;
        } else {
            $this->numero_presupuesto = $contador . "/" . $year;
        }
    }

    public function añadirProducto()
    {
        if ($this->producto != null) {
            if (isset($this->lista[$this->producto])) {
                $this->lista[$this->producto] += $this->cantidad;
            } else {
                $this->lista[$this->producto] = $this->cantidad;
            }
            $this->precio += ((Productos::where('id', $this->producto)->first()->precio_venta) * $this->cantidad);
            $this->producto = "";
            $this->cantidad = 0;
        }
    }

    public function agregarDaño()
    {
        array_push($this->daños, $this->nuevoDaño);
        $this->nuevoDaño = '';
    }

    public function subirArchivo()
    {
        foreach ($this->documentos as $documento) {
            $this->documento = $documento;
            $this->validate([
                'documento' => 'file|max:10000',
            ]);

            $nombreDelArchivo = time() . '_' . $this->documento->getClientOriginalName();
            $rutaDocumento = $this->documento->storeAs('documentos', $nombreDelArchivo, 'public');

            // Agrega la ruta del archivo al array de rutas de documentos
            $this->rutasDocumentos[] = $rutaDocumento;

            $this->documento = "";
        }

        $this->documentos = [];
    }

    public function agregarTrabajador()
    {
        if (in_array($this->trabajadorSeleccionado, $this->trabajadores)) {
            $this->alert('warning', "Este trabajador ya está asignado");
        } else {
            if ($this->trabajadorSeleccionado == Auth::id()) {
                array_push($this->trabajadores, Auth::id());
                array_push($this->trabajadores_name, Auth::user());
            } else {
                array_push($this->trabajadores, $this->trabajadorSeleccionado);
                array_push($this->trabajadores_name, $this->users->find($this->trabajadorSeleccionado));
            }
        }
        $this->trabajadorSeleccionado = "";
    }

    public function reducir()
    {
        if (isset($this->lista[$this->producto])) {
            if ($this->lista[$this->producto] - $this->cantidad <= 0) {
                $this->precio -= ((Productos::where('id', $this->producto)->first()->precio_venta) * $this->lista[$this->producto]);
                unset($this->lista[$this->producto]);
            } else {
                $this->lista[$this->producto] -= $this->cantidad;
                $this->precio -= ((Productos::where('id', $this->producto)->first()->precio_venta) * $this->cantidad);
            }
        } else {
            $this->alert('warning', "Este producto no está en la lista");
        }
        $this->producto = "";
        $this->cantidad = 0;
    }
}
