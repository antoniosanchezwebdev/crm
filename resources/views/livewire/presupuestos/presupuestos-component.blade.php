@if ($tab == 'tab1')
<div>
    <br>
    <div class="row">
        <div class="col-6 d-grid gap-2">
            <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab1')">Consulta</button>
        </div>
        <div class="ms-auto col-6 d-grid gap-2">
            <button type="button" class="btn btn-outline-primary btn-block" wire:click="cambioTab('tab2')">Crear presupuesto</button>
        </div>
    </div>
<br>

        @livewire('presupuestos.index-component')
    @elseif ($tab == 'tab2')

    <div>
        <br>
        <div class="row">
            <div class="col-6 d-grid gap-2">
                <button type="button" class="btn btn-outline-primary btn-block" wire:click="cambioTab('tab1')">Consulta</button>
            </div>
            <div class="ms-auto col-6 d-grid gap-2">
                <button type="button" class="btn btn-primary btn-block" wire:click="cambioTab('tab2')">Crear presupuesto</button>
            </div>
        </div>
    <br>

        @livewire('presupuestos.create-component')
    @endif

    <br>

</div>

