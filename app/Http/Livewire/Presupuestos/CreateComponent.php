<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Presupuesto;
use App\Models\Clients;
use App\Models\Trabajador;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Carbon\Carbon;

class CreateComponent extends Component
{

    use LivewireAlert;

    public $numero_presupuesto;
    public $fecha_emision;
    public $cliente_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $matricula;
    public $kilometros;
    public $trabajador_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $precio = 0;
    public $observaciones = "";

    public $stateCliente = 0; // Para mostrar los inputs del alumno o empresa


    public $clientes;
    public $trabajadores;
    
    public $clienteSeleccionado;
    public $trabajadorSeleccionado;


    public function mount(){
        $this->clientes = Clients::all(); // datos que se envian al select2
        $this->trabajadores = Trabajador::all(); // datos que se envian al select2

    }

    public function render()
    {
        return view('livewire.presupuestos.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate([
            'numero_presupuesto' => 'required',
            'fecha_emision' => 'required',
            'cliente_id' => 'required',
            'matricula' => 'required',
            'kilometros' => 'required',
            'trabajador_id' => 'required',
            'precio' => 'required',
            'observaciones' => 'required',

        ],
            // Mensajes de error
            [
                'numero_presupuesto' => 'El número de presupuesto es obligatorio.',
                'fecha_emision.required' => 'La fecha de emision es obligatoria.',
                'cliente_id.required' => 'El cliente es obligatorio.',
                'matricula.required' => 'La matricula del coche es obligatoria.',
                'kilometros.required' => 'Los kilometros del coche son obligatorios',
                'trabajador_id.required' => 'El trabajador es obligatorio.',
                'precio.required' => 'El precio es obligaorio',
                'observaciones.required' => 'La observación es obligatoria',
            ]);

        // Guardar datos validados
        $presupuesosSave = Presupuesto::create($validatedData);

        // Alertas de guardado exitoso
        if ($presupuesosSave) {
            $this->alert('success', '¡Presupuesto registrado correctamente!', [
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
    }

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'calcularPrecio',
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
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
