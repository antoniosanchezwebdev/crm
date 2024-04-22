<?php

namespace App\Http\Livewire\Facturas;

use App\Models\{Facturas,Clients , Presupuesto, OrdenTrabajo, Productos, Neumatico, Reserva, Almacen};
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacturaMail;
use Livewire\Component;
use Livewire\Livewire;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;
    public $numero_factura, $id_presupuesto, $fecha_emision, $fecha_vencimiento, $descripcion, $estado, $metodo_pago;
    public $tipo_documento, $precio, $precio_iva, $documentos, $observaciones;
    public $presupuestos,$presupuestosSeleccionables, $listaPresupuestos = [];
    public $clienteId = null;

    public function mount()
    {
        $factura = Facturas::find($this->identificador);
        $this->presupuestos = Presupuesto::all();
        $this->presupuestosSeleccionables = Presupuesto::all();
        $this->loadFacturaDetails($factura);
    }

    public function render()
    {
        return view('livewire.facturas.edit-component', [
            'presupuestos' => $this->presupuestos,
        ]);
    }

    private function loadFacturaDetails($factura)
    {
        $this->numero_factura = $factura->numero_factura;
        $this->id_presupuesto = $factura->id_presupuesto;
        $this->fecha_emision = $factura->fecha_emision;
        $this->fecha_vencimiento = $factura->fecha_vencimiento;
        $this->descripcion = $factura->descripcion;
        $this->estado = $factura->estado;
        $this->metodo_pago = $factura->metodo_pago;
        $this->tipo_documento = $factura->tipo_documento;
        $this->precio = $factura->precio;
        $this->precio_iva = $factura->precio_iva;
        if ($this->tipo_documento == 'albaran_credito') {
            $this->listaPresupuestos = json_decode($factura->id_presupuesto, true);
            $presu = $this->listaPresupuestos[0];
            $this->clienteId =  $this->presupuestos->find($presu);
            if ($this->clienteId) {
                // Filter presupuestos to those that have the same cliente_id
                $this->presupuestosSeleccionables = Presupuesto::where('cliente_id', $this->clienteId)
                ->where('estado','Pendiente')
                ->get();
            } else {
                $this->presupuestosSeleccionables = Presupuesto::where('estado','Pendiente')->get();
            }
        }

    }

    // Al hacer update en el formulario
    public function update()
    {
        if ($this->tipo_documento == 'albaran_credito') {
            $this->id_presupuesto = json_encode($this->listaPresupuestos);
        }
        $validatedData = $this->validate([
            'numero_factura' => 'required',
            'id_presupuesto' => 'required',
            'fecha_emision' => 'required',
            'fecha_vencimiento' => 'nullable',
            'tipo_documento' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required',
            'precio' => 'required',
            'precio_iva' => 'required',
            'metodo_pago' => 'nullable',

        ]);


        $factura = Facturas::find($this->identificador);
        $updateSuccess = $factura->update($validatedData);

        if ($updateSuccess) {
            $this->alert('success', 'Factura actualizada correctamente!',[
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'Aceptar',
                'showDenyButton' => false,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido actualizar la factura!');
        }
    }

    public function addPresupuesto()
    {
        if (!in_array($this->id_presupuesto, $this->listaPresupuestos)) {
            array_push($this->listaPresupuestos, $this->id_presupuesto);

            // Set clienteId if it's not already set
            if (is_null($this->clienteId)) {
                $presupuesto = Presupuesto::find($this->id_presupuesto);
                $this->clienteId = $presupuesto->cliente_id;
                $this->loadPresupuestos(); // Reload presupuestos based on cliente_id
            }

            $this->id_presupuesto = 0; // Reset the current selection
        }
        $this->addPrecio();
    }
      // Eliminación
      public function destroy(){

        $this->alert('warning', '¿Seguro que desea borrar el la factura? No hay vuelta atrás', [
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
            'listarPresupuesto',
            'confirmDelete',
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('facturas.index' , ['tab' => 'tab1']);

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $factura = Facturas::find($this->identificador);

        if ($factura->tipo_documento == 'albaran_credito') {
            foreach ($this->listaPresupuestos as $presupuestos) {
                $this->presupuestos->where('id', $presupuestos)->first()->update([
                    'estado' => 'Pendiente'
                ]);
            }

        } else {
            $this->presupuestos->where('id', $this->id_presupuesto)->first()->update([
                'estado' => 'Pendiente'
            ]);
        }
        $factura->delete();

        return redirect()->route('facturas.index', ['tab' => 'tab1']);
    }

    public function addPrecio()
    {
        $this->precio =0;
        if ($this->tipo_documento == 'factura') {
            if ($this->id_presupuesto > 0) {
                $this->precio = $this->presupuestos->where('id', $this->id_presupuesto)->first()->precio;
                $this->precio_iva = round(($this->precio) + ($this->precio * 0.21), 2);
            }
        } else {
            foreach ($this->listaPresupuestos as $presupuesto) {
                $this->precio += $this->presupuestos->where('id', $presupuesto)->first()->precio;
            }
            $this->precio_iva = round(($this->precio) + ($this->precio * 0.21), 2);
        }
    }

    public function addDocumentos()
    {
        if ($this->tipo_documento == 'factura') {
            $this->documentos = json_decode($this->tareas->where('id_presupuesto', $this->id_presupuesto)->first()->documentos, true);
        } else {
            $this->documentos = [];
            foreach ($this->listaPresupuestos as $presupuesto) {
                $this->documentos = array_merge($this->documentos, json_decode($this->tareas->where('id_presupuesto', $presupuesto)->first()->documentos, true));
            }
        }
    }

    public function CrearPdf($factura)
    {
        $tipoDocumento = $factura->tipo_documento;
        $productos = Productos::all();
        $lista = [];

        if ($tipoDocumento == 'albaran_credito') {
            $idsPresupuesto = json_decode($factura->id_presupuesto);
            $presupuestos = Presupuesto::whereIn('id', $idsPresupuesto)->get();
            foreach ($presupuestos as $presupuesto) {
                $listaArticulos = (array) json_decode($presupuesto->listaArticulos, true);
                foreach ($listaArticulos as $productoID => $pCantidad) {
                    if (!array_key_exists($productoID, $lista)) {
                        $lista[$productoID] = 0;
                    }
                    $lista[$productoID] += $pCantidad;
                }
            }
        } else {
            $presupuesto = Presupuesto::findOrFail($factura->id_presupuesto);
            $lista = (array) json_decode($presupuesto->listaArticulos, true);
        }

        $cliente = Clients::findOrFail($presupuesto->cliente_id); // Asumiendo que cliente_id es uniforme en todos los presupuestos

        // Cargar la vista adecuada y pasar los datos necesarios
        $pdf = PDF::loadView('livewire.facturas.pdf-component', compact('factura', 'presupuestos', 'cliente', 'lista', 'productos', 'tipoDocumento'));

        // Devolver el PDF para descargar con un nombre de archivo personalizado
        return $pdf;
    }

    public function mandarMail($id)
    {
        $factura = Facturas::findOrFail($id);
        if($factura->tipo_documento == 'albaran_credito'){
            $id_presup=json_decode($factura->id_presupuesto)[0];
        }else{
            $id_presup=$factura->id_presupuesto;
        }
        $presupuesto = Presupuesto::findOrFail($id_presup);
        $cliente = Clients::findOrFail($presupuesto->cliente_id);
        $pdf = $this->CrearPdf($factura); // Asumiendo que existe un método para generar el PDF

        $enviado = Mail::to($cliente->email)->send(new FacturaMail($factura, $pdf,$cliente));

        if(isset( $enviado)){
        $this->alert('success', 'Factura enviada correctamente!',[
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'Aceptar',
            'showDenyButton' => false,
        ]);
        } else {
            $this->alert('error', '¡No se ha podido enviadar la factura!',[
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'Aceptar',
                'showDenyButton' => false,
            ]);
        }

    }
}
