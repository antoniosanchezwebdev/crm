<div>
    @if ($fabricante != null)
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
                            fabricante</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="me-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            fabricante</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('fabricantes.index')
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
                            fabricante</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="me-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            fabricante</button>
                    </div>

                </div>
                <br>
            </div>
            <br>


            @livewire('fabricantes.edit', ['identificador' => $fabricante], key('tab2'))

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
                            fabricante</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="me-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab3')">Añadir
                            fabricante</button>
                    </div>

                </div>
                <br>
            </div>
            <br>

            @livewire('fabricantes.create', key('tab3'))
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
                            <button type="button" class="btn btn-outline-secondary btn-block" disabled
                                wire:click="cambioTab('tab2')">Ver/Editar
                                fabricante</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="me-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-block"
                                wire:click="cambioTab('tab3')">Añadir
                                fabricante</button>
                        </div>

                    </div>
                    <br>
                </div>
            </div>
            <br>

            @livewire('fabricantes.index')

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
                            fabricante</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="me-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab3')">Añadir
                            fabricante</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('fabricantes.create', key('tab3'))

            <br>
        @endif
    @endif
</div>
