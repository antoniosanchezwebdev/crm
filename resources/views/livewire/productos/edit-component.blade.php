{{-- 
@section('head')
  @vite(['resources/sass/app.scss'])
@endsection

    <div class="container mx-auto">
        <h1>Productos</h1>
        <h2>Crear Productos</h2>
        <br>
        <div class="d-flex justify-content-evenly align-items-center">
          <h4 class="">Seleccione el tipo de producto</h4>
      </div>
        <form wire:submit.prevent="update">
              <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

              <div class="mb-3 row d-flex align-items-center">
                <label for="tipo_producto" class="col-sm-2 col-form-label">Tipo de producto</label>
                <div class="col-sm-10">
                  <select name="tipo_producto" id="tipo_producto" wire:model="tipo_producto" class="form-control">
                    <option selected value="">-- Selecciona tipo de producto --</option>
                    @foreach ($tipos_producto as $tipos)
                      <option value="{{$tipos->id}}">{{$tipos->tipo_producto}}</option>
                    @endforeach
                  </select>
                  @error('tipo_producto') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
              
              @if ($tipo_producto != null)   
                <div class="mb-3 row d-flex align-items-center">
                  <label for="cod_producto" class="col-sm-2 col-form-label">Código del producto</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="cod_producto" class="form-control" name="cod_producto" id="cod_producto" placeholder="COD123">
                    @error('cod_producto') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripción del producto</label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="descripcion" class="form-control" name="descripcion" id="descripcion" placeholder="Mesa de 10x10...">
                      @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="ecotasa" class="col-sm-2 col-form-label">Ecotasa</label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="ecotasa" class="form-control" name="ecotasa" id="ecotasa" placeholder="Ecotasa">
                      @error('ecotasa') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                  <label for="fabricante" class="col-sm-2 col-form-label">Fabricante</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="fabricante" class="form-control" name="fabricante" id="fabricante" placeholder="Fabricante">
                    @error('fabricante') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                @if ($tipo_producto == 2)

                  <div class="mb-3 row d-flex align-items-center">
                    <label for="etiquetado_eu" class="col-sm-2 col-form-label">Etiquetado europeo</label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="etiquetado_eu" class="form-control" name="etiquetado_eu" id="etiquetado_eu" placeholder="Etiquetado europeo" required>
                      @error('etiquetado_eu') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>

                  <div class="mb-3 row d-flex align-items-center">
                    <label for="estado" class="col-sm-2 col-form-label">Estado del producto</label>
                    <div class="col-sm-10">
                      <input type="text" wire:model="estado" class="form-control" name="estado" id="estado" placeholder="Nuevo o seminuevo" required>
                      @error('estado') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>
                
              @endif

                @if ($tipo_producto != 2)
                  <div class="mb-3 row d-flex align-items-center">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoría</label>
                    <div class="col-sm-10">
                      <select name="categoria" id="categoria" wire:model="categoria_id" class="form-control" required>
                          <option selected value="">-- Selecciona Categoria --</option>
                          @php
                            $categoriasFinales = $tipos_producto->find($tipo_producto)->categorias;
                          @endphp
                          @foreach ($categoriasFinales as $categoriasMostrar){
                            <option value="{{$categoriasMostrar->id}}">{{$categoriasMostrar->nombre}}</option>
                          }
                          @endforeach
                      </select>
                      @error('categoria') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>
                @endif

                <div class="mb-3 row d-flex align-items-center">
                  <label for="precio_baremo" class="col-sm-2 col-form-label">Precio baremo</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="precio_baremo" wire:change="precio_costo" class="form-control" name="precio_baremo" id="precio_baremo" placeholder="Precio baremo">
                    @error('precio_baremo') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                  <label for="descuento" class="col-sm-2 col-form-label">Descuento</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="descuento" wire:change="precio_costo" class="form-control" name="descuento" id="descuento" placeholder="Descuento">
                    @error('descuento') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                  <label for="precio_costoNeto" class="col-sm-2 col-form-label">Precio costo-neto</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="precio_costoNeto" class="form-control" name="precio_costoNeto" id="precio_costoNeto" placeholder="Precio costo neto" disabled>
                    @error('precio_costoNeto') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                  <label for="precio_venta" class="col-sm-2 col-form-label">Precio venta</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="precio_venta" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio de venta">
                    @error('precio_venta') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                  <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model="stock" class="form-control" name="stock" id="stock" placeholder="Stock">
                    @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                  <button type="submit" class="btn btn-outline-info">Guardar</button>
              </div>
        @endif

          </form>
          <div class="mb-3 row d-flex align-items-center">
            <button wire:click="destroy" class="btn btn-outline-danger">Eliminar</button>
        </div>
    </div>
    
    </div>

    </tbody>
    </table>
     --}}

