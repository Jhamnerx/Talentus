<?php

namespace App\Http\Livewire\Admin\Tecnico\Tareas;

use Livewire\Component;

class Actions extends Component
{
    public function render()
    {
        return view('livewire.admin.tecnico.tareas.actions');
    }
    public function openModalReporte()
    {

        $this->emit('openModalReporte');
    }
}
