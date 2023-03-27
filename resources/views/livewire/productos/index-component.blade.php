
@section('head')

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.css">
    @vite(['resources/sass/productos.scss'])

@endsection
    <div class="container">
        <div class="d-flex justify-content-left align-items-center">
            <h1 class="me-5">Productos</h1>
            <a href="{{route('productos.create')}}" class="btn btn-info text-white rounded-circle"><i class="fa-solid fa-plus"></i></a>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <a href="{{route('productos.pdf')}}" class="btn btn-info text-white rounded-pill">PDF</a>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <a href="{{route('productos-categories.index')}}" class="btn btn-info text-white rounded-pill">Categorías</a>
        </div>
        <h2>Todos los productos</h2>
        <br>
        <br><br><br>

        <div class="mb-3 row d-flex align-items-center">
            <label for="tipo_producto" class="col-sm-2 col-form-label">Tipo de producto</label>
            <div class="col-sm-10">
              <select name="tipo_producto" id="tipo_producto" wire:model="tipo_producto" wire:change="tipo_producto" class="form-control">
                <option selected value="">Todos los productos</option>
                @foreach ($tipos_producto as $tipos)
                  <option value="{{$tipos->id}}">{{$tipos->tipo_producto}}</option>
                @endforeach
              </select>
            </div>
          </div>

        @if (count($productos) > 0)
            <table class="table" id="tableProductos">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr id={{$producto->id}}>
                            <td>{{$producto->cod_producto }}</th>
                            <td>{{$producto->descripcion }}</td>
                            <td>{{$producto->precio_venta }}€</td>
                            <td>{{$categorias->where('id', $producto->categoria)->first()->nombre}}</td>
                            <td>{{$producto->stock}}</td>
                            <td><button class="btn btn-primary" wire:click="alerta({{$producto->id}})">Mostrar todo</button>
                                <a href="productos-edit/{{ $producto->id }}" class="btn btn-primary">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <h3>No existen productos de este tipo.</h3>
        @endif

    </div>

    </tbody>
    </table>


@section('scripts')
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            console.log('entro');
            $('#tableProductos').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [{
                            extend: 'pdf',
                            className: 'btn-export'
                        },
                        {
                            extend: 'excel',
                            className: 'btn-export'
                        }
                    ],
                    className: 'btn btn-info text-white'
                }],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Mostrando página _PAGE_ of _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ total registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "zeroRecords": "No se encontraron registros coincidentes",
                }
            });

            addEventListener("resize", (event)=>{
                location.reload();
            })
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@endsection
