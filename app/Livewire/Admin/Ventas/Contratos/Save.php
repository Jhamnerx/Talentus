<?php

namespace App\Livewire\Admin\Ventas\Contratos;

use App\Http\Requests\ContratosRequest;
use App\Models\Clientes;
use App\Models\Contratos;
use App\Models\Vehiculos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Save extends Component
{
    public $clientes_id, $ciudades_id = '01', $fondo = false, $sello = false;
    public $fecha, $vehiculos_id;
    public $panelVehiculosOpen = false;

    public Collection $items;


    public function mount()
    {
        $this->fecha = Carbon::now()->addDays(30)->format('Y-m-d');
        $this->items = collect();
    }

    public function render()
    {
        return view('livewire.admin.ventas.contratos.save');
    }


    public function openPanelVehiculos()
    {
        $this->panelVehiculosOpen = true;
        $this->dispatch('open-panel-vehiculos', $this->clientes_id);
    }

    public function updatedClientesId($cliente)
    {
        $this->panelVehiculosOpen = true;
        $this->dispatch('open-panel-vehiculos', $cliente);
    }

    #[On('add-vehiculo')]
    public function addVehiculo(Vehiculos $vehiculo)
    {
        if (array_key_exists($vehiculo->placa, $this->items->all())) {

            $this->dispatch(
                'notify-toast',
                icon: 'error',
                title: 'ERROR EL AÑADIR',
                mensaje: 'El vehiculo ' . $vehiculo->placa . ' ya esta agregado',
            );
        } else {


            $this->dispatch(
                'notify-toast',
                icon: 'success',
                tittle: 'PRODUCTO AÑADIDO',
                mensaje: 'Añadiste ' . $vehiculo->placa,
            );

            $this->items[$vehiculo->placa] = [
                'vehiculos_id' => $vehiculo->id,
                'placa' => $vehiculo->placa,
                'plan' => 30
            ];
        }
    }

    public function eliminarVehiculo($key)
    {
        unset($this->items[$key]);
        $this->items;
    }

    public function veritems()
    {

        dd(array_key_exists('M7N-710', $this->items->all()));
    }


    public function saveContrato()
    {
        $request = new ContratosRequest();

        $validate = $this->validate($request->rules(), $request->messages());

        $contrato = Contratos::create([
            'clientes_id' => $validate["clientes_id"],
            'fecha' => $validate["fecha"],
            'sello' => $validate["sello"],
            'fondo' => $validate["fondo"],
            'ciudades_id' => $validate["ciudades_id"],
        ]);

        Contratos::createItems($contrato, $validate["items"]);

        session()->flash('store', 'El contrato de guardo con exito');
        $this->redirectRoute('admin.ventas.contratos.index');
    }

    public function updated($field)
    {

        $request = new ContratosRequest();
        $this->validateOnly($field, $request->rules(), $request->messages());
    }
}
