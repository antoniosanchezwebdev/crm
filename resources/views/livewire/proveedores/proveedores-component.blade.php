@section('head')

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.css">
    @vite(['resources/sass/alumnos.scss'])
@endsection


@section('content')
    <div class="container mx-auto">
        <div class="d-flex justify-content-left align-items-center">
            <h1 class="me-5">Proveedores</h1>
            <a href="{{route('proveedores.create')}}" class="btn btn-info text-white rounded-circle"><i class="fa-solid fa-plus"></i></a>
        </div>

        <br>
        <!-- Creamos tabla si existe componentes -->
        @if (count($proveedores) > 0)
            <table class="table" id="tableProveedor">
                <thead>
                <tr>
                    <th scope="col">ID del cliente</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre fiscal</th>
                    <th scope="col">Nombre comercial</th>
                    <th scope="col">Email</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col"><strong>Editar cliente</strong></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <th scope="row">{{$proveedor->id}}</th>
                            <td>{{$proveedor->dni}}</td>
                            <td>{{$proveedor->nombre}}</td>
                            <td>{{$proveedor->nombre}}</td>
                            <td>{{$proveedor->email}}</td>
                            <td>{{$proveedor->direccion}}</td>
                            <td>{{$proveedor->telefono}}</td>
                            <td>{{$proveedor->observaciones}}</td>
                            <td><a href="/admin/proveedores/edit/{{$proveedor->id}}" class="btn btn-primary">Editar</a></td>
                        </tr>

                    @endforeach                
                </tbody>
            </table>
        @else
        <h5>No hay proveedores en la base de datos</h5>
        @endif
    </div>


@section('scripts')
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script>
        $(document).ready( function () {
            console.log('entro');
            $('#tableProveedor').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],

                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            { extend: 'pdf', className: 'btn-export' },
                            { extend: 'excel', className: 'btn-export' }
                        ],
                        className: 'btn btn-info text-white'
                    }
                ],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Mostrando página _PAGE_ of _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ total registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                    "zeroRecords":    "No se encontraron registros coincidentes",
                }

            });

            addEventListener("resize", (event) => {
                console.log('Recargar');
                // location.reload();
                // Livewire.emit('client-component')
                
            });

        });
    </script>
@endsection

@endsection
