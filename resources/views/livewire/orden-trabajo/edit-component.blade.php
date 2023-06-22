<div class="container mx-auto">

    <script>
        $('#tableProductos').DataTable({
            responsive: true,
            fixedHeader: true,
            searching: false,
            paging: false,
        });
    </script>

    <form wire:submit.prevent="update">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <div class="card">
            <h5 class="card-header">Datos del presupuesto</h5>
            <div class="card-body">
                <label for="numero_presupuesto" class="col-sm-2 col-form-label">Número de presupuesto</label>
                <input type="text" wire:model="numero_presupuesto" class="form-control" name="numero_presupuesto"
                    id="numero_presupuesto" disabled>

                <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión </label>
                <input type="datetime-local" wire:model="fecha_emision" class="form-control" name="fecha_emision"
                    id="fecha_emision" disabled>

                <label for="fecha_emision" class="col-sm-2 col-form-label">Trabajador que ha asignado el
                    presupuesto</label>
                <input type="text" wire:model="trabajador_id" class="form-control" name="trabajador_id"
                    id="trabajador_id" disabled>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Datos del cliente</h5>
            <div class="card-body">
                <label for="fecha_emision" class="col-sm-2 col-form-label">Trabajador que ha asignado el
                    presupuesto</label>
                <input type="text" wire:model="trabajador_id" class="form-control" name="trabajador_id"
                    id="trabajador_id" disabled>
                <label for="fecha_emision" class="col-sm-2 col-form-label">Trabajador que ha asignado el
                    presupuesto</label>
                <input type="text" wire:model="trabajador_id" class="form-control" name="trabajador_id"
                    id="trabajador_id" disabled>
                <label for="fecha_emision" class="col-sm-2 col-form-label">Trabajador que ha asignado el
                    presupuesto</label>
                <input type="text" wire:model="trabajador_id" class="form-control" name="trabajador_id"
                    id="trabajador_id" disabled>
                <label for="fecha_emision" class="col-sm-2 col-form-label">Trabajador que ha asignado el
                    presupuesto</label>
                <input type="text" wire:model="trabajador_id" class="form-control" name="trabajador_id"
                    id="trabajador_id" disabled>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Trabajos solicitados</h5>
            <div class="card-body">
                <ul>
                    @foreach ($solicitados as $solicitado)
                        <li>{{ $solicitado }}</li>
                    @endforeach
                </ul>
                <br>
                <input type="text" wire:model="nuevoSolicitado">
                <button wire:click.prevent="agregarSolicitado">Añadir</button>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Trabajos a realizar</h5>
            <div class="card-body">
                <ul>
                    @foreach ($realizables as $realizar)
                        <li>{{ $realizar }}</li>
                    @endforeach
                </ul>
                <br>
                <input type="text" wire:model="nuevoRealizar">
                <button wire:click.prevent="agregarRealizar">Añadir</button>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Observaciones</h5>
            <div class="card-body">
                <label for="observaciones" class="col-sm-2 col-form-label">Escribe tus observaciones</label>
                <textarea wire:model="observaciones" class="form-control" name="observaciones" id="observaciones" rows="3"></textarea>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Concepto de materiales y mano de obra</h5>
            <div class="card-body">
                @if (count($lista) != 0)
                    <div class="mb-3 row d-flex align-items-center" wire:ignore>
                        <table class="table responsive" id="tableProductos">
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
                                @if ($cantidad > 0)
                                    @foreach ($lista as $productoE => $cantidad)
                                        <tr>
                                            <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}</td>
                                            <td>{{ $productos->where('id', $productoE)->first()->descripcion }}</td>
                                            <td>{{ $productos->where('id', $productoE)->first()->precio_venta }}€</td>
                                            <td>{{ $cantidad }}</td>
                                            <td>{{ $productos->where('id', $productoE)->first()->precio_venta * $cantidad }}€
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            <tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Operarios</h5>
            <div class="card-body">
                <label for="trabajadorSeleccionado" class="col-sm-2 col-form-label">Trabajadores</label>
                @if ($trabajadores != null)
                    <h5 class="mt-3">Trabajadores Añadidos</h5>
                    <ul>
                        @foreach ($trabajadores as $trabajador)
                            <li>{{ $trabajador }}</li>
                        @endforeach
                    </ul>
                    <br>
                @endif
                <select wire:model="trabajadorSeleccionado" class="form-control" name="trabajadorSeleccionado"
                    id="trabajadorSeleccionado">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button wire:click.prevent="agregarTrabajador" class="btn btn-primary mt-2">Añadir Usuario</button>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Daños localizados en el vehículo</h5>
            <div class="card-body">
                <ul>
                    @foreach ($daños as $daño)
                        <li>{{ $daño }}</li>
                    @endforeach
                </ul>
                <br>
                <input type="text" wire:model="nuevoDaño">
                <button wire:click.prevent="agregarDaño">Añadir</button>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Documentos adjuntos</h5>
            <div class="card-body">
                @foreach ($rutasDocumentos as $documento)
                    <div class="documento">
                        @if (Str::endsWith($documento, ['.png', '.jpg', '.jpeg', '.gif']))
                            <!-- Mostrar vista previa de la imagen -->
                            <img src="{{ Storage::url($documento) }}" alt="Documento" style=" width: 100%">
                        @elseif (Str::endsWith($documento, ['.pdf']))
                            {{ substr($documento, 11) }} : <a class="btn btn-primary"
                                href="{{ Storage::url($documento) }}" target="_blank">Ver Documento</a>
                        @endif
                    </div>
                @endforeach
                <label for="documentos">Subir documento</label>
                <input type="file" class="form-control" id="documentos" wire:model="documentos" multiple>
                <br>
                <button type="button" class="btn btn-primary" wire:click.prevent="subirArchivo">Subir
                    documento</button>
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
                    <input type="number" wire:model="cantidad" class="form-control" name="cantidad"
                        id="cantidad">
                    @error('fecha_emision')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-outline-info" wire:click.prevent="añadirProducto">Añadir producto</button>
            <button class="btn btn-outline-info" wire:click.prevent="reducir">Reducir/Eliminar producto</button>
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


        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-outline-info">Guardar</button>
        </div>
    </form>

</div>

</div>


@section('scripts')
    <script>
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        document.addEventListener('livewire:load', function() {


        })
        $(document).ready(function() {
            console.log('select2')
            $("#datepicker").datepicker();

            $("#datepicker").on('change', function(e) {
                @this.set('fecha_inicio', $('#datepicker').val());
            });
            $("#datepicker2").datepicker();

            $("#datepicker2").on('change', function(e) {
                @this.set('fecha_fin', $('#datepicker2').val());
            });

        });
    </script>
@endsection
