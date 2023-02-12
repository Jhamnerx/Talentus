<?php

namespace App\Http\Livewire\Admin\Vehiculos;

use Livewire\Component;
use App\Models\Vehiculos;

class Suspend extends Component
{
    public Vehiculos $vehiculo;

    public $modalSuspend = false;

    protected $listeners = [
        'suspendVehiculo' => 'openModal',
    ];



    public function delete()
    {
        $this->vehiculo->delete();
        // return redirect()->route('admin.vehiculos.index');
        $this->dispatchBrowserEvent('vehiculo-delete', ['delete' => $this->vehiculo]);

        $this->emit('updateTable');
    }



    public function openModal(Vehiculos $vehiculo)
    {
        $this->modalSuspend = true;
        $this->vehiculo = $vehiculo;
    }


    public function render()
    {
        return view('livewire.admin.vehiculos.suspend');
    }
}
