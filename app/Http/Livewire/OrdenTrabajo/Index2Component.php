<?php

namespace App\Http\Livewire\OrdenTrabajo;

use App\Models\OrdenTrabajo;
use App\Models\Trabajador;
use App\Models\Clients;
use App\Models\Presupuesto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Mail\AvisoMail;
use App\Models\Vehiculo;

class Index2Component extends Component
{
    use LivewireAlert;

    // public $search;
    public $tareas;
    public $tareaSel;
    public $tareaMostrar;
    public $clientes;
    public $trabajadores;
    public $tipo_producto;
    public $pagina;
    public $porPagina = 10;
    protected $tabla;
    public $presupuestoId ;

    public function mount()
    {
        $this->tareas = OrdenTrabajo::where('operarios', '!=' , null)->get();
        $this->clientes = Clients::all();
        $this->trabajadores = User::all();
        if(count($this->tareas) > 0){
            $this->tareaSel = $this->tareas->last()->id;
        }    }

    public function select_producto()
    {
        if ($tipo_producto =! ""){
        $this->tareas = OrdenTrabajo::where('operarios', '!=' , null)->where('estado',$this->tipo_producto)->get();
        }else{
            $this->tareas = OrdenTrabajo::where('operarios', '!=' , null)->get();
        }
        $this->emitSelf('refreshComponent');
    }
    public function seleccionarProducto($id)
    {
        $this->emit("seleccionarProducto", $id);
    }


    public function render()
    {
        $this->tareaMostrar = $this->tareas->find($this->tareaSel);
        return view('livewire.orden-trabajo.index2-component');
    }

    public function pagination(Collection $data)
    {
        $items = $data->forPage($this->pagina, $this->porPagina);
        $totalResults = $data->count();

        return new LengthAwarePaginator(
            $items,
            $totalResults,
            $this->porPagina,
            $this->pagina,
            // Esta parte (options) la copie de lo que hace por defecto el paginador de Laravel haciendo un dd()
            [
                'path' => url()->current(),
                'pageName' => 'pagina',
            ]
        );
    }
    public function emailCompletado($id){

        $this->presupuestoId = $id;
        $this->alert('info', 'Esta apunto de avisar via email al cliente que su coche esta listo', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'mail',
            'confirmButtonText' => 'Continuar',
            'showDenyButton' => true,
            'denyButtonText' => 'Cancelar',
        ]);

    }
    public function getListeners()
    {
        return [
            'mail',
            'refreshComponent' => '$refresh',
            'emailCompletado'
        ];
    }

    public function mail()
    {
        // Asumiendo que $id es el ID del presupuesto correcto.
        $presupuesto = Presupuesto::findOrFail($this->presupuestoId);
        $cliente = Clients::findOrFail($presupuesto->cliente_id);
        $vehiculo = Vehiculo::where('matricula', $presupuesto->matricula)->first();

        // Verificar que se tiene un cliente y un vehículo antes de intentar enviar el correo.
        if (!$cliente || !$vehiculo) {
            $this->alert('error', '¡Cliente o vehículo no encontrado!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'Aceptar',
                'showDenyButton' => false,
            ]);
            return;
        }

        // Intentar enviar el correo y manejar el resultado.
        try {
            Mail::to($cliente->email)->send(new AvisoMail($cliente, $vehiculo));
            $this->alert('success', 'Mail enviado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'Aceptar',
                'showDenyButton' => false,
            ]);
        } catch (\Exception $e) {
            $this->alert('error', '¡No se ha podido enviar el mail! ' . $e->getMessage(), [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'Aceptar',
                'showDenyButton' => false,
            ]);
        }
        $this->presupuestoId = null;
    }

}
