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
            <h1>Datos básicos</h1>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="servicio" class="col-sm-2 col-form-label">Cliente</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="servicio" class="form-control seleccion" wire:model="servicio">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                    @endforeach

                </select>
                @error('servicio')
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
                <input type="text" wire:model="numero_presupuesto" class="form-control" name="numero_presupuesto"
                    id="numero_presupuesto" disabled>
                @error('fecha_emision')
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
                <input type="number" wire:model="kilometros" class="form-control" name="kilometros" id="kilometros">
                @error('fecha_emision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="border-bottom: 1px solid black; margin-bottom:50px;"></div>
        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h1>Artículos</h1>
        </div>

        <a href="#modalProductos" class="btn btn-primary" data-bs-toggle="modal" onclick="if($.fn.dataTable.isDataTable('#tableProductos')){
            table.state.load();
        }
        else {
            table = $('#tableProductos').DataTable({
                    responsive: true,
                    stateSave: true,
                    ordering: false,
                    select: true,
                    dom: 'lfrtip',                    
                    'language': {
                        select:{
                            rows:{
                                _: '%d artículos seleccionados.',
                                1: '1 artículo seleccionado.'
                            }
                        },
                        'lengthMenu': 'Mostrando _MENU_ registros por página',
                        'zeroRecords': 'Nothing found - sorry',
                        'info': '',
                        'infoEmpty': 'No hay registros disponibles',
                        'infoFiltered': '(filtrado de _MAX_ total registros)',
                        'search': 'Buscar artículo:',
                        'paginate': {
                            'first': 'Primero',
                            'last': 'Ultimo',
                            'next': 'Siguiente',
                            'previous': 'Anterior'
                        },
                        'zeroRecords': 'No se encontraron registros coincidentes',
                    }
                }); 
                table.state.save();
        }">
            Añadir producto </a>


        <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="tituloModalProductos"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModalProductos">Lista de artículos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="tableProductos">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">S1</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $productE)
                                    <tr id={{ $productE->id }}>
                                        <td>{{ $productE->cod_producto }}</th>
                                        <td>{{ $productE->descripcion }}</td>
                                        <td>
                                            @if ($existencias_productos->where('cod_producto', $productE->cod_producto)->first() != null)
                                                {{ $existencias_productos->where('cod_producto', $productE->cod_producto)->first()->existencias }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <h1 class="counter-display"></h1>
                        <button class="counter-minus" wire:click.prevent="">-</button>
                        <button class="counter-plus" wire:click.prevent="">+</button>
                        <button type="button" class="btn btn-primary" id="botonProducto"
                            data-bs-dismiss="modal">Añadir producto</button>
                    </div>
                </div>
            </div>
        </div>




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
                                            wire:click.prevent="reducir({{ $productoLista->id }})">-</button>
                                        {{ $pCantidad }}
                                        <button class="btn btn-sm btn-primary"
                                            wire:click.prevent="aumentar({{ $productoLista->id }})">+</button>
                                    </td>
                                    <td>{{ $productoLista->precio_venta * $cantidad }}€
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
                @error('denominacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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

        $('#modalProductos').on('hide.bs.modal', function() {
            table.destroy();
        });


        $('#botonProducto').click(function() {
            var data = document.getElementsByClassName("selected")[0].id;
            console.log(data);
            Livewire.emit('añadirProducto', data, count);
            count = 1;
        });


        let counterDisplayElem = document.querySelector('.counter-display');
        let counterMinusElem = document.querySelector('.counter-minus');
        let counterPlusElem = document.querySelector('.counter-plus');

        let count = 1;

        updateDisplay();

        counterPlusElem.addEventListener("click", () => {
            count++;
            updateDisplay();
        });

        counterMinusElem.addEventListener("click", () => {
            count--;
            updateDisplay();
        });

        function updateDisplay() {
            counterDisplayElem.innerHTML = count;
        };
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/select.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/select.dataTables.js"></script>
@endsection

{{-- , precio => {
      document.getElementById('precio').value = precio;
    } --}}
