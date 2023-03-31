
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
        <form wire:submit.prevent="submit">
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
              
              @if($tipo_producto != null)   
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

                @if($tipo_producto == 2)

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

                @if($tipo_producto != 2)
                  <div class="mb-3 row d-flex align-items-center">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoría</label>
                    <div class="col-sm-10">
                      <select name="categoria" id="categoria" wire:model="categoria_id" class="form-control" required>
                          <option selected value="">-- Selecciona Categoria --</option>
                          @php
                            $categoriasFinales = $tipos_producto->find($tipo_producto)->categorias;
                          @endphp
                          @foreach($categoriasFinales as $categoriasMostrar){
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
                    <button type="submit" class="btn btn-outline-info">Guardar</button>
                </div>
            @endif   

          </form>
    </div>
    
    </div>

    </tbody>
    </table>
    