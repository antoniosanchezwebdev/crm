<div class="container mx-auto">
    <div class="card">
        <div class="card-header">{{ __('Editar fabricante') }}</div>

        <div class="card-body">
            <form wire:submit.prevent="update">
                <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

                <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="nombre" value="{{ old('nombre') }}" required wire:model="nombre" autocomplete="nombre"
                            autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Editar fabricante') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    </form>
</div>
