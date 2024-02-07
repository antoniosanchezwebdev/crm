<div id="contenedorFacturas">
    @if (count($facturas) > 0)
        <div class="card" wire:ignore>
            <h5 class="card-header">Facturas recientes</h5>
            <div class="card-body" x-data="{}" x-init="$nextTick(() => {
                $('#tableSinAsignar').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    searching: false,
                    paging: false,
                });
            })">
                <table class="table" id="tableFacturas">
                    <thead>
                        <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Tipo de documento</th>
                            <th scope="col">Presupuesto/s asociado/s</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Total</th>
                            <th scope="col">Total (IVA)</th>
                            <th scope="col">Método de pago</th>

                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facturas as $fact)
                            <tr>
                                <td>{{ $fact->numero_factura }}</th>
                                <td>{{ $fact->tipo_documento }}</th>
                                    @if ($fact->tipo_documento == 'factura')
                                <td>{{ $presupuestos->where('id', $fact->id_presupuesto)->first()->numero_presupuesto }}
                                </td>
                            @else
                                <td>
                                    @foreach ($fact->id_presupuesto as $presup)
                                        {{ $presupuestos->where('id', $presup)->first()->numero_presupuesto }} ,
                                    @endforeach
                                </td>
                        @endif
                        <td>{{ $fact->descripcion }}</td>
                        <td>{{ $fact->precio }} €</td>
                        <td>{{ $fact->precio_iva }} €</td>
                        <td>{{ $fact->metodo_pago }}</td>

                        <td>
                                <div class="col mb-2">
                                    <button type="button" class="btn btn-primary boton-producto"
                                        onclick="Livewire.emit('seleccionarProducto', {{ $fact->id }});">Editar</button>
                                    <br>
                                </div>
                            @if ($fact->metodo_pago == 'No pagado')
                                <div class="col">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Cobrar </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{$fact->id}}', 'Contado')">Contado</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{$fact->id}}', 'Tarjeta de crédito')">Tarjeta de crédito</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{$fact->id}}', 'Transferencia bancaria')">Transferencia
                                                bancaria</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{$fact->id}}', 'Recibo bancario a 30 días')">Recibo bancario
                                                a 30 días</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{$fact->id}}', 'Bizum')">Bizum</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{$fact->id}}', 'Financiado')">Financiado</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </td>


                        </tr>
    @endforeach
    </tbody>
    </table>
@else
    <h5> No hay facturas recientes.</h5>
    @endif

</div>
</div>
</div>
@section('script')
<script>

document.addEventListener('DOMContentLoaded', function() {
  var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
  var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
    return new bootstrap.Dropdown(dropdownToggleEl);
  });
});
</script>
@endsection