

@section('head')
    @vite(['resources/sass/productos.scss'])
@endsection
<div class="container mx-auto">
    <h1>Presupuestos</h1>
    <h2>Editar Presupuesto</h2>
    <br>

    <form wire:submit.prevent="update">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

        <div class="mb-3 row d-flex align-items-center">
            <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión </label>
            <div class="col-sm-10">
              <input type="datetime-local" wire:model="fecha_emision" wire:change="numeroPresupuesto" class="form-control" name="fecha_emision" id="fecha_emision">
              @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="numero_presupuesto" class="col-sm-2 col-form-label">Número de presupuesto</label>
            <div class="col-sm-10">
              <input type="text" wire:model="numero_presupuesto" class="form-control" name="numero_presupuesto" id="numero_presupuesto" disabled>
              @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="cliente_id" class="form-control seleccion" wire:model="cliente_id" wire:change="listarCliente()">
                    <option value="">-- Seleccione un cliente --</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{$cliente->id}} - {{ $cliente->nombre }}</option>
                    @endforeach

                </select>
                @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="cliente" class="col-sm-2 col-form-label">Trabajador asignado</label>
            <div class="col-sm-10" wire:ignore.self>
                <select id="trabajador_id" class="form-control seleccion" wire:model="trabajador_id" wire:change="listarTrabajador()">
                    <option value="">-- Seleccione un cliente --</option>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}">{{$trabajador->id}} - {{ $trabajador->nombre }}</option>
                    @endforeach

                </select>
                @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="matricula" class="col-sm-2 col-form-label">Matrícula</label>
            <div class="col-sm-10">
              <input type="text" wire:model="matricula" class="form-control" name="matricula" id="matricula">
              @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="kilometros" class="col-sm-2 col-form-label">Kilómetros</label>
            <div class="col-sm-10">
              <input type="number" wire:model="kilometros" class="form-control" name="kilometros" id="kilometros">
              @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="precio" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-10">
              <input type="number" wire:model="precio" class="form-control" name="precio" id="precio">
              @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row d-flex align-items-center">
            <label for="observaciones" class="col-sm-2 col-form-label">Comentario</label>
            <div class="col-sm-10">
              <input type="text" wire:model="observaciones" class="form-control" name="observaciones" id="observaciones">
              @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        

        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-outline-info">Guardar</button>
        </div>
    </form>

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

@endsection

