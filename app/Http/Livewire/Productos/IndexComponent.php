<?php

namespace App\Http\Livewire\Productos;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Productos;
use App\Models\Neumatico;
use App\Models\Almacen;
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

    public $busqueda_articulo = "";

    public $busqueda_descripcion = "";

    public $productos;
    public $neumaticos;
    public $almacenes;

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
        if ($this->tipo_producto == "") {
            if ($this->busqueda_descripcion == "" && $this->busqueda_articulo == "") {
                $this->productos = Productos::all();
            } else {
                if ($this->busqueda_articulo != "") {
                    $this->productos = Productos::where('cod_producto', 'LIKE', '%' . $this->busqueda_articulo . '%')->get();
                } else if ($this->busqueda_descripcion != "") {
                    $this->productos = Productos::where('descripcion', 'LIKE', '%' . $this->busqueda_descripcion . '%')->get();
                }
            }
        } else {
            if ($this->busqueda_descripcion == "" && $this->busqueda_articulo == "") {
                $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->get();
            } else {
                if ($this->busqueda_articulo != "") {
                    $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->where('cod_producto', 'LIKE', '%' . $this->busqueda_articulo . '%')->get();
                } else if ($this->busqueda_descripcion != "") {
                    $this->productos = Productos::where("tipo_producto", $this->tipo_producto)->where('descripcion', 'LIKE', '%' . $this->busqueda_descripcion . '%')->get();
                }
            }
        }
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