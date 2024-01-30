<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Clients;
use App\Models\Vehiculo;

class CreateComponent extends Component
{
    use LivewireAlert;

    public $dni;
    public $nombre;
    public $email;
    public $telefono;
    public $direccion;
    public $observaciones;
    public $vehiculos = [];

    public function mount(){
        $this->vehiculos[] = ['matricula' => '', 'kilometros' => '', 'vehiculo_renting' => '0', 'modelo' => '', 'marca' => ''];
    }

    // Renderizado del Componente
    public function render()
    {
        return view('livewire.clients.create-component');
    }

    public function addVehiculo()
    {
        $this->vehiculos[] = ['matricula' => '', 'kilometros' => '', 'vehiculo_renting' => '0', 'modelo' => '', 'marca' => ''];
    }


    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'telefono' => 'required',
            'direccion' => 'required',
        ],
            // Mensajes de error
            [
                'dni.required' => 'El dni es obligatorio.',
                'nombre.required' => 'El nombre es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
                'telefono.required' => 'El teléfono es obligatorio.',
                'direccion.required' => 'La dirección es obligatoria.',
            ]);

        // Guardar datos validados
        $clientesSave = Clients::create($validatedData);

        foreach ($this->vehiculos as $vehiculoData) {
            $clientesSave->vehiculos()->create($vehiculoData);}
        // Alertas de guardado exitoso
        if ($clientesSave) {
            $this->alert('success', '¡Cliente registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del cliente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    public function getListeners()
    {
        return [
            'confirmed'
        ];
    }

    public function confirmed()
    {
        return redirect()->route('clients.index');
    }

}
