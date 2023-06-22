<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Trabajador;
use App\Models\Clients;
use App\Models\Presupuesto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class IndexComponent extends Component
{
    use LivewireAlert;
    public $presupuestos;
    public $clientes;
    public $trabajadores;

    public $filtro_busqueda = "";
    public $filtro_categoria = "";

    public $categorias;

    public $pagina;
    public $porPagina = 10;
    protected $tabla;

    protected $listeners = ['refreshComponent' => '$refresh'];


    public function mount()
    {
        $modelo = new Presupuesto;
        $this->presupuestos = Presupuesto::all();
        $this->clientes = Clients::all();
        $this->trabajadores = Trabajador::all();
        $this->categorias = [
            'numero_presupuesto' => "Número de presupuesto",
            'fecha_emision' => "Fecha de emisión",
            'cliente_id' => "ID de cliente",
            'nombre_cliente' => "Nombre de cliente",
            'estado' => "Estado",
            'matricula' => "Matricula",
            'kilometros' => "Kilometros",
            'trabajador_id' => "ID de trabajador",
            'precio' => "Importe total"
        ];

    }

    public function seleccionarProducto($id)
    {
        $this->emit("seleccionarProducto", $id);
    }

    public function render()
    {
        $this->tabla = $this->pagination($this->presupuestos);
        return view('livewire.presupuestos.index-component',[
            'tabla' => $this->tabla,
        ]);
    }

    /**
     * @return void
     */
    public function filtroCat()
    {
            if ($this->filtro_categoria != "" && $this->filtro_busqueda != "") {
                $this->alert('warning', "Hola");
                $this->presupuestos = Presupuesto::where($this->filtro_categoria, 'LIKE', '%' . $this->filtro_busqueda . '%')->get();
            } else {
                $this->presupuestos = Presupuesto::all();
            }

        $this->tabla = $this->pagination($this->presupuestos);
        $this->emit("refreshComponent");
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

}
