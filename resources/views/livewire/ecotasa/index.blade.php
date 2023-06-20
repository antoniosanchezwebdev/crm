<div class="container mx-auto">
    @if ($tab == 'tab1')
        <div>
            <br>
            <div class="row">
                <div class="col-6 d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab1')">Diametro ≤ 1400
                        mm</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab2')">Diametro > 1400 mm</button>
                </div>
            </div>
            <br>
            <div class="card mb-3">
                <h5 class="card-header">
                    Ecotasas de neumáticos ≤ 1400 mm
                </h5>
                <div class="card-body">
                    @if ($ecotasa1 != null)
                        <table class="table" id="tableEcotasa1">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ecotasa1 as $producto)
                                    <tr>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->valor }}€</td>
                                        @if ($producto->peso_min == null)
                                            <td> ≤ {{ $producto->peso_max }}</td>
                                        @elseif($producto->peso_max == null)
                                            <td> > {{ $producto->peso_min }}</td>
                                        @else
                                            <td> > {{ $producto->peso_min }} y ≤ {{ $producto->peso_max }}</td>
                                        @endif
                                        <td> <a href="ecotasa/edit/{{ $producto->id }}"
                                                class="btn btn-primary">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>{{ $ecotasa1->links() }}</div>
                    @else
                        <h5> Añade las ecotasas para tus productos. </h5>
                    @endif
                    <a href="{{ route('ecotasa.create') }}" class="btn btn-primary">Añadir
                        ecotasa</a>
                </div>
            </div>
        @elseif ($tab == 'tab2')
            <div>
                <br>
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Diametro ≤ 1400
                            mm</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab2')">Diametro
                            > 1400 mm</button>
                    </div>
                </div>
                <br>
                <div class="card mb-3">
                    <h5 class="card-header">
                        Ecotasas de neumáticos > 1400 mm
                    </h5>
                    <div class="card-body">
                        @if ($ecotasa2 != null)
                            <table class="table" id="tableEcotasa2">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Peso</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ecotasa2 as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->valor }}</td>
                                            @if ($producto->peso_min == null)
                                                <td> ≤ {{ $producto->peso_max }}</td>
                                            @elseif($producto->peso_max == null)
                                                <td> > {{ $producto->peso_min }}</td>
                                            @else
                                                <td> > {{ $producto->peso_min }} y ≤ {{ $producto->peso_max }}</td>
                                            @endif
                                            <td> <a href="ecotasa/edit/{{ $producto->id }}"
                                                    class="btn btn-primary">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>{{ $ecotasa2->links() }}</div>
                        @else
                            <h5> Añade una categoría para tus productos. </h5>
                        @endif
                        <a href="{{ route('ecotasa.create') }}" class="btn btn-primary">Añadir
                            ecotasa</a>
                    </div>
                </div>
    @endif

    <br>

</div>
