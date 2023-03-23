@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h2>Bienvenido, {{ $user->name }}</h2>
                    {{ __('¡Has iniciado sesión!') }}
                </div>
            </div>
        </div>
    </div>

@endsection
