<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Presupuestos;
use App\Models\Cursos;
use App\Models\Alumno;
use App\Models\Empresa;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateComponent extends Component
{

    use LivewireAlert;

    public $numero_presupuesto;
    public $fecha_emision;
    public $alumno_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $curso_id = 0; // 0 por defecto por si no se selecciona ninguna
    public $detalles;
    public $total_sin_iva;
    public $iva = 21;
    public $descuento = 0;
    public $precio;
    public $estado;
    public $observaciones = "";

    public $alumnosSinEmpresa;
    public $alumnosConEmpresa;
    public $cursos;

    public $tipoCliente; // Se usa para generar factura de cliente o particular
    public $stateAlumno = 0; // Para mostrar los inputs del alumno o empresa
    public $stateCurso = 0; // Para mostrar los inputs del alumno o empresa

    public $alumnoSeleccionado;
    public $empresaDeAlumno;
    public $cursoSeleccionado;

    public function mount(){
        $this->alumnosSinEmpresa = Alumno::where('empresa_id', 0)->get(); // datos que se envian al select2
        $this->alumnosConEmpresa = Alumno::where('empresa_id', '>', 0)->get();
        $this->cursos = Cursos::all(); // datos que se envian al select2

    }

    public function render()
    {
        $this->tipoCliente == 0;
        return view('livewire.presupuestos.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate([
            'numero_presupuesto' => 'required',
            'fecha_emision' => 'required',
            'alumno_id' => 'required',
            'curso_id' => 'required',
            'detalles' => 'required',
            'total_sin_iva' => '',
            'iva' => '',
            'descuento' => '',
            'precio' => 'required',
            'estado' => 'required',
            'observaciones' => '',

        ],
            // Mensajes de error
            [
                'numero_presupuesto' => 'El número de presupuesto es obligatorio.',
                'fecha_emision.required' => 'La fecha de emision es obligatoria.',
                'alumno_id.required' => 'El alumno es obligatorio.',
                'curso_id.required' => 'El curso es obligatorio.',
                'detalles.required' => 'Los detalles son obligatorios',
                'total_sin_iva.required' => '',
                'iva.required' => '',
                'descuento.required' => '',
                'precio.required' => 'El precio es obligaorio',
                'estado.required' => 'El estado es obligatorio',
                'observaciones.required' => 'La observación es obligatoria',
            ]);

        // Guardar datos validados
        $presupuesosSave = Presupuestos::create($validatedData);

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

    // Función que cambia el estado si hay un usuario seleccionado
    public function listarUsuario(){
        if ($this->alumno_id != null) {
            $this->stateAlumno = 1;
            $this->alumnoSeleccionado = Alumno::where('id', $this->alumno_id)->first();

            if ($this->alumnoSeleccionado->empresa_id > 0){
                $this->empresaDeAlumno = Empresa::where('id', $this->alumnoSeleccionado->empresa_id)->first();
            }

        }else {
            $this->stateAlumno = 0;
            $this->alumnoSeleccionado = [];
        }
    }

    // Función que cambia el estado si hay un usuario seleccionado
    public function listarCurso(){

        if ($this->curso_id != null) {
            $this->stateCurso = 1;
            $this->cursoSeleccionado = Cursos::where('id', $this->curso_id)->first();
            $this->total_sin_iva = $this->cursoSeleccionado->precio;
        }else {
            $this->stateCurso = 0;
            $this->cursoSeleccionado = [];
        }
        $this->calcularPrecio();

    }

    // Calcula el precio total, con el descuento
    public function calcularPrecio(){
        if($this->descuento < 0 || $this->descuento > 100 || $this->descuento == null){
            $this->descuento = 0;
        }
        $iva = $this->iva / 100;
        $descuento = $this->descuento / 100;
        $precioSinIva = $this->total_sin_iva * (1 - $descuento);
        $precio = $precioSinIva * (1 + $iva);
        $this->precio = round($precio, 2);
}
}
