@extends('layouts.app')

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

@section('content')
@section('encabezado', 'Tareas')
@section('subtitulo', 'Consultar tareas')
<br>
<livewire:orden-trabajo.index-component>
@endsection