<div class="container mx-auto">
    <form wire:submit.prevent="update">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

        <div class="mb-3 row d-flex align-items-center">
            <label for="tipo_producto" class="col-sm-2 col-form-label">
                <h5>Selecciona el tipo de artículo</h5>
            </label>
            <div class="col-sm-10">
                <select name="tipo_producto" id="tipo_producto" wire:model="tipo_producto" class="form-control">
                    <option selected value="">-- Selecciona tipo de artículo --</option>
                    @foreach ($tipos_producto as $tipos)
                        <option value="{{ $tipos->id }}">{{ $tipos->tipo_producto }}</option>
                    @endforeach
                </select>
                @error('tipo_producto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if ($tipo_producto != null)
            <h1> Datos básicos </h1>

            <div class="mb-3 row d-flex align-items-center">
                <label for="cod_producto" class="col-sm-2 col-form-label">Código del producto</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="cod_producto" class="form-control" name="cod_producto"
                        id="cod_producto" placeholder="COD123">
                    @error('cod_producto')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripción del producto</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="descripcion" class="form-control" name="descripcion"
                        id="descripcion" placeholder="Mesa de 10x10...">
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="fabricante" class="col-sm-2 col-form-label">Fabricante</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="fabricante" class="form-control" name="fabricante" id="fabricante"
                        placeholder="Fabricante">
                    @error('fabricante')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            @if ($tipo_producto != 2)
                <div class="mb-3 row d-flex align-items-center">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoría</label>
                    <div class="col-sm-10">
                        <select name="categoria" id="categoria" wire:model="categoria_id" class="form-control" required>
                            <option selected value="">-- Selecciona Categoria --</option>
                            @php
                                $categoriasFinales = $tipos_producto->find($tipo_producto)->categorias;
                            @endphp
                            @foreach ($categoriasFinales as $categoriasMostrar)
                                {
                                <option value="{{ $categoriasMostrar->id }}">{{ $categoriasMostrar->nombre }}</option>
                                }
                            @endforeach
                        </select>
                        @error('categoria')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @else
                <h1>Datos neumático</h1>
                <h3>Etiquetado europeo</h3>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="resistencia_rodadura" class="col-sm-2 col-form-label">Resistencia rodadura</label>
                    <div class="col-sm-10">
                        <select name="resistencia_rodadura" id="resistencia_rodadura" wire:model="resistencia_rodadura"
                            class="form-control">
                            <option selected value="">--</option>
                            @for ($i = 65; $i <= 71; $i++)
                                <option value="{{ chr($i) }}">{{ chr($i) }}</option>
                            @endfor
                        </select>
                        @error('resistencia_rodadura')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="agarre_mojado" class="col-sm-2 col-form-label">Agarre mojado</label>
                    <div class="col-sm-10">
                        <select name="agarre_mojado" id="agarre_mojado" wire:model="agarre_mojado" class="form-control">
                            <option selected value="">--</option>
                            @for ($i = 65; $i <= 71; $i++)
                                <option value="{{ chr($i) }}">{{ chr($i) }}</option>
                            @endfor
                        </select>
                        @error('agarre_mojado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="emision_ruido" class="col-sm-2 col-form-label">Nivel de ruido</label>
                    <div class="col-sm-10">
                        <select name="emision_ruido" id="emision_ruido" wire:model="emision_ruido" class="form-control">
                            <option selected value="">--</option>
                            @for ($i = 67; $i <= 74; $i++)
                                <option value="{{ $i }}">
                                    {{ $i . ' dB' }}
                                </option>
                            @endfor
                        </select>
                        @error('emision_ruido')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h3>Datos neumático</h3>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="ancho" class="col-sm-2 col-form-label">Ancho</label>
                    <div class="col-sm-10">
                        <input type="number" wire:model="ancho" class="form-control" name="ancho" id="ancho"
                            placeholder="Precio baremo">
                        @error('ancho')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="serie" class="col-sm-2 col-form-label">Serie</label>
                    <div class="col-sm-10">
                        <input type="number" wire:model="serie" class="form-control" name="serie" id="serie"
                            placeholder="Precio baremo">
                        @error('serie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="llanta" class="col-sm-2 col-form-label">Llanta</label>
                    <div class="col-sm-10">
                        <input type="number" wire:model="llanta" class="form-control" name="llanta"
                            id="llanta" placeholder="Precio baremo">
                        @error('llanta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="indice_carga" class="col-sm-2 col-form-label">I.C</label>
                    <div class="col-sm-10">
                        <input type="number" wire:model="indice_carga" class="form-control" name="indice_carga"
                            id="indice_carga" placeholder="Precio baremo">
                        @error('indice_carga')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="codigo_velocidad" class="col-sm-2 col-form-label">C.V</label>
                    <div class="col-sm-10">
                        <input type="number" wire:model="codigo_velocidad" class="form-control"
                            name="codigo_velocidad" id="codigo_velocidad" placeholder="Precio baremo">
                        @error('codigo_velocidad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="ecotasa" class="col-sm-2 col-form-label">Ecotasa</label>
                    <div class="col-sm-10">
                        @if (isset($tasas))
                            @foreach ($tasas as $tasa)
                                <option value="{{ $tasas->id }}">{{ $tasas->codigo }}</option>
                            @endforeach
                        @endif
                        @error('ecotasa')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            @endif

            <h1>Precio</h1>

            <div class="mb-3 row d-flex align-items-center">
                <label for="precio_baremo" class="col-sm-2 col-form-label">Precio baremo</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="precio_baremo" wire:change="precio_costo" class="form-control"
                        name="precio_baremo" id="precio_baremo" placeholder="Precio baremo">
                    @error('precio_baremo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="descuento" class="col-sm-2 col-form-label">Descuento</label>
                <div>
                    <input type="text" wire:model="descuento" wire:change="precio_costo" class="form-control"
                        name="descuento" id="descuento" placeholder="Descuento">
                    @error('descuento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="precio_costoNeto" class="col-sm-2 col-form-label">Precio costo-neto</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="precio_costoNeto" name="precio_costoNeto"
                        id="precio_costoNeto" placeholder="Precio costo neto" disabled>
                    @error('precio_costoNeto')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-flex align-items-center">
                <label for="precio_venta" class="col-sm-2 col-form-label">Precio venta</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="precio_venta" class="form-control" name="precio_venta"
                        id="precio_venta" placeholder="Precio de venta" disabled>
                    @error('precio_venta')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row d-flex align-items-center">
                <label for="mueve_existencias" class="col-sm-2 col-form-label">¿Este artículo mueve
                    existencias?</label>
                <input class="form-check" type="checkbox" wire:model="mueve_existencias" name="mueve_existencias"
                    id="mueve_existencias" checked>
                @error('mueve_existencias')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if ($mueve_existencias == true)
                <h1>Datos de existencias</h1>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="nombre" class="col-sm-2 col-form-label">
                        <h5>Selecciona el almacén</h5>
                    </label>
                    <div class="col-sm-10">
                        <select wire:model="nombre" id="nombre" name="nombre">
                            <option selected value="">-- Selecciona almacén --</option>
                            <option value="ALGECIRAS">ALGECIRAS</option>
                        </select>
                        @error('tipo_producto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="existencias" class="col-sm-2 col-form-label">Número de artículos</label>
                    <div class="col-sm-10">
                        <input type="number" wire:model="existencias" class="form-control" name="existencias"
                            id="existencias" placeholder="Existencias">
                        @error('existencias')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="mb-3 row d-flex align-items-center">
                <button type="submit" class="btn btn-outline-info">Guardar</button>
            </div>
        @endif

    </form>
    <div class="mb-3 row d-flex align-items-center">
        <button wire:click="destroy" class="btn btn-outline-danger">Eliminar</button>
    </div>
</div>

</div>

</tbody>
</table>
</div>
</div>
