@extends('layouts.app')

@section('title', 'Proveedores')

@section('content')

@livewire('proveedores-component', ['response' => $response])

@endsection
