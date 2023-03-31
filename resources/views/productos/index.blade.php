@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.css">
    @vite(['resources/sass/app.scss'])
@endsection

@section('content')
    @section('encabezado', 'Productos')
    @section('subtitulo', 'Vista de productos')
    <livewire:productos.index-component>
        @hasSection('filtros')
            @include('layouts.sidebar')
        @endif
@endsection

@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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
        var table = $('#tableProductos').DataTable({
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

        table.columns().flatten().each(function(colIdx) {
            // Create the select list and search operation
            var select = $('<br> <select class="form-select"/>')
                .appendTo(
                    "#botones"
                )
                .on('change', function() {
                    table
                        .column(colIdx)
                        .search($(this).val())
                        .draw();
                });

            // Get the search data for the first column and add to the select list
            table
                .column(colIdx)
                .cache('search')
                .sort()
                .unique()
                .each(function(d) {
                    select.append($('<option value="' + d + '">' + d + '</option>'));
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
@endsection
