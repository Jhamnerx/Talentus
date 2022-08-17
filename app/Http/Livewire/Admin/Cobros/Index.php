<?php

namespace App\Http\Livewire\Admin\Cobros;

use Livewire\Component;
use App\Models\Cobros;
use Livewire\WithPagination;
use Carbon\Carbon;
class Index extends Component
{
    use WithPagination;
    public $search;
    public $estado;


    protected $listeners = [
        'render'
    ];

    public function render()
    {

        $status = $this->estado;

        $cobros = Cobros::whereHas('clientes', function ($query) {
            $query->where('razon_social', 'like', '%' . $this->search . '%');
            $query->orWhereHas('contactos', function ($contacto){
                $contacto->Where('nombre', 'like', '%' . $this->search . '%');
            });
        })->orwhereHas('vehiculos', function ($query) {
            $query->where('placa', 'like', '%' . $this->search . '%');
        })->orWhere('tipo_pago', 'like', '%' . $this->search . '%')
            ->orWhere('periodo', 'like', '%' . $this->search . '%')
            ->orWhere('monto_unidad', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($status === 0) {

            $cobros = Cobros::whereHas('clientes', function ($query) {
                $query->where('razon_social', 'like', '%' . $this->search . '%');
                $query->orWhereHas('contactos', function ($contacto){
                    $contacto->Where('nombre', 'like', '%' . $this->search . '%');
                });
            })->orwhereHas('vehiculos', function ($query) {
                $query->where('placa', 'like', '%' . $this->search . '%');
            })->orWhere('tipo_pago', 'like', '%' . $this->search . '%')
                ->orWhere('periodo', 'like', '%' . $this->search . '%')
                ->orWhere('monto_unidad', 'like', '%' . $this->search . '%')
                ->vencido(false)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        if ($status === 1) {

            $cobros = Cobros::whereHas('clientes', function ($query) {
                $query->where('razon_social', 'like', '%' . $this->search . '%');
                $query->orWhereHas('contactos', function ($contacto){
                    $contacto->Where('nombre', 'like', '%' . $this->search . '%');
                });
            })->orwhereHas('vehiculos', function ($query) {
                $query->where('placa', 'like', '%' . $this->search . '%');
            })->orWhere('tipo_pago', 'like', '%' . $this->search . '%')
                ->orWhere('periodo', 'like', '%' . $this->search . '%')
                ->orWhere('monto_unidad', 'like', '%' . $this->search . '%')
                ->vencido(true)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('livewire.admin.cobros.index', compact('cobros'));
    }

    public function estado($estado = null)
    {
        $this->estado = $estado;
    }



    public function updatingSearch()
    {
        $this->resetPage();
    }   

}
