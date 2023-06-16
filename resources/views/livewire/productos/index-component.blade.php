<div id="contenedorProductos">
    <div class="card mb-3">
        <div class="card-header">Buscador</div>
        <div class="card-body">
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
                    <input type="text" wire:model="busqueda_categoria" class="form-control"
                        name="busqueda_descripcion" wire:change="select_producto" id="busqueda_categoria"
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

        <div class="card text-bg-light mb-3">
            <div class="card-header">Resultados</div>
            <div class="card-body">
                @if ($productos->count() > 0)
                @else
                <h3>No existen productos de este tipo.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
