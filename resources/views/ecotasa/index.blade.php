@extends('layouts.app')
@section('title', 'Proveedores')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.css">
    @vite(['resources/sass/app.scss'])
    <style>
        div.dataTables_wrapper div.dataTables_filter label {
            display: flex;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 70%;
            margin-left: 10px;
            margin-top: -5px;
        }
    </style>
@endsection

@section('content')
@section('encabezado', 'Ecotasas')
@section('subtitulo', 'Consulta')

@livewire('ecotasa.index')
@endsection

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
        $(document).ready(function() {
            $('#tableProveedor').DataTable({
                responsive: true,
                dom: 'frtip',
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

            addEventListener("resize", (event) => {
                console.log('Recargar');
                // location.reload();
                // Livewire.emit('proveedor-component')

            });

        });
    </script>
@endsection

