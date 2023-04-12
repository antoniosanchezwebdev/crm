<?php

namespace App\Http\Livewire;

use Livewire\Component;

use LivewireUI\Modal\ModalComponent;


class ElegirProducto extends ModalComponent
{
    public function render()
    {
        return view('livewire.elegir-producto');
    }
}
