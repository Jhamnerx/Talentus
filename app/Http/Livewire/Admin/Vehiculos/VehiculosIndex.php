<?php

namespace App\Http\Livewire\Admin\Vehiculos;

use App\Models\Vehiculos;
use Livewire\Component;
use Livewire\WithPagination;

class VehiculosIndex extends Component
{
    use WithPagination;
    public $search;
    public $from = '';
    public $to = '';
    public $openModalSave = false;
    public $modalOpenImport = false;


    protected $listeners = [
        'updateTable' => 'render',
        'echo:vehiculos,VehiculosImportUpdated' => 'updateVehiculos'
    ];

    public function updateVehiculos()
    {
        $this->render();
        $this->dispatchBrowserEvent('vehiculos-import');
    }

    public function render()
    {
        $desde = $this->from;
        $hasta = $this->to;

        $vehiculos = Vehiculos::whereHas('sim_card', function ($query) {
            $query->where('sim_card', 'LIKE', '%' . $this->search . '%')
                ->orWhere('operador', 'LIKE', '%' . $this->search . '%');
            $query->orwhereHas('linea', function ($linea) {
                $linea->where('numero', 'LIKE', '%' . $this->search . '%');
            });
        })->orwhereHas('cliente', function ($query) {

            $query->where('razon_social', 'LIKE', '%' . $this->search . '%');
        })->orwhereHas('dispositivos', function ($query) {
            $query->where('imei', 'LIKE', '%' . $this->search . '%');
        })->orWhere('placa', 'like', '%' . $this->search . '%')
            ->orWhere('marca', 'like', '%' . $this->search . '%')
            ->orWhere('modelo', 'like', '%' . $this->search . '%')
            ->orWhere('tipo', 'like', '%' . $this->search . '%')
            ->orWhere('color', 'like', '%' . $this->search . '%')
            ->orWhere('motor', 'like', '%' . $this->search . '%')
            ->orWhere('serie', 'like', '%' . $this->search . '%')
            ->orWhere('dispositivo_imei', 'like', '%' . $this->search . '%')
            ->orWhere('old_numero', 'like', '%' . $this->search . '%')
            ->orWhere('old_sim_card', 'like', '%' . $this->search . '%')
            ->orWhere('year', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);




        $total = Vehiculos::all()->count();


        if (!empty($desde)) {


            $vehiculos = Vehiculos::whereRaw(
                "(created_at >= ? AND created_at <= ?)",
                [
                    $desde . " 00:00:00",
                    $hasta . " 23:59:59"
                ]
            )->whereRaw(
                "(placa like ? OR marca like  ? OR tipo like ? OR year like ?)",
                [
                    '%' . $this->search . '%',
                    '%' . $this->search . '%',
                    '%' . $this->search . '%',
                    '%' . $this->search . '%',
                ]
            )
                ->orderBy('id')
                ->paginate(10);
        }
        return view('livewire.admin.vehiculos.vehiculos-index', compact('vehiculos', 'total'));
    }

    public function filter($dias)
    {
        switch ($dias) {
            case '1':
                $this->from = date('Y-m-d');
                $this->to = date('Y-m-d');
                break;
            case '7':
                $this->from = date('Y-m-d', strtotime(date('Y-m-d') . "- 7 days"));
                $this->to = date('Y-m-d');
                break;
            case '30':
                $this->from = date('Y-m-d', strtotime(date('Y-m-d') . "- 1 month"));
                $this->to = date('Y-m-d');
                break;
            case '12':
                $this->from = date('Y-m-d', strtotime(date('Y-m-d') . "- 1 year"));
                $this->to = date('Y-m-d');
                break;
            case '0':
                $this->from = '';
                $this->to = '';
                break;
        }
    }

    public function openModalSave()
    {

        $this->emit('openModalSave');
    }

    public function openModalImport()
    {

        $this->emit('openModalImport');
    }


    public function deleteVehiculo(Vehiculos $vehiculo)
    {

        $this->emit('deleteVehiculo', $vehiculo);
    }

    public function suspendVehiculo(Vehiculos $vehiculo)
    {
        $this->emit('suspendVehiculo', $vehiculo);
    }
    public function createMantenimiento(Vehiculos $vehiculo)
    {
        $this->emit('openModalSaveMantenimiento', 'vehiculos-index', $vehiculo);
    }
}
