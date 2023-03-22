

@section('head')
    @vite(['resources/sass/productos.scss'])
@endsection
<div class="container mx-auto">
    <h1>Presupuestos</h1>
    <h2>Editar Presupuesto</h2>
    <br>


    <div class="d-flex justify-content-evenly align-items-center">
        <h4 class="">Seleccione el tipo de cliente</h4>
    </div>
    <div class="d-flex justify-content-evenly align-items-center mb-4">
        <div>
            <input type="radio" name="empresa" id="particular" value="1" class="form-check-input" wire:model="tipoCliente">&nbsp; Particular
        </div>
        <div>

            <input type="radio" name="empresa" id="empresa" value="2" class="form-check-input" wire:model="tipoCliente">&nbsp; Empresa
        </div>
    </div>

    @if ($tipoCliente == 1)
        <h4>Presupuesto particular</h4>
        <form wire:submit.prevent="update">
                <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

                <div class="mb-3 row d-flex align-items-center">
                    <label for="numero_presupuesto" class="col-sm-2 col-form-label">Número de presupuesto </label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="numero_presupuesto" class="form-control" name="numero_presupuesto" id="numero_presupuesto">
                      @error('numero_presupuesto') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión </label>
                    <div class="col-sm-10">
                      <input type="datetime-local" wire:model="fecha_emision" class="form-control" name="fecha_emision" id="fecha_emision">
                      @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="detalles" class="col-sm-2 col-form-label">Detalles</label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="detalles" class="form-control" name="detalles" id="detalles">
                      @error('detalles') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="alumno" class="col-sm-2 col-form-label">Alumno</label>
                    <div class="col-sm-10" wire:ignore.self>
                        <select id="alumno_id" class="form-control js-example-responsive" wire:model="alumno_id" wire:change="listarUsuario()">
                            <option value="">-- Seleccione alumno --</option>
                            @foreach ($alumnosSinEmpresa as $alumn)

                                <option value="{{ $alumn->id }}">{{ $alumn->nombre }} {{ $alumn->apellidos }}</option>
                            @endforeach

                        </select>
                        @error('alumno_id')<span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if ($stateAlumno != 0)

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="dni_alumno" class="col-sm-2 col-form-label">DNI alumno</label>
                        <div class="col-sm-10">
                          <input readOnly type="text" placeholder="{{$alumnoSeleccionado->dni}}" class="form-control" name="dni_alumno" id="dni_alumno">
                          @error('dni_alumno') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                @endif

                <div class="mb-3 row d-flex align-items-center">
                    <label for="curso" class="col-sm-2 col-form-label">Curso</label>
                    <div class="col-sm-10" wire:ignore.self>
                        <select id="curso_id" class="form-control js-example-responsive" wire:model="curso_id" wire:change="listarCurso()">
                            <option value="">-- Seleccione curso para presupuestar --</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                            @endforeach

                        </select>
                        @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if ($stateCurso != 0)

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="fecha_inicio" class="col-sm-2 col-form-label">Fecha inicio</label>
                        <div class="col-sm-10">
                          <input readOnly type="text" placeholder="{{$cursoSeleccionado->fecha_inicio}}" class="form-control" name="fecha_inicio" id="fecha_inicio">
                          @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="fecha_fin" class="col-sm-2 col-form-label">Fecha fin</label>
                        <div class="col-sm-10">
                          <input readOnly type="text" placeholder="{{$cursoSeleccionado->fecha_fin}}" class="form-control" name="fecha_fin" id="fecha_fin">
                          @error('fecha_fin') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="total_sin_iva" class="col-sm-2 col-form-label">Precio sin IVA</label>
                        <div class="col-sm-10">
                          <input type="number" readonly step="any" wire:model="total_sin_iva" class="form-control" name="total_sin_iva" id="total_sin_iva">
                          @error('total_sin_iva') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>


                    <div class="mb-3 row d-flex align-items-center">
                        <label for="iva" class="col-sm-2 col-form-label">Tipo de IVA</label>
                        <div class="col-sm-10">
                            <select wire:model="iva" class="form-select" name="iva" id="iva" wire:change="calcularPrecio">
                                <option value="4"  @if ($iva == 4) selected @endif>4%</option>
                                <option value="10"  @if ($iva == 10) selected @endif>10%</option>
                                <option value="21"  @if ($iva == 21) selected @endif>21%</option>
                            </select>
                            @error('iva') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="descuento" class="col-sm-2 col-form-label">% Descuento</label>
                        <div class="col-sm-10">
                          <input type="number" step="any" wire:model="descuento" class="form-control" name="descuento" id="descuento" wire:keydown="calcularPrecio">
                          @error('descuento') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                          <input readonly type="number" step="0.01" wire:model="precio" class="form-control" name="precio" id="precio">
                          @error('precio') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                @endif

                <div class="mb-3 row d-flex align-items-center">
                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                    <div class="col-sm-10" wire:ignore.self>
                        <select id="estadp" class="form-control js-example-responsive" wire:model="estado"">
                            {{-- <option value="Pendiente">-- Seleccione un estado para el presupuesto--</option> --}}
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aceptado">Aceptado</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                        @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="observaciones" class="form-control" name="observaciones" id="observaciones">
                      @error('observaciones') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>



                <div class="mb-3 row d-flex align-items-center">
                    <button type="submit" class="btn btn-outline-info">Guardar</button>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <button wire:click="destroy" class="btn btn-outline-danger">Eliminar</button>
                </div>



            </form>
        </div>
        {{-- FIN TIPOCLIENTE 1 --}}
    @endif
    @if ($tipoCliente == 2)
        <h4>Presupuesto para empresa</h4>
        <form wire:submit.prevent="update">
            <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

            <div class="mb-3 row d-flex align-items-center">
                <label for="numero_presupuesto" class="col-sm-2 col-form-label">Número de presupuesto </label>
                <div class="col-sm-10">
                  <input type="text" wire:model="numero_presupuesto" class="form-control" name="numero_presupuesto" id="numero_presupuesto">
                  @error('numero_presupuesto') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de emisión </label>
                <div class="col-sm-10">
                  <input type="datetime-local" wire:model="fecha_emision" class="form-control" name="fecha_emision" id="fecha_emision">
                  @error('fecha_emision') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="detalles" class="col-sm-2 col-form-label">Detalles</label>
                <div class="col-sm-10">
                  <input type="text" wire:model="detalles" class="form-control" name="detalles" id="detalles">
                  @error('detalles') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="alumno" class="col-sm-2 col-form-label">Alumno</label>
                <div class="col-sm-10" wire:ignore.self>
                    <select id="alumno_id" class="form-control js-example-responsive" wire:model="alumno_id" wire:change="listarUsuario()">
                        <option value="">-- Seleccione alumno --</option>
                        @foreach ($alumnosConEmpresa as $alumn)
                            <option value="{{ $alumn->id }}">{{ $alumn->nombre }} {{ $alumn->apellidos }}</option>
                        @endforeach

                    </select>
                    @error('alumno_id')<span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            @if ($stateAlumno != 0)

            @if ($empresaDeAlumno)
                <div class="mb-3 row d-flex align-items-center">
                    <label for="nombre_empresa" class="col-sm-2 col-form-label">Nombre de la empresa</label>
                    <div class="col-sm-10">
                      <input readOnly type="text" placeholder="{{ $empresaDeAlumno->nombre}}" class="form-control" name="nombre_empresa" id="nombre_empresa">
                      @error('nombre_empresa') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="cif_empresa" class="col-sm-2 col-form-label">CIF de la empresa</label>
                    <div class="col-sm-10">
                      <input readOnly type="text" placeholder="{{$empresaDeAlumno->cif}}" class="form-control" name="cif_empresa" id="cif_empresa">
                      @error('cif_empresa') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif
                @else


            @endif

            <div class="mb-3 row d-flex align-items-center">
                <label for="curso" class="col-sm-2 col-form-label">Curso</label>
                <div class="col-sm-10" wire:ignore.self>
                    <select id="curso_id" class="form-control js-example-responsive" wire:model="curso_id" wire:change="listarCurso()">
                        <option value="">-- Seleccione curso para presupuestar --</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                        @endforeach

                    </select>
                    @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            @if ($stateCurso != 0)

                <div class="mb-3 row d-flex align-items-center">
                    <label for="fecha_inicio" class="col-sm-2 col-form-label">Fecha inicio</label>
                    <div class="col-sm-10">
                      <input readOnly type="text" placeholder="{{$cursoSeleccionado->fecha_inicio}}" class="form-control" name="fecha_inicio" id="fecha_inicio">
                      @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="fecha_fin" class="col-sm-2 col-form-label">Fecha fin</label>
                    <div class="col-sm-10">
                      <input readOnly type="text" placeholder="{{$cursoSeleccionado->fecha_fin}}" class="form-control" name="fecha_fin" id="fecha_fin">
                      @error('fecha_fin') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="total_sin_iva" class="col-sm-2 col-form-label">Precio sin IVA</label>
                    <div class="col-sm-10">
                      <input type="number" readonly step="any" wire:model="total_sin_iva" class="form-control" name="total_sin_iva" id="total_sin_iva">
                      @error('total_sin_iva') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="mb-3 row d-flex align-items-center">
                    <label for="iva" class="col-sm-2 col-form-label">Tipo de IVA</label>
                    <div class="col-sm-10">
                        <select wire:model="iva" class="form-select" name="iva" id="iva" wire:change="calcularPrecio">
                            <option value="4">4%</option>
                            <option value="10">10%</option>
                            <option value="21">21%</option>
                        </select>
                        @error('iva') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="descuento" class="col-sm-2 col-form-label">% Descuento</label>
                    <div class="col-sm-10">
                      <input type="number" step="any" wire:model="descuento" class="form-control" name="descuento" id="descuento" wire:keydown="calcularPrecio">
                      @error('descuento') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                    <div class="col-sm-10">
                      <input readonly type="number" step="0.01" wire:model="precio" class="form-control" name="precio" id="precio">
                      @error('precio') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

            @endif

            <div class="mb-3 row d-flex align-items-center">
                <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                <div class="col-sm-10" wire:ignore.self>
                    <select id="estado" class="form-control js-example-responsive" wire:model="estado"">
                        {{-- <option value="Pendiente">-- Seleccione un estado para el presupuesto--</option> --}}
                        <option value="Pendiente">Pendiente</option>
                        <option value="Aceptado">Aceptado</option>
                        <option value="Rechazado">Rechazado</option>
                    </select>
                    @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                <div class="col-sm-10">
                  <input type="text" value="" wire:model="observaciones" class="form-control" name="observaciones" id="observaciones">
                  @error('observaciones') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>



            <div class="mb-3 row d-flex align-items-center">
                <button type="submit" class="btn btn-outline-info">Guardar</button>
            </div>
            <div class="mb-3 row d-flex align-items-center">
                <button wire:click="destroy" class="btn btn-outline-danger">Eliminar</button>
            </div>


        </form>
    @endif

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

