<div>
    @if ($producto != null)
        @if ($tab == 'tab1')
            <div class="row">
                <div class="col-6 d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-block"
                        wire:click="cambioTab('tab1')">Buscador</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab3')">Ver/Editar
                        producto</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab2')">Añadir
                        producto</button>
                </div>
            </div>
            <br>

            @livewire('productos.index-component')
        @elseif ($tab == 'tab2')
            <div class="row">
                <div class="col-6 d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-block"
                        wire:click="cambioTab('tab1')">Buscador</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab3')">Ver/Editar
                        producto</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab2')">Añadir
                        producto</button>
                </div>
            </div>
            <br>

            @livewire('productos.create-component', key('tab2'))

            <br>
        @elseif ($tab == 'tab3')
            <div class="row">
                <div class="col-6 d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-block"
                        wire:click="cambioTab('tab1')">Buscador</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab3')">Ver/Editar
                        producto</button>
                </div>
                <div class="ms-auto col-6 d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-block"
                        wire:click="cambioTab('tab2')">Añadir
                        producto</button>
                </div>
            </div>
            <br>

            @livewire('productos.edit-component', key('tab3'))
        @endif
    @else
        @if ($tab == 'tab1')
            <div>
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab1')">Buscador</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Añadir
                            producto</button>
                    </div>
                </div>
                <br>

                @livewire('productos.index-component', key('tab1'))
            @elseif ($tab == 'tab2')
                <div>
                    <div class="row">
                        <div class="col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-block"
                                wire:click="cambioTab('tab1')">Buscador</button>
                        </div>
                        <div class="ms-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-block"
                                wire:click="cambioTab('tab2')">Añadir
                                producto</button>
                        </div>
                    </div>
                    <br>

                    @livewire('productos.create-component', key('tab2'))

                    <br>
        @endif

    @endif
</div>
