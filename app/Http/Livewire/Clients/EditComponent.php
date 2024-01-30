<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\Clients;
use App\Models\Vehiculo;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;
    public $dni;
    public $nombre;
    public $email;
    public $telefono;
    public $direccion;
    public $observaciones;
    public $vehiculos = [];

    public function mount(){
        $cliente = Clients::with('vehiculos')->find($this->identificador);

        $this->dni = $cliente->dni;
        $this->nombre = $cliente->nombre;
        $this->direccion = $cliente->direccion;
        $this->telefono = $cliente->telefono;
        $this->email = $cliente->email;
        $this->observaciones = $cliente->observaciones;
        $this->vehiculos = $cliente->vehiculos->toArray();
    }

    public function render()
    {
        
        return view('livewire.clients.edit-component');
    }

    public function addVehiculo()
    {
        $this->vehiculos[] = ['matricula' => '', 'kilometros' => '', 'vehiculo_renting' => '', 'modelo' => '', 'marca' => ''];
    }

    public function removeVehiculo($index)
    {
        unset($this->vehiculos[$index]);
        $this->vehiculos = array_values($this->vehiculos);
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
        $cliente = Clients::find($this->identificador);

        // Guardar datos validados
        $clientesSave = $cliente->update([
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'observaciones' => $this->observaciones,

        ]);

        foreach ($this->vehiculos as $vehiculoData) {
            if (isset($vehiculoData['id'])) {
                $vehiculoData['vehiculo_renting'] = $vehiculoData['vehiculo_renting'] === 'true' ? true : false;
                Vehiculo::find($vehiculoData['id'])->update($vehiculoData);
            } else {
                $vehiculoData['vehiculo_renting'] = $vehiculoData['vehiculo_renting'] === 'true' ? true : false;
                $cliente->vehiculos()->create($vehiculoData);
            }
        }

        // Alertas de guardado exitoso
        if ($clientesSave) {
            $this->alert('success', '¡Cliente actualizado correctamente!', [
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

    public function destroy(){

        $this->alert('warning', '¿Seguro que desea borrar el cliente? No hay vuelta atrás', [
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
        return redirect()->route('clients.index');

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $cliente = Clients::find($this->identificador);

        // Primero, verifica si el cliente existe
        if ($cliente) {
            // Eliminar todos los vehículos asociados con el cliente
            foreach ($cliente->vehiculos as $vehiculo) {
                $vehiculo->delete();
            }
    
            // Después de eliminar los vehículos, elimina el cliente
            $cliente->delete();
        }
    
        return redirect()->route('clients.index');

    }
}
