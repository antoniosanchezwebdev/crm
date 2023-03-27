<?php

namespace App\Http\Livewire\Trabajadores;

use App\Models\Trabajador;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateComponent extends Component
{

    use LivewireAlert;

    public $nombre;


    public function mount(){
    }

    public function render()
    {
        return view('livewire.trabajadores.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate([
            'nombre' => 'required',

        ],
            // Mensajes de error
            [
                'nombre.required' => 'El nombre es obligatorio.',
            ]);

        // Guardar datos validados
        $usuariosSave = Trabajador::create($validatedData);

        // Alertas de guardado exitoso
        if ($usuariosSave) {
            $this->alert('success', '¡Usuario registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del usuario!', [
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
        return redirect()->route('trabajadores.index');

    }
}
