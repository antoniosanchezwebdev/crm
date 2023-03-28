@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

<div class="container mx-auto">
    <h1>Presupuestos</h1>
    <h2>Crear presupuesto</h2>
    <br>
    <form wire:submit.prevent="submit">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

        <div class="mb-3 row d-flex align-items-center">
            <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión </label>
            <div class="col-sm-10">
                <input type="datetime-local" wire:model="fecha_emision" wire:change="numeroPresupuesto"
                    class="form-control" name="fecha_emision" id="fecha_emision">
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="numero_presupuesto" class="col-sm-2 col-form-label">Número de presupuesto</label>
            <div class="col-sm-10">
                <input type="text" wire:model="numero_presupuesto" class="form-control" name="numero_presupuesto"
                    id="numero_presupuesto" disabled>
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="cliente_id" class="form-control seleccion" wire:model="cliente_id"
                    wire:change="listarCliente()">
                    <option value="">-- Seleccione un cliente --</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->id }} - {{ $cliente->nombre }}</option>
                    @endforeach

                </select>
                @error('denominacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="cliente" class="col-sm-2 col-form-label">Trabajador asignado</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="trabajador_id" class="form-control seleccion" wire:model="trabajador_id"
                    wire:change="listarTrabajador()">
                    <option value="">-- Seleccione un cliente --</option>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}">{{ $trabajador->id }} - {{ $trabajador->nombre }}</option>
                    @endforeach

                </select>
                @error('denominacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="matricula" class="col-sm-2 col-form-label">Matrícula</label>
            <div class="col-sm-10">
                <input type="text" wire:model="matricula" class="form-control" name="matricula" id="matricula">
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="kilometros" class="col-sm-2 col-form-label">Kilómetros</label>
            <div class="col-sm-10">
                <input type="number" wire:model="kilometros" class="form-control" name="kilometros" id="kilometros">
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        --

        <div class="mb-3 row d-flex align-items-center">
            <label for="producto" class="col-sm-2 col-form-label">Lista de productos</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="producto" class="form-control seleccion" wire:model="producto">
                    <option selected="selected" value="">-- Seleccione un producto --</option>
                    @foreach ($productos as $product)
                        <option value="{{ $product->id }}">{{ $product->cod_producto }} -
                            {{ $product->descripcion }}</option>
                    @endforeach
                </select>
                @error('denominacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if ($producto != null)
            <div class="mb-3 row d-flex align-items-center">
                <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                    <input type="number" wire:model="cantidad" class="form-control" name="cantidad" id="cantidad">
                    @error('fecha_emision')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-outline-info" wire:click.prevent="añadirProducto">Añadir producto</button>
            <button class="btn btn-outline-info" wire:click.prevent="reducir">Reducir/Eliminar producto</button>
        @endif




        @if (count($lista) != 0)
            <div class="mb-3 row d-flex align-items-center">
                <table class="table" id="tableProductos">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista as $productoE => $cantidad)
                            @if ($cantidad > 0)
                                <tr id={{ $productos->where('id', $productoE)->first()->id }}>
                                    <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}</th>
                                    <td>{{ $productos->where('id', $productoE)->first()->descripcion }}</th>
                                    <td>{{ $productos->where('id', $productoE)->first()->precio_venta }}€</td>
                                    <td>{{ $cantidad }}</td>
                                    <td>{{ $productos->where('id', $productoE)->first()->precio_venta * $cantidad }}€
                                    </td>
                                <tr>
                            @endif
                        @endforeach
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    <tbody>
                </table>
                <div>
        @endif


        <div class="mb-3 row d-flex align-items-center">
            <label for="precio" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-10">
                <input type="number" wire:model="precio" class="form-control" name="precio" id="precio"
                    disabled>
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="observaciones" class="col-sm-2 col-form-label">Comentario</label>
            <div class="col-sm-10">
                <input type="text" wire:model="observaciones" class="form-control" name="observaciones"
                    id="observaciones">
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="origen" class="col-sm-2 col-form-label">Presupuesto dado en:</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="origen" class="form-control seleccion" wire:model="origen">
                    <option selected="selected" value="">-- Seleccione un producto --</option>
                    <option value="Mostrador">Mostrador</option>
                    <option value="Teléfono">Teléfono</option>
                    <option value="Formulario web">Formulario web</option>
                    <option value="Email">Email</option>
                    <option value="Whatsapp">Whatsapp</option>
                </select>
                @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-outline-info">Guardar</button>
        </div>
    </form>

    <a href="{{ route('clients.create') }}" class="btn btn-primary">Crear cliente</a>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">Convertir en orden de trabajo</a>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">Mensaje de Whatsapp al cliente</a>

</div>




</div>

</tbody>
</table>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.seleccion').select2({
                placeholder: '-- SELECCIONA UN PRODUCTO --',
                allowClear: true
            });
            $('.seleccion').on('change', function(e) {
                var data = $(this).select2("val");
                @this.set('producto', data);
            });
        });
    </script>
@endsection

{{-- , precio => {
      document.getElementById('precio').value = precio;
    } --}}
