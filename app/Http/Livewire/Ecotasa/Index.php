<?php

namespace App\Http\Livewire\Ecotasa;
use App\Models\Ecotasa;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    protected $ecotasa;
    protected $ecotasa1;
    protected $ecotasa2;

    public $tab = "tab1";

    public function mount()
    {
    }

    public function render()
    {
            $this->ecotasa1 = Ecotasa::where('diametro_mayor_1400', 0)->paginate(5);
            $this->ecotasa2 = Ecotasa::where('diametro_mayor_1400', 1)->paginate(7);

        return view('livewire.ecotasa.index', [
            'ecotasa1' => $this->ecotasa1,
            'ecotasa2' => $this->ecotasa2,
        ]);
    }
    public function cambioTab($tab){
        $this->tab = $tab;
    }

}
