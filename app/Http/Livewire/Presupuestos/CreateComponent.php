<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Presupuesto;
use App\Models\Clients;
use App\Models\Trabajador;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Productos;

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

    public $origen;

    public $clientes;
    public $trabajadores;
    public $productos;

    public $lista = [];
    public $listaArticulos;

    public $clienteSeleccionado;
    public $trabajadorSeleccionado;
    public $producto;
    public $cantidad;


    public function mount()
    {
        $this->clientes = Clients::all(); // datos que se envian al select2
        $this->trabajadores = Trabajador::all(); // datos que se envian al select2
        $this->productos = Productos::all();
        $this->añadirProducto();
        $this->reducir();

    }

    public function render()
    {
        return view('livewire.presupuestos.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        foreach ($this->lista as $pro => $cantidad) {
            $articulo = Productos::where('id', $pro)->first();
            $articulo->update([
                'stock' => ($articulo->stock -= $cantidad),
            ]);

        }
        $this->listaArticulos = json_encode($this->lista);

        // Validación de datos
        $validatedData = $this->validate(
            [
                'numero_presupuesto' => 'required',
                'fecha_emision' => 'required',
                'cliente_id' => 'required',
                'matricula' => 'required',
                'kilometros' => 'required',
                'trabajador_id' => 'required',
                'listaArticulos' => 'required',
                'precio' => 'required',
                'origen' => 'required',
                'observaciones' => 'required',

            ],
            // Mensajes de error
            [
                'numero_presupuesto.required' => 'El número de presupuesto es obligatorio.',
                'fecha_emision.required' => 'La fecha de emision es obligatoria.',
                'cliente_id.required' => 'El cliente es obligatorio.',
                'matricula.required' => 'La matricula del coche es obligatoria.',
                'kilometros.required' => 'Los kilometros del coche son obligatorios',
                'trabajador_id.required' => 'El trabajador es obligatorio.',
                'precio.required' => 'El precio es obligatorio',
                'observaciones.required' => 'La observación es obligatoria',
            ]
        );

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
            'listarCliente',
            'listarTrabajador',
            'numeroPresupuesto',
            'añadirProducto',
            'reducir',
            'precioFinal',
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('presupuestos.index');

    }

    public function listarCliente()
    {
        if ($this->cliente_id != null) {
            $this->clienteSeleccionado = Clients::where('id', $this->cliente_id)->first();
        } else {
            $this->clienteSeleccionado = [];
        }

    }

    public function listarTrabajador()
    {
        if ($this->trabajador_id != null) {
            $this->trabajadorSeleccionado = Clients::where('id', $this->trabajador_id)->first();
        } else {
            $this->trabajadorSeleccionado = [];
        }


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
            if (Productos::where('id', $this->producto)->first()->stock > 0) {
                    if (Productos::where('id', $this->producto)->first()->stock - $this->cantidad >= 0) {
                    if (isset($this->lista[$this->producto])) {
                        $this->lista[$this->producto] += $this->cantidad;
                    } else {
                        $this->lista[$this->producto] = $this->cantidad;
                    }
                    $this->precio += ((Productos::where('id', $this->producto)->first()->precio_venta) * $this->cantidad);
                    $this->producto = "";
                    $this->cantidad = 0;
                } else{
                    $this->alert('warning', "¡Cantidad de productos por encima del stock!");
                }
            } else {
                $this->alert('warning', "Producto sin stock!");
            }
        }

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