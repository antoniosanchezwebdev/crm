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
    <div class="mb-3 row d-flex align-items-center" style="margin-block: 10px">
        <div class="col-sm-10">
            <select name="filtro_categoria" id="filtro_categoria" wire:model="filtro_categoria" wire:click="filtroCat"
                class="form-control">
                <option selected value="">-- ELIGE CATEGORIA --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria}}">{{ $categoria }}</option>
                @endforeach
            </select>
        </div>
    </div>
        <div style="border-bottom: 1px solid black; margin-bottom:10px;">
            <h3> Buscador por descripción </h3>
        </div>
        <div class="mb-3 row d-flex align-items-center">
            <div class="col-sm-10">
                <input type="text" wire:model="filtro_busqueda" class="form-control" name="filtro_busqueda" wire:keydown="filtroCat" id="filtro_busqueda" placeholder="Presupuesto">
            </div>
        </div>

    </div>
    <div>
        @if ($presupuestos->count() > 0)
            @mobile
                <table class="table" id="tablePresupuexstos" style="display: block; overflow-x: auto; !important">
                @elsemobile
                    <table class="table" id="tablePresupuextos">
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
                        @foreach ($tabla as $presup)
                            <tr>
                                <td>{{ $presup->numero_presupuesto }}</th>

                                <td>{{ $clientes->where('id', $presup->cliente_id)->first()->id }} </td>

                                <td>{{ $clientes->where('id', $presup->cliente_id)->first()->nombre }} </td>

                                <td>{{ $presup->fecha_emision }}</th>

                                <td>{{ $presup->precio }} </td>

                                <td>{{ $presup->precio }} </td>

                                <td>{{ $presup->matricula }} </td>

                                <td>{{ $presup->precio }} </td>

                                <td> <a href="presupuestos-edit/{{ $presup->id }}" class="btn btn-primary">Ver/Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tabla->links() }}
            @else
                <h3>¡Peligro!</h3>
        @endif
    </div>
    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a href="{{ route('presupuestos.create') }}" class="btn btn-primary" style="margin-top:30px">Crear nuevo
            presupuesto</a>
    </div>



@section('scripts')


@endsection
@endsection
