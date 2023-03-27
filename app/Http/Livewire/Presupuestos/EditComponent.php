<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Presupuesto;
use Carbon\Carbon;
use App\Models\Clients;
use App\Models\Trabajador;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;

    public $numero_presupuesto;

    public $fecha_emision;
    public $cliente_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $matricula;
    public $kilometros;
    public $trabajador_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $precio = 0;
    public $estado;
    public $observaciones = "";

    public $clientes;
    public $trabajadores;

    public $tipoCliente; // Se usa para generar factura de cliente o particular
    public $stateAlumno = 0; // Para mostrar los inputs del alumno o empresa
    public $stateCurso = 0; // Para mostrar los inputs del alumno o empresa

    public $clienteSeleccionado;
    public $trabajadorSeleccionado;


    public function mount()
    {
        $presupuestos = Presupuesto::find($this->identificador);
        $this->clientes = Clients::all(); // datos que se envian al select2
        $this->trabajadores = Trabajador::all(); // datos que se envian al select2

        $this->numero_presupuesto = $presupuestos->numero_presupuesto;
        $this->fecha_emision = $presupuestos->fecha_emision;
        $this->cliente_id = $presupuestos->cliente_id;
        $this->trabajador_id = $presupuestos->trabajador_id;
        $this->kilometros = $presupuestos->kilometros;
        $this->matricula = $presupuestos->matricula;
        $this->precio = $presupuestos->precio;
        $this->observaciones = $presupuestos->observaciones;

    }

    public function render()
    {
        return view('livewire.presupuestos.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        // Validación de datos
        $this->validate([
            'numero_presupuesto' => 'required',
            'fecha_emision' => 'required',
            'cliente_id' => 'required',
            'trabajador_id' => 'required',
            'matricula' => 'required',
            'precio' => 'required',
            'kilometros' => 'required',
            'observaciones' => 'required',
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
            ]);

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
      public function destroy(){

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

    public function listarCliente(){
        if ($this->cliente_id != null) {
            $this->stateCliente = 1;
            $this->clienteSeleccionado = Clients::where('id', $this->cliente_id)->first();
        }else {
            $this->stateCliente = 0;
            $this->clienteSeleccionado = [];
        }

    }

    public function listarTrabajador(){


        if ($this->trabajador_id != null) {
            $this->stateTrabajador = 1;
            $this->trabajadorSeleccionado = Clients::where('id', $this->cliente_id)->first();
        }else {
            $this->stateTrabajador = 0;
            $this->trabajadorSeleccionado = [];
        }


    }

    public function numeroPresupuesto(){
        $fecha = new Carbon($this->fecha_emision);
        $year = $fecha->year;
        $presupuestos = Presupuesto::all();
        $contador = 1;
        foreach($presupuestos as $presupuesto){
            $fecha2 = new Carbon($presupuesto->fecha_emision);
            $year2 = $fecha2->year;
            if($year == $year2){
                $contador++;
            }
        }
        
        if($contador < 10){
            $this->numero_presupuesto = "0" . $contador . "/" . $year;
        } else{
            $this->numero_presupuesto = $contador . "/" . $year;
        }
    }
}
