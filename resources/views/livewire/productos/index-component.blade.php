<div id="contenedorProductos">

    <div class="accordion accordion-flush"
        style="border: 3px solid black; margin-bottom:10px; padding-left:20px; padding-right:20px; padding-top:10px;">
        <div class="accordion-header" id="headingOne" style="border-bottom: 2px solid black; margin-bottom:20px;">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <h3>Buscador</h3>
                </button>
        </div>

        <div id="collapseOne" class="accordion-collapse collapse show" style="margin-block: 10px" wire:ignore.self>
            <h2>Selecciona la categoría principal</h2>
            <div class="col-sm-10" wire:ignore.self>
                <select name="tipo_producto" id="tipo_producto" wire:model="tipo_producto" wire:change="select_producto"
                    class="form-control">
                    <option selected value="">Todos los productos</option>
                    @foreach ($tipos_producto as $tipos)
                        <option value="{{ $tipos->id }}">{{ $tipos->tipo_producto }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-10" wire:ignore.self>
                <h2> Buscador por código de artículo </h2>
                <input type="text" wire:model="busqueda_articulo" class="form-control" name="observaciones"
                    wire:change="select_producto" id="busqueda_articulo"
                    placeholder="Código de artículo (Ej; FLKN055516D)">
            </div>



            <div class="col-sm-10" wire:ignore.self>
                <h2> Buscador por descripción </h2>
                <input type="text" wire:model="busqueda_descripcion" class="form-control" name="busqueda_descripcion"
                    wire:change="select_producto" id="busqueda_descripcion"
                    placeholder="Descripción (Ej; 205/55/16 TL ZIEX ZE310 ECORUN 91V)">
            </div>

            @if ($tipo_producto)

            
            <div class="col-sm-10" wire:ignore.self>
                <h2> Buscador por descripción </h2>
                <input type="text" wire:model="busqueda_categoria" class="form-control" name="busqueda_descripcion"
                    wire:change="select_producto" id="busqueda_categoria"
                    placeholder="Categoría (Ej; Tela)">
            </div>

                
            @endif

            <div class="col-sm-10" wire:ignore.self>
                <h2> Selección de almacén (para existencias) </h2>
                <select name="busqueda_almacen" id="busqueda_almacen" wire:model="busqueda_almacen" class="form-control"
                    wire:change="select_producto">
                    @foreach ($listAlmacenes as $almacene => $nombreA)
                        <option value="{{ $almacene }}">{{ $nombreA->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <br>
        </div>
    </div>

    @if ($productos->count() > 0)

        <div
            style="border: 3px solid black; margin-bottom:10px; padding-left:20px; padding-right:20px; padding-top:10px; ">
            <div style="border-bottom: 2px solid black; margin-bottom:10px;">
                <h3> Resultados </h3>
            </div>

            @mobile
                <table class="table" id="tableProdustos" style="display: block; overflow-x: auto; !important">
                @elsemobile
                    <table class="table" id="tableProdustos">
                    @endmobile
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Existencias</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tabla as $producto)
                            <tr id={{ $producto->id }}>
                                <td>{{ $producto->cod_producto }}</th>
                                <td>{{ $producto->descripcion }}</td>
                                <td>
                                    @if ($almacenes->where('cod_producto', $producto->cod_producto)->first() != null)
                                        {{ $almacenes->where('cod_producto', $producto->cod_producto)->first()->existencias }}
                                    @else
                                        No mueve existencias
                                    @endif

                                </td>
                                <td><a href="productos-edit/{{ $producto->id }}"
                                        class="btn btn-sm btn-primary">Consultar
                                        artículo</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tabla->links() }}
            @else
                <h3>No existen productos de este tipo.</h3>
    @endif
    <div class="mb-3 row d-flex align-items-center">
        <a href="{{ route('productos.create') }}" class="btn btn-primary"
            style="margin-top:30px padding-bottom:20px">Añadir
            producto</a>
    </div>

</div>
