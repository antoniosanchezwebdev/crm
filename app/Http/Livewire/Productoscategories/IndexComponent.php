<?php

namespace App\Http\Livewire\Productoscategories;

use Livewire\Component;
use App\Models\ProductosCategories;
use App\Models\TipoProducto;


class IndexComponent extends Component

{

    public $tipos_producto;
    public $productosCategories;

    public function mount()
    {
        $this->tipos_producto = TipoProducto::all();
        $this->productosCategories = ProductosCategories::all();
    }
    public function render()
    {
        return view('livewire.productos_categories.index-component', [
            'productosCategories' => $this->productosCategories,
        ]);
        // return view('livewire.productos-component');
    }
}
