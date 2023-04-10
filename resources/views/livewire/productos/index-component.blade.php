<div id="contenedorProductos">
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
    <h3> Buscador </h3>
    <br>
        <table class="table" id="tableProductos">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">S1</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr id={{ $producto->id }}>
                        <td>{{ $producto->cod_producto }}</th>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            @if($almacenes->where('cod_producto', $producto->cod_producto)->first() != null)
                            {{ $almacenes->where('cod_producto', $producto->cod_producto)->first()->existencias}}
                            @endif
                        </td>
                        <td><a href="productos-edit/{{ $producto->id }}" class="btn btn-sm btn-primary">Consultar datos</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3>No existen productos de este tipo.</h3>
    @endif

    <div class="d-grid gap-2">
        <a href="{{ route('productos.create') }}" class="btn btn-primary" style="margin-top:30px">Añadir
            producto</a>
    </div>

</div>
