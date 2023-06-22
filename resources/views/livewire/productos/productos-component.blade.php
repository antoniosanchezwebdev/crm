<div>
    @if ($producto != null)
        @if ($tab == 'tab1')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Ver/Editar
                            producto</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            producto</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('productos.index-component')
        @elseif ($tab == 'tab2')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab2')">Ver/Editar
                            producto</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            producto</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>


            @livewire('productos.edit-component', ['identificador' => $producto], key('tab2'))

            <br>
        @elseif ($tab == 'tab3')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Ver/Editar
                            producto</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab3')">Añadir
                            producto</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('productos.create-component', key('tab3'))
        @elseif ($tab == 'tab4')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Ver/Editar
                            producto</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            producto</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            <div class="ms-auto col d-grid gap-2">
                <a class="btn btn-primary btn-block" href="{{ route('proveedores.index') }}"> Consultar y editar
                    proveedores </a>
                <a class="btn btn-primary btn-block" href="{{ route('ecotasa.index') }}"> Consultar y editar
                    ecotasas </a>
            </div>
        @endif
    @else
        @if ($tab == 'tab1')
            <div style="border-bottom: 1px solid black !important;">
                <div>
                    <div class="row">
                        <div class="col-6 d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-block"
                                wire:click="cambioTab('tab1')">Buscador</button>
                        </div>
                        <div class="ms-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-block"
                                wire:click="cambioTab('tab2')" disabled>Ver/Editar
                                producto</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="ms-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-block"
                                wire:click="cambioTab('tab3')">Añadir
                                producto</button>
                        </div>
                        <div class="ms-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-block"
                                wire:click="cambioTab('tab4')">Opciones</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <br>

            @livewire('productos.index-component', key('tab1'))
        @elseif ($tab == 'tab3')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-block"
                            wire:click="cambioTab('tab2')" disabled>Ver/Editar
                            producto</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            producto</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('productos.create-component', key('tab3'))

            <br>
        @elseif ($tab == 'tab4')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-block"
                            wire:click="cambioTab('tab2')" disabled>Ver/Editar
                            producto</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            producto</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>

            <br>

            <div class="ms-auto col d-grid gap-2">
                <a class="btn btn-primary btn-block" href="{{ route('proveedores.index') }}"> Consultar y
                    editar proveedores </a>
                <a class="btn btn-primary btn-block" href="{{ route('ecotasa.index') }}"> Consultar y editar
                    ecotasas </a>
                <a class="btn btn-primary btn-block" href="{{ route('productos-categories.index') }}"> Consultar y
                    editar
                    categorías </a>
            </div>
        @endif
    @endif
</div>
