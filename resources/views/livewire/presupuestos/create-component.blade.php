<div class="container mx-auto">
    <form wire:submit.prevent="submit">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <br>

        <div class="card">
            <h5 class="card-header">Datos básicos</h5>
            <div class="card-body">
                <div class="mb-3 row d-flex align-items-center">
                    <label for="servicio" class="col-sm-2 col-form-label"><strong>Servicio dado en:</strong></label>
                    <div class="col-sm-10" wire:ignore>
                        <select class="form-control" id="select2-servicio">
                            @foreach ($almacenes as $listalmacen)
                                <option value={{ $listalmacen->id }}>{{ $listalmacen->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="origen" class="col-sm-2 col-form-label">Presupuesto dado en:</label>
                    <div class="col-sm-10" wire:ignore>
                        <select id="select2-origen" class="form-control seleccion">
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
                        <input type="text" wire:model="numero_presupuesto" class="form-control"
                            name="numero_presupuesto" id="numero_presupuesto" disabled>
                        @error('numero_presupuesto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                    <div class="col-sm-10">
                        <fieldset class="form-group">
                            <input wire:model="estado" name="estado" type="radio" value="aceptado" /> Aceptado <br>
                            <input wire:model="estado" name="estado" type="radio" value="rechazado" /> Rechazado <br>
                            <input wire:model="estado" name="estado" type="radio" value="pendiente" /> Pendiente <br>
                        </fieldset>
                        @error('estado')
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
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Datos del cliente</h5>
            <div class="card-body">
                <div class="mb-3 row d-flex align-items-center">
                    <label for="cliente_id" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-10" wire:ignore>
                        <select id="select2-cliente" class="form-control seleccion">
                            @foreach ($clientes as $clienteSel)
                                <option value="{{ $clienteSel->id }}">{{ $clienteSel->id }} - {{ $clienteSel->nombre }}
                                </option>
                            @endforeach

                        </select>
                        @error('denominacion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="trabajador_id" class="col-sm-2 col-form-label">Trabajador asignado</label>
                    <div class="col-sm-10" wire:ignore>
                        <select id="select2-trabajador" class="form-control seleccion">
                            @foreach ($trabajadores as $trabajadorSel)
                                <option value="{{ $trabajadorSel->id }}">{{ $trabajadorSel->id }} -
                                    {{ $trabajadorSel->nombre }}
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
                        <input type="text" wire:model="matricula" class="form-control" name="matricula"
                            id="matricula">
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
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Lista de artículos seleccionados</h5>
            <div class="card-body">
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
                        <input type="number" wire:model="precio" class="form-control" name="precio"
                            id="precio" disabled>
                        @error('fecha_emision')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>


        <br>
        <div class="card">
            <h5 class="card-header">Buscador de artículos</h5>
            <div class="card-body">
                @if ($producto_seleccionado == null)
                    <div class="mb-3 row d-flex align-items-center">
                @endif

                @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 1)
                    <h2>Buscador de artículos</h2>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="prod_sel" class="col-sm-2 col-form-label">Producto seleccionado:</label>
                        <div class="col-sm-10">
                            <input id="prod_sel" class="form-control" type="text" disabled
                                value="{{ $productos->where('id', $producto_seleccionado)->first()->cod_producto }} - {{ $productos->where('id', $producto_seleccionado)->first()->descripcion }}" />
                        </div>
                @endif

                @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 0)
                    <h2 style="margin-top: 10px; !important ">Buscador de artículos</h2>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="prod_sel" class="col-sm-2 col-form-label">Producto seleccionado:</label>
                        <div class="col-sm-10" style="margin-bottom:10px; !important">
                            <input id="prod_sel" class="form-control" type="text" disabled
                                value="{{ $productos->where('id', $producto_seleccionado)->first()->cod_producto }} - {{ $productos->where('id', $producto_seleccionado)->first()->descripcion }}" />
                        </div>
                        <label for="exis_sel" class="col-sm-2 col-form-label">Existencias disponibles:</label>
                        <div class="col-sm-10">
                            <input id="exis_sel" class="form-control" type="text" disabled
                                value="{{ $existencias_productos->where('cod_producto', $productos->where('id', $producto_seleccionado)->first()->cod_producto)->first()->existencias - (int) $cantidad }}" />
                        </div>
                @endif

                <br>
                <h2>Selección de artículos</h2>
                <div class="mb-3 row d-flex align-items-center">
                    <div class="col-sm-10" wire:ignore>
                        <select class="form-control" id="select2-producto">
                            @foreach ($productos as $producti)
                                @if ($producti->mueve_existencias == 0)
                                    <option value="{{ $producti->id }}">{{ $producti->cod_producto }} -
                                        {{ $producti->descripcion }}
                                    </option>
                                @else
                                    @if ($existencias_productos->where('cod_producto', $producti->cod_producto)->where('nombre', $almacenes->where('id', $servicio)->first()->nombre)->first()->existencias > 0)
                                        <option value="{{ $producti->id }}">{{ $producti->cod_producto }} -
                                            {{ $producti->descripcion }}
                                        </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 0)
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input type="number" wire:model="cantidad" class="form-control" name="cantidad"
                                id="cantidad" min="1"
                                max="{{ $existencias_productos->where('cod_producto', $productos->where('id', $producto_seleccionado)->first()->cod_producto)->first()->existencias }}">
                            @error('cantidad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row d-flex align-items-center">
                        <button class="btn btn-sm btn-primary" wire:click.prevent="añadirProducto">Añadir a la
                            lista</button>
                    </div>
                @endif

                @if ($producto_seleccionado != null && $productos->where('id', $producto_seleccionado)->first()->mueve_existencias != 1)
                    <div class="mb-3 row d-flex align-items-center">
                        <button class="btn btn-sm btn-primary" wire:click.prevent="añadirProducto">Añadir a la
                            lista</button>
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-primary">Crear presupuesto</button>
        </div>
    </form>
    <br>
    <div class="card">
        <h5 class="card-header">Opciones</h5>
        <div class="card-body">
            <div class="mb-3 row d-flex align-items-center ">
                <p> Pulsa aquí si el cliente de este presupuesto no existe. </p>
                <a href="{{ route('clients.create') }}" class="btn btn-primary">Crear cliente</a>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#select2-producto').select2({
                    placeholder: "Seleccione un producto"
                });
                $('#select2-producto').on('change', function(e) {
                    var data = $('#select2-producto').select2("val");
                    @this.set('producto_seleccionado', data);
                });

                $('#select2-servicio').select2({
                    placeholder: "Localización del servicio"
                });
                $('#select2-servicio').on('change', function(e) {
                    var data = $('#select2-servicio').select2("val");
                    @this.set('servicio', data);
                });

                $('#select2-origen').select2({
                    placeholder: "Origen del presupuesto"
                });
                $('#select2-origen').on('change', function(e) {
                    var data = $('#select2-origen').select2("val");
                    @this.set('origen', data);
                });

                $('#select2-cliente').select2({
                    placeholder: "Seleccione un cliente"
                });
                $('#select2-cliente').on('change', function(e) {
                    var data = $('#select2-cliente').select2("val");
                    @this.set('cliente_id', data);
                });

                $('#select2-trabajador').select2({
                    placeholder: "Seleccione un trabajador"
                });
                $('#select2-trabajador').on('change', function(e) {
                    var data = $('#select2-trabajador').select2("val");
                    @this.set('trabajador_id', data);
                });

            });
        </script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection

</div>
