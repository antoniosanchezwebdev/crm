<div class="container mx-auto">
    <div class="card">
        <h5 class="card-header">Resultados</h5>
        <div class="card-body">
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
                    <h3>¡Peligro!</h3>
                @endif
                </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/fh-3.3.2/r-2.4.1/datatables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/fh-3.3.2/r-2.4.1/datatables.min.js"></script>
        <script>
            $('#tableAsignar').DataTable({
                responsive: true,
                fixedHeader: true,
                searching: false,
                paging: false,
            });
        </script>
    </div>
