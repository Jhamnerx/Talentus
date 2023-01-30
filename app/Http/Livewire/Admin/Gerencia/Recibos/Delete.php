<?php

namespace App\Http\Livewire\Admin\Gerencia\Recibos;

use Livewire\Component;
use App\Models\RecibosPagosVarios;
use Illuminate\Database\Eloquent\Model;

class Delete extends Component
{
    public Model $recibo;
    public $openModalDelete;

    protected $listeners = [
        'openModalDelete'
    ];

    public function delete()
    {
        $this->recibo->delete();
        $this->dispatchBrowserEvent('recibo-delete');
        $this->emit('render');
        //$flight->forceDelete();
    }
    public function openModalDelete(RecibosPagosVarios $recibo)
    {
        $this->openModalDelete = true;
        $this->recibo = $recibo;
    }

    public function render()
    {
        return view('livewire.admin.gerencia.recibos.delete');
    }
}
