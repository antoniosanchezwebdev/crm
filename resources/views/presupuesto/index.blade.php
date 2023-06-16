@extends('layouts.app')

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
@section('encabezado', 'Presupuesto')
@section('subtitulo', 'Consulta')

<livewire:presupuestos.presupuestos-component>

@endsection

@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
@endsection
