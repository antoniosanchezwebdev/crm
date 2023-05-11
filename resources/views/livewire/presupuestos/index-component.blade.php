<div id="contenedorPresupuestos">


    <div class="accordion accordion-flush"
        style="border: 3px solid black; margin-bottom:10px; padding-left:20px; padding-right:20px; padding-top:10px;">
        <div class="accordion-header" id="headingOne" style="border-bottom: 2px solid black; margin-bottom:20px;">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <h3>Buscador</h3>
            </button>
        </div>

        <div id="collapseOne" class="accordion-collapse collapse show" style="margin-block: 10px" wire:ignore.self>

            <div style="margin-bottom:10px;">
                <h2> Categoría </h2>
            </div>

            <div class="col-sm-10">
                <select name="filtro_categoria" id="filtro_categoria" wire:model="filtro_categoria"
                    wire:change="filtroCat" class="form-control">
                    <option selected value="">Todos los productos</option>
                    @foreach ($categorias as $categoria => $nombre_cat)
                        <option value="{{ $categoria }}">{{ $nombre_cat }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div style="margin-bottom:10px;">
                <h2> Búsqueda </h2>
            </div>

            <div class="col-sm-10">
                <input type="text" wire:model="filtro_busqueda" class="form-control" name="filtro_busqueda"
                    wire:change="filtroCat" id="filtro_busqueda" placeholder="Presupuesto">
            </div>
        </div>
    </div>

    <div style="border: 3px solid black; margin-bottom:10px; padding-left:20px; padding-right:20px; padding-top:10px; ">
        <div style="border-bottom: 2px solid black; margin-bottom:10px;">
            <h3> Resultados </h3>
        </div>
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

                                <td> <a href="presupuestos-edit/{{ $presup->id }}"
                                        class="btn btn-primary">Ver/Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tabla->links() }}
            @else
                <h3>¡Peligro!</h3>
        @endif
        </tbody>
        </table>
    </div>

    <div class="d-grid gap-2">
        <a href="{{ route('presupuestos.create') }}" class="btn btn-primary" style="margin-top:30px">Crear
            nuevo
            presupuesto</a>
    </div>

</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#filtro_categoria').select2({
                placeholder: "Seleccione un producto"
            });
            $('#filtro_categoria').on('change', function(e) {
                var data = $('#filtro_categoria').select2("val");
                @this.set('filtro_categoria', data);
            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
