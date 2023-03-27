<?php

namespace App\Http\Livewire\Trabajadores;

use App\Models\Trabajador;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;

    public $nombre;


    public function mount()
    {
        $usuarios = Trabajador::find($this->identificador);

        $this->nombre = $usuarios->nombre;

    }

    public function render()
    {
        return view('livewire.trabajadores.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        // Validación de datos
        $this->validate([
            'nombre' => 'required',
        ],
            // Mensajes de error
            [
                'nombre.required' => 'El nombre es obligatorio.',
            ]);

        // Encuentra el identificador
        $usuarios = Trabajador::find($this->identificador);

        // Guardar datos validados
        $usuariosSave = $usuarios->update([
            'nombre' => $this->nombre,
        ]);

        if ($usuariosSave) {
            $this->alert('success', 'Usuario actualizado correctamente!', [
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

        session()->flash('message', 'Usuario actualizado correctamente.');

        $this->emit('userUpdated');
    }

      // Eliminación
      public function destroy(){

        $this->alert('warning', '¿Seguro que desea borrar el usuario? No hay vuelta atrás', [
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
        return redirect()->route('trabajadores.index');

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $usuarios = Trabajador::find($this->identificador);
        $usuarios->delete();
        return redirect()->route('trabajadores.index');

    }
}
