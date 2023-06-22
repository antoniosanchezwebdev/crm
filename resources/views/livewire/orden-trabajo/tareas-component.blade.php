<div>
    @if ($tarea != null)
        @if ($tab == 'tab1')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Tareas asignadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Asignar/Editar
                            tarea</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('orden-trabajo.index-component')
        @elseif ($tab == 'tab2')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab2')">Tareas asignadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Asignar/Editar
                            tarea</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>


            @livewire('orden-trabajo.index2-component')

            <br>
        @elseif ($tab == 'tab3')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Tareas asignadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab3')">Asignar/Editar
                            tarea</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('orden-trabajo.edit-component', ['identificador' => $tarea], key('tab3'))
        @elseif ($tab == 'tab4')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')">Tareas asignadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab3')">Asignar/Editar
                            tarea</button>
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
                                wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                        </div>
                        <div class="ms-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-block"
                                wire:click="cambioTab('tab2')">Tareas asignadas</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="ms-auto col-6 d-grid gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-block" disabled
                                wire:click="cambioTab('tab3')">Asignar/Editar
                                tarea</button>
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

            @livewire('orden-trabajo.index-component')
        @elseif ($tab == 'tab2')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block"
                            wire:click="cambioTab('tab2')" >Tareas asignadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-block" disabled
                            wire:click="cambioTab('tab3')">Asignar/Editar
                            tarea</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab4')">Opciones</button>
                    </div>
                </div>
                <br>
            </div>
            <br>

            @livewire('orden-trabajo.index2-component')

            <br>
        @elseif ($tab == 'tab4')
            <div style="border-bottom: 1px solid black !important;">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab1')">Tareas sin asignar</button>
                    </div>
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-block"
                            wire:click="cambioTab('tab2')" >Tareas asignadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="ms-auto col-6 d-grid gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-block" disabled
                            wire:click="cambioTab('tab3')">Asignar/Editar
                            tarea</button>
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
                <a class="btn btn-primary btn-block" href="{{ route('orden-trabajo.index') }}"> Consultar y
                    editar
                    categorías </a>
            </div>
        @endif
    @endif
</div>

