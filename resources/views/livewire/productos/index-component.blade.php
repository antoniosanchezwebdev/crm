<div class="d-flex justify-content-left align-items-center">
    <h1 class="me-5">Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-info text-white rounded-circle"><i
            class="fa-solid fa-plus"></i></a>
    <div>&nbsp;&nbsp;&nbsp;</div>
    <a href="{{ route('productos.pdf') }}" class="btn btn-info text-white rounded-pill">PDF</a>
    <div>&nbsp;&nbsp;&nbsp;</div>
    <a href="{{ route('productos-categories.index') }}" class="btn btn-info text-white rounded-pill">Categorías</a>
</div>
<h2>Todos los productos</h2>
<br>
<br><br><br>

<div class="mb-3 row d-flex align-items-center">
    <label for="tipo_producto" class="col-sm-2 col-form-label">Tipo de producto</label>
    <div class="col-sm-10">
        <select name="tipo_producto" id="tipo_producto" wire:model="tipo_producto" wire:change="tipo_producto"
            class="form-control">
            <option selected value="">Todos los productos</option>
            @foreach ($tipos_producto as $tipos)
                <option value="{{ $tipos->id }}" wire:key="{{ $loop->index }}">{{ $tipos->tipo_producto }}</option>
            @endforeach
        </select>
    </div>
</div>


@if (count($productos) > 0)
    <table class="table" id="tableProductos">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Categoría</th>
                <th scope="col">Stock</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosR as $producto)
                <tr>
                <tr id={{ $producto->id }}>
                    <td>{{ $producto->cod_producto }}</th>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->precio_venta }}€</td>
                    <td>{{ $categorias->where('id', $producto->categoria_id)->first()->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td><button class="btn btn-primary" wire:click="alerta({{ $producto->id }})">Mostrar todo</button>
                        <a href="productos-edit/{{ $producto->id }}" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h3>No existen productos de este tipo.</h3>
@endif

</div>

</tbody>
</table>
