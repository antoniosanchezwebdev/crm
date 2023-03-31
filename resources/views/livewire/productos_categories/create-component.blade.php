@section('head')
    @vite(['resources/sass/app.scss'])
@endsection

<div class="container mx-auto">
    <h1>Productos - Categorías</h1>
    <h2>Crear categoría de producto</h2>


    

    <form wire:submit.prevent="submit">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

        <div class="mb-3 row d-flex align-items-center">
            <label for="tipo" class="col-sm-2 col-form-label">Tipo de producto de la categoría</label>
            <select class="form-select" wire:model="tipo_producto" aria-label="Default select example" id="tipo">
                <option selected>-- SELECCIONA UN TIPO DE PRODUCTO --</option>
                @foreach ($tipos_producto as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->tipo_producto}}</option>
                @endforeach
              </select>

            <label for="nombre" class="col-sm-2 col-form-label">Nombre de la categoría</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" wire:model="nombre" nombre="nombre" id="nombre"
                    placeholder="Nombre de la categoría...">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        </div>


        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-outline-info">Guardar</button>
        </div>


    </form>
</div>


</div>

</tbody>
</table>
