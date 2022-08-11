<?php

namespace App\Http\Livewire\Admin\Ventas\Facturas;

use App\Models\Facturas;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Delete extends Component
{
    public Model $presupuesto;
    public $openModalDelete;
    
    protected $listeners = [
        'openModalDelete'
    ];

    public function delete()
    {
        $this->presupuesto->delete();
        $this->dispatchBrowserEvent('factura-delete');
        $this->emit('render');
        //$flight->forceDelete();
    }
    public function openModalDelete(Facturas $presupuesto){
        $this->openModalDelete = true;
        $this->presupuesto = $presupuesto;
    }
    public function render()
    {
        return view('livewire.admin.ventas.facturas.delete');
    }
}
