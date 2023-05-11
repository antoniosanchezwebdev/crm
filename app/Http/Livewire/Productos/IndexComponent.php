<?php

namespace App\Http\Livewire\Productos;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Productos;
use App\Models\Neumatico;
use App\Models\Almacen;
use App\Models\ListaAlmacen;
use App\Models\TipoProducto;
use App\Models\ProductosCategories;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PDF;

/**
 * Summary of IndexComponent
 */
class IndexComponent extends Component
{
    use LivewireAlert;
    public $tipos_producto;
    public $categorias;
    public $tipo_producto = "";

    public $busqueda_res_rod = "";

    public $busqueda_ag_moj = "";

    public $busqueda_em_ruido = "";
    public $busqueda_ancho = "";

    public $busqueda_serie = "";

    public $busqueda_llanta = "";
    public $busqueda_ic = "";

    public $busqueda_cv = "";
    public $busqueda_categoria = "";

    public $productos;
    public $neumaticos;
    public $almacenes;
    public $listAlmacenes;


    public $pagina;
    protected $tabla;
    public $porPagina = 10;

    protected $listeners = ['refreshComponent' => '$refresh'];


    public function mount()
    {
        $this->categorias = ProductosCategories::all();
        $this->tipos_producto = TipoProducto::all();
        $this->neumaticos = Neumatico::all();
        $this->productos = Productos::all();
        $this->almacenes = Almacen::all();
        $this->listAlmacenes = ListaAlmacen::all();
    }
    public function render()
    {
        $this->tabla = $this->pagination($this->productos);
        return view('livewire.productos.index-component', [
            'tabla' => $this->tabla
        ]);

    }


    /**
     * @return void
     */
    public function select_producto()
    {
        
        $this->tabla = $this->pagination($this->productos);

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