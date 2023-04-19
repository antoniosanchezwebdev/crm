@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.css">
    @vite(['resources/sass/app.scss'])
    <style>
        .dataTables_filter {
            float: right !important;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('encabezado', 'Presupuestos')
@section('subtitulo', 'Consulta de presupuestos')

@section('content')
    <br>
    <div class="container mx-auto">
        <div class="d-flex">
            @if (count($presupuestos) > 0)
                @mobile
                    <table id="tablePresupuexstos" style="table-layout:fixed; !important">
                    @elsemobile
                        <table id="tablePresupuextos">
                        @endmobile
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
                            @foreach ($presupuestos as $presup)
                                <tr>
                                    <td>{{ $presup->numero_presupuesto }}</th>

                                    <td>{{ $clientes->where('id', $presup->cliente_id)->first()->id }} </td>

                                    <td>{{ $clientes->where('id', $presup->cliente_id)->first()->nombre }} </td>

                                    <td>{{ $presup->fecha_emision }}</th>

                                    <td>{{ $presup->precio }} </td>

                                    <td>{{ $presup->precio }} </td>

                                    <td>{{ $presup->matricula }} </td>

                                    <td>{{ $presup->precio }} </td>

                                    <td> <a href="presupuestos-edit/{{ $presup->id }}"
                                            class="btn btn-primary">Ver/Editar</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            @endif
        </div>
        </tbody>
        </table>
        <div class="d-grid gap-2">
            <a href="{{ route('presupuestos.create') }}" class="btn btn-primary" style="margin-top:30px">Crear nuevo
                presupuesto</a>
        </div>


        
    @section('scripts')
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/searchbuilder/1.4.1/js/dataTables.searchBuilder.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.4.0/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
        <script>
            // $(document).ready(function() {
            //     console.log('entro');
            //     var tabla = $('#tablePresupuestos').DataTable({
            //         responsive: true,
            //         dom: 'frtip',
            //         "language": {
            //             "lengthMenu": "Mostrando _MENU_ registros por página",
            //             "zeroRecords": "Nothing found - sorry",
            //             "info": "Mostrando página _PAGE_ of _PAGES_",
            //             "infoEmpty": "No hay registros disponibles",
            //             "infoFiltered": "(filtrado de _MAX_ total registros)",
            //             "search": "Buscar:",
            //             "paginate": {
            //                 "first": "Primero",
            //                 "last": "Ultimo",
            //                 "next": "Siguiente",
            //                 "previous": "Anterior"
            //             },
            //             "zeroRecords": "No se encontraron registros coincidentes",
            //         }
            //     });

            //     addEventListener("resize", (event) => {

            //     })
            // });
        </script>

    @endsection
@endsection
