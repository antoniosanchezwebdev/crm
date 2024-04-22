@section('head')
    @vite(['resources/sass/app.scss'])
@endsection
<div id="contenedorFacturasEdit">
    <div class="card">
        <h1>Facturas</h1>
        <h5 class="card-header">Editar Factura</h5>
        <div class="card-body">
                <form wire:submit.prevent="update">
                    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="numero_factura" class="col-sm-2 col-form-label">Tipo de documento</label>
                        <div class="col-sm-10">
                            <select wire:model="tipo_documento" class="form-control" name="tipo_documento"
                                id="tipo_documento" disabled>
                                <option selected value="">-- Selecciona el tipo de documento --</option>
                                <option value="albaran_credito">Albarán de crédito</option>
                                <option value="factura">Factura</option>
                            </select>
                            @error('tipo_documento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="numero_factura" class="col-sm-2 col-form-label">Número de Factura</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="numero_factura" class="form-control" name="numero_factura"
                                id="numero_factura">
                            @error('numero_factura')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($tipo_documento == 'albaran_credito')
                        <div class="mb-3 row d-flex align-items-center">
                            <label for="id_presupuesto" class="col-sm-2 col-form-label">Presupuestos asociados</label>
                            <ul class="col-sm-2">
                                @foreach ($listaPresupuestos as $presupuesto)
                                    <li>{{ $presupuestos->find($presupuesto)->numero_presupuesto }}</li>
                                @endforeach
                            </ul>
                            <div class="col-sm-8" wire:ignore.self>
                                <select id="id_presupuesto" class="form-control js-example-responsive" wire:model="id_presupuesto">
                                    <option value="0">-- Seleccione un presupuesto --</option>
                                    @foreach ($presupuestosSeleccionables as $presup)
                                        @if (!in_array($presup->id, $listaPresupuestos))
                                            <option value="{{ $presup->id }}">{{ $presup->numero_presupuesto }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="button" wire:click.prevent="addPresupuesto">Añadir presupuesto</button>
                                @error('id_presupuesto')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row d-flex align-items-center">
                            <label for="precio" class="col-sm-2 col-form-label">Precio total</label>
                            <div class="col-sm-10">
                                <input readOnly type="text" placeholder="{{$this->precio}}" class="form-control" name="precio" id="precio">
                                @error('detalles_presupuesto') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @elseif($tipo_documento == 'factura')
                        <div class="mb-3 row d-flex align-items-center">
                            <label for="id_presupuesto" class="col-sm-2 col-form-label">Presupuesto asociado</label>
                            <div class="col-sm-10" wire:ignore.self>
                                <select id="id_presupuesto" class="form-control js-example-responsive" wire:model="id_presupuesto" wire:change="addPrecio" disabled>
                                    <option value="0">-- Seleccione un presupuesto --</option>
                                    @foreach ($presupuestos as $presup)
                                        <option value="{{ $presup->id }}" {{ $id_presupuesto == $presup->id ? 'selected' : '' }}>{{ $presup->numero_presupuesto }} </option>
                                    @endforeach
                                </select>
                                @error('id_presupuesto')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row d-flex align-items-center">
                            <label for="precio" class="col-sm-2 col-form-label">Precio total</label>
                            <div class="col-sm-10">
                                <input readOnly type="text" placeholder="{{optional($presupuestos->where('id' ,$id_presupuesto)->first())->precio}}" class="form-control" name="precio" id="precio">
                                @error('detalles_presupuesto') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión</label>
                        <div class="col-sm-10">
                            <input type="date" wire:model.defer="fecha_emision" class="form-control" placeholder="15/02/2023"
                                id="datepicker">
                            @error('fecha_emision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="fecha_vencimiento" class="col-sm-2 col-form-label">Fecha de vencimiento</label>
                        <div class="col-sm-10">
                            <input type="date" wire:model.defer="fecha_vencimiento" class="form-control" placeholder="18/02/2023"
                                id="datepicker2">
                            @error('fecha_vencimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="descripcion" class="col-sm-2 col-form-label">Descripción </label>
                        <div class="col-sm-10">
                        <input type="text" wire:model="descripcion" class="form-control" name="descripcion"
                        id="descripcion" placeholder="Factura para el cliente...">
                        @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-sm-10" wire:ignore.self>
                            <select id="estado" class="form-control" wire:model="estado">
                                {{-- <option value="Pendiente">-- Seleccione un estado para el presupuesto--</option> --}}
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aceptada">Aceptada</option>
                            </select>
                            @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="metodo_pago" class="col-sm-2 col-form-label">Método de pago</label>
                        <div class="col-sm-10" wire:ignore.self>
                            <select id="metodo_pago" class="form-control" wire:model="metodo_pago">
                                {{-- <option value="Pendiente">-- Seleccione un estado para el presupuesto--</option> --}}
                                <option value="No pagado">No pagado</option>
                                <option value="En efectivo">En efectivo</option>
                                <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                                <option value="Transferencia bancaria">Transferencia bancaria</option>
                            </select>
                            @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="clo-sm-12 mb-3 row d-flex justify-content-around">
                        <button type="submit" class="btn btn-outline-info ">Guardar</button>
                        <a type="button" href="/admin/factura/pdf/{{$identificador}}" class="btn btn-primary text-white clo-sm-3">Dercargar Factura PDF</a>
                        <button type="button" wire:click="mandarMail({{$identificador}})" class="btn btn-info text-white clo-sm-3">Enviar Factura Email</button>
                        <button type="button" wire:click="destroy" class="btn btn-outline-danger clo-sm-3">Eliminar</button>
                    </div>
                </form>
        </div>
    </div>
</div>


@section('scripts')
    <script>
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        document.addEventListener('livewire:load', function () {


        })
        $(document).ready(function() {
            $('.js-example-responsive').select2({
            placeholder: "-- Seleccione un presupuesto --",
            width: 'resolve'
        }).on('change', function() {
            var selectedValue = $(this).val();
            // Llamamos a la función listarPresupuesto() pasando el valor seleccionado
            Livewire.emit('listarPresupuesto', selectedValue);
        });
            console.log('select2')
            $("#datepicker").datepicker();

            $("#datepicker").on('change', function(e){
                @this.set('fecha_inicio', $('#datepicker').val());
                });
            $("#datepicker2").datepicker();

            $("#datepicker2").on('change', function(e){
                @this.set('fecha_fin', $('#datepicker2').val());
                });

        });
    </script>

    {{-- SCRIPT PARA SELECT 2 CON LIVEWIRE --}}
    <script>
        window.initSelect2 = () => {
            jQuery("#id_presupuesto").select2({
                minimumResultsForSearch: 2,
                allowClear: false
            });
        }

        initSelect2();
        window.livewire.on('select2', ()=>{
            initSelect2();
        });
    </script>

@endsection

