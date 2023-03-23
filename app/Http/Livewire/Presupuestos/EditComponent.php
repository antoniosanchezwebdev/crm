<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Presupuestos;
use App\Models\Cursos;
use App\Models\Alumno;
use App\Models\Empresa;
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
        $presupuestos = Presupuestos::find($this->identificador);

        $this->alumnosSinEmpresa = Alumno::where('empresa_id', 0)->get(); // datos que se envian al select2
        $this->alumnosConEmpresa = Alumno::where('empresa_id', '>', 0)->get();
        $this->cursos = Cursos::all(); // datos que se envian al select2


        $this->numero_presupuesto = $presupuestos->numero_presupuesto;
        $this->fecha_emision = $presupuestos->fecha_emision;
        $this->alumno_id = $presupuestos->alumno_id;
        $this->curso_id = $presupuestos->curso_id;
        $this->detalles = $presupuestos->detalles;
        $this->total_sin_iva = $presupuestos->total_sin_iva;
        $this->iva = $presupuestos->iva;
        $this->decuento = $presupuestos->decuento;
        $this->precio = $presupuestos->precio;
        $this->estado = $presupuestos->estado;
        $this->observaciones = $presupuestos->observaciones;

        // Si el alumno presupuestado tiene empresa, por defecto saldrá el form de empresa
        $alumnoPresupuestado = Alumno::where('id', $presupuestos->alumno_id)->first();
        if($alumnoPresupuestado->empresa_id > 0){
            $this->tipoCliente = 2;

        } else{
            $this->tipoCliente = 1;
        }

        // Se llama a las funciones que cambian los estados según los datos traidos
        $this->listarUsuario();
        $this->listarCurso();

    }

    public function render()
    {

        // $this->tipoCliente == 0;
        return view('livewire.presupuestos.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        // Validación de datos
        $this->validate([
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
        $presupuestos = Presupuestos::find($this->identificador);

        // Guardar datos validados
        $presupuestosSave = $presupuestos->update([
            'numero_presupuesto' => $this->numero_presupuesto,
            'fecha_emision' => $this->fecha_emision,
            'alumno_id' => $this->alumno_id,
            'curso_id' => $this->curso_id,
            'detalles' => $this->detalles,
            'precio' => $this->precio,
            'estado' => $this->estado,
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
        $presupuesto = Presupuestos::find($this->identificador);
        $presupuesto->delete();
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
            $this->precio = $this->cursoSeleccionado->precio;
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
