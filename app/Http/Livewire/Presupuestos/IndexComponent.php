<?php

namespace App\Http\Livewire\Presupuestos;

use App\Models\Alumno;
use App\Models\Cursos;
use App\Models\Empresa;
use App\Models\Presupuestos;
use Livewire\Component;

class IndexComponent extends Component
{
    // public $search;
    public $presupuestos;
    public $alumnos;
    public $cursos;
    public $empresas;


    public function mount()
    {
        $this->presupuestos = Presupuestos::all();
        $this->alumnos = Alumno::all();
        $this->cursos = Cursos::all();
        $this->empresas = Empresa::all();
    }

    public function render()
    {

        return view('livewire.presupuestos.index-component');
    }

}
