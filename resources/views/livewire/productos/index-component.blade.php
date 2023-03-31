<div>
    <div class="mb-3 row d-flex align-items-center" style="margin-block: 10px">
        <h5>Selecciona la categoría principal<h5>
                <div class="col-sm-10">
                    <select name="tipo_producto" id="tipo_producto" wire:model="tipo_producto" wire:change="select_producto"
                        class="form-control">
                        <option selected value="">Todos los productos</option>
                        @foreach ($tipos_producto as $tipos)
                            <option value="{{ $tipos->id }}">{{ $tipos->tipo_producto }}</option>
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
                @foreach ($productos as $producto)
                    <tr id={{ $producto->id }}>
                        <td>{{ $producto->cod_producto }}</th>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio_venta }}€</td>
                        <td>{{ $categorias->where('id', $producto->categoria_id)->first()->nombre }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td><button class="btn btn-primary" wire:click="alerta({{ $producto->id }})">Mostrar
                                todo</button>
                            <a href="productos-edit/{{ $producto->id }}" class="btn btn-primary">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3>No existen productos de este tipo.</h3>
    @endif

    <div class="d-grid gap-2">
        <a href="{{ route('presupuestos.create') }}" class="btn btn-primary" style="margin-top:30px">Añadir
            producto</a>
    </div>

    <div id="botones" style="margin-top:30px;">
        <h5>Filtros de búsqueda</h5>
    </div>

</div>
