<?php

namespace App\Http\Livewire\Admin\Dispositivos;

use App\Models\Dispositivos;
use App\Models\ModelosDispositivo;
use Livewire\Component;

class DispositivosIndex extends Component
{

    public $search;
    protected $listeners = ['render' => 'render'];
    public function render()
    {

        if ($this->search === "Equipo Disponible") {
            $this->search = "0";
        }


        $dispositivos = Dispositivos::whereHas('modelo', function ($query) {
            $query->where('marca', 'like', '%' . $this->search . '%')
                ->orWhere('modelo', 'like', '%' . $this->search . '%');
        })->orWhere('imei', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);


        $total = Dispositivos::all()->count();
        $modelos = ModelosDispositivo::all();



        return view('livewire.admin.dispositivos.dispositivos-index', compact('dispositivos', 'modelos', 'total'));
    }
}
