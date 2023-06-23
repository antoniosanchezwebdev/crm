<div class="container mx-auto">
    <div class="card" wire:ignore>
        <h5 class="card-header">Resultados</h5>
        <div class="card-body" x-data="{}" x-init="$nextTick(() => {
            $('#tableAsignar').DataTable({
                responsive: true,
                fixedHeader: true,
                searching: false,
                paging: false,
            });
        })">
            <div wire:ignore>
                @if ($tareas->count() > 0)
                    <table class="table responsive" id="tableAsignar">
                        <thead>
                            <tr>
                                <th scope="col">Número</th>
                                <th scope="col">ID de cliente</th>
                                <th scope="col">Nombre de cliente</th>
                                <th scope="col">Fecha emisión</th>
                                <th scope="col">Marca vehículo</th>
                                <th scope="col">Modelo vehículo</th>
                                <th scope="col">Matrícula</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Recorre los presupuestos --}}
                            @foreach ($tareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->presupuesto->numero_presupuesto }}</th>

                                    <td>{{ $tarea->presupuesto->cliente->id }} </td>

                                    <td>{{ $tarea->presupuesto->cliente->nombre }} </td>

                                    <td>{{ $tarea->presupuesto->fecha_emision }}</th>

                                    <td>{{ $tarea->presupuesto->marca }} </td>

                                    <td>{{ $tarea->presupuesto->modelo }} </td>

                                    <td>{{ $tarea->presupuesto->matricula }} </td>

                                    <td>{{ $tarea->presupuesto->precio }} </td>

                                    <td> <button type="button" class="btn btn-primary boton-producto"
                                            onclick="Livewire.emit('seleccionarProducto', {{ $tarea->id }});">Ver/Editar</button>
                                        <div class="mb-3 row d-flex align-items-center ">
                                            <a href="{{ route('clients.create') }}" class="btn btn-primary">Mensaje de
                                                Whatsapp al cliente</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3>No existen tareas activas asignadas. </h3>
                @endif
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
