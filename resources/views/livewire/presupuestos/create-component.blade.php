@section('head')
    @vite(['resources/sass/app.scss'])
@endsection

@section('encabezado', 'Presupuestos')
@section('subtitulo', 'Crear presupuesto')

<div class="container mx-auto">
    <form wire:submit.prevent="submit">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <br>

        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h1>Opciones</h1>
        </div>
        <div class="mb-3 row d-flex align-items-center ">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Crear cliente</a>
        </div>
        <div class="mb-3 row d-flex align-items-center ">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Convertir en orden de trabajo</a>
        </div>
        <div class="mb-3 row d-flex align-items-center ">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Mensaje de Whatsapp al cliente</a>
        </div>



        <div style="border-bottom: 1px solid black; margin-bottom:50px;"></div>
        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h1>Datos básicos</h1>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión</label>
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
                @error('denominacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="border-bottom: 1px solid black; margin-bottom:50px;"></div>
        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h1>Datos del cliente</h1>
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
                        <option value="{{ $trabajador->id }}">{{ $trabajador->id }} - {{ $trabajador->nombre }}
                        </option>
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
                <input type="number" wire:model="kilometros" class="form-control" name="kilometros"
                    id="kilometros">
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="border-bottom: 1px solid black; margin-bottom:50px;"></div>
        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h1>Lista de artículos seleccionados</h1>
        </div>

        @if (count($lista) != 0)
            <div class="mb-3 row d-flex align-items-center">
                <table class="table" id="tableProductos" wire:change="añadirProducto">
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
                        @foreach ($lista as $productoID => $pCantidad)
                            @if ($pCantidad > 0)
                                @php
                                    $productoLista = $productos->where('id', $productoID)->first();
                                @endphp
                                <tr id={{ $productoLista->id }}>
                                    <td>{{ $productoLista->cod_producto }}</td>
                                    <td>{{ $productoLista->descripcion }}</td>
                                    <td>{{ $productoLista->precio_venta }}€</td>
                                    <td> <button class="btn btn-sm btn-primary"
                                            wire:click.prevent="reducir({{ $productoID }})">-</button>
                                        {{ $pCantidad }}
                                        <button class="btn btn-sm btn-primary"
                                            wire:click.prevent="aumentar({{ $productoID }})">+</button>
                                    </td>
                                    <td>{{ $productoLista->precio_venta * $pCantidad }}€
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

        <div style="border-bottom: 1px solid black; margin-bottom:50px;"></div>
        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h1>Buscador de artículos</h1>
        </div>

        @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 1)
            <h4>Producto seleccionado:
                {{ $productos->where('id', $producto_seleccionado)->first()->cod_producto }} -
                {{ $productos->where('id', $producto_seleccionado)->first()->descripcion }}
            </h4>
        @endif

        @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 0)
            <h4>Producto seleccionado:
                {{ $productos->where('id', $producto_seleccionado)->first()->cod_producto }} -
                {{ $productos->where('id', $producto_seleccionado)->first()->descripcion }}
            </h4>
            <h4>Existencias del producto:
                {{ $existencias_productos->where('cod_producto', $productos->where('id', $producto_seleccionado)->first()->cod_producto)->first()->existencias }}
            </h4>
        @endif

        <div class="mb-3 row d-flex align-items-center">
            <select class="form-control" id="select2-dropdown" wire:model="producto_seleccionado">
                <option value="">Select Option</option>
                @foreach ($productos as $producti)
                    @if ($producti->mueve_existencias == 0)
                        <option value="{{ $producti->id }}">{{ $producti->cod_producto }} -
                            {{ $producti->descripcion }}
                        </option>
                    @else
                        @if ($existencias_productos->where('cod_producto', $producti->cod_producto)->first()->existencias > 0)
                            <option value="{{ $producti->id }}">{{ $producti->cod_producto }} -
                                {{ $producti->descripcion }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 0)
            <div class="mb-3 row d-flex align-items-center">
                <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                    <input type="number" wire:model="cantidad" class="form-control" name="cantidad" id="cantidad"
                        min="1"
                        max="{{ $existencias_productos->where('cod_producto', $productos->where('id', $producto_seleccionado)->first()->cod_producto)->first()->existencias }}">
                    @error('cantidad')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button class="btn btn-sm btn-primary" wire:click.prevent="añadirProducto">Añadir a la lista</button>
        @endif

        @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 1)
            <button class="btn btn-sm btn-primary" wire:click.prevent="añadirProducto">Añadir a la lista</button>
        @endif


        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
        </div>
        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>


</div>

</div>

</tbody>
</table>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#select2-dropdown').select2();
            $('#select2-dropdown').on('change', function(e) {
                var data = $('#select2-dropdown').select2("val");
                @this.set('producto_seleccionado', data);
            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection

{{-- , precio => {
      document.getElementById('precio').value = precio;
    } --}}
