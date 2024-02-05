<div id="contenedorCaja">
    @if (isset($movimientos))
        <div style="display: flex; align-items: center; justify-content: space-around; gap: 10px;">
            <input type="date" wire:model="fechaInicio">
            <input type="date" wire:model="fechaFin">
            <button type="button" class="btn btn-primary" wire:click="calcularTotal">Calcular</button>
            <h4>Total Movimientos: €{{ $totalMovimientos }}</h4>
        </div>
        <div x-data="{}" x-init="$nextTick(() => {
            $('#tableFacturas').DataTable({
                responsive: true,
                fixedHeader: true,
                searching: false,
                paging: false,
            });
        })">
            <table class="table" id="tableFacturas">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Método de pago</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimientos as $fact)
                        <tr>
                            <td>{{ $fact->fecha }}</th>
                            <td>{{ $fact->cantidad }} €</th>
                            <td>{{ $fact->metodo_pago }}</td>
                            <td>{{ $fact->descripcion }} </td>

                            <td><button type="button" class="btn btn-primary boton-producto"
                                onclick="Livewire.emit('seleccionarProducto', {{ $fact->id }});">Editar</button>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <table class="table" id="tableFacturas">
            <thead>
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Presupuesto asociado</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Total</th>
                    <th scope="col">Método de pago</th>

                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <h5> No hay facturas.</h5>
        </table>
    @endif

</div>
