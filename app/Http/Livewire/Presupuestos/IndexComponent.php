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
        $this->categorias = array_slice(Schema::getColumnListing($modelo->getTable()), 1, -3);
        
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
        $this->alert("Hola");
            if ($this->filtro_categoria == "" && $this->filtro_busqueda == "") {
                $this->presupuestos = Presupuesto::all();
            } else {
                    $this->presupuestos = Presupuesto::where('matricula', 'LIKE', '%' . $this->filtro_busqueda . '%')->get();
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
