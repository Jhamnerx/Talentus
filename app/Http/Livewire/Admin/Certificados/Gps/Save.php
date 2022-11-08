<?php

namespace App\Http\Livewire\Admin\Certificados\Gps;

use App\Http\Controllers\Admin\CertificadosGpsController;
use App\Http\Requests\CertificadosGpsRequest;
use App\Models\Certificados;
use App\Models\Ciudades;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Str;
use jhamnerx\LaravelIdGenerator\IdGenerator;

class Save extends Component
{


    public $openModalSave = false;
    public $numero, $vehiculos_id, $ciudades_id, $fondo = 1, $sello = 1;
    public $fin_cobertura;
    public $accesorios = [];


    protected $listeners = [
        'guardarCertificado' => 'openModal'
    ];

    public function render()
    {
        return view('livewire.admin.certificados.gps.save');
    }

    public function openModal()
    {
        $this->openModalSave = true;
        $certController = new CertificadosGpsController();
        $this->numero = $certController->setNextSequenceNumber();
        $this->fin_cobertura = Carbon::now()->addDays(30)->format('Y-m-d');
    }

    function updatedCiudadesId()
    {
        // $this->numero = $this->setNextSequenceNumber($this->ciudad_prefijo);
    }

    public function closeModal()
    {
        $this->openModalSave = false;
        $this->reset();
        $this->resetErrorBag();
    }

    public function guardarCertificado()
    {
        $certificadoRequest = new CertificadosGpsRequest();

        $values = $this->validate($certificadoRequest->rules(), $certificadoRequest->messages());

        $ciudad = Ciudades::find($values["ciudades_id"]);

        $fecha = $ciudad->nombre . ", " . today()->day . " de " . Str::ucfirst(today()->monthName) . " del " . today()->year;


        $certificado = new Certificados();

        $certificado->vehiculos_id = $values["vehiculos_id"];
        $certificado->numero = $values["numero"];
        $certificado->fin_cobertura = $values["fin_cobertura"];
        $certificado->ciudades_id = $values["ciudades_id"];
        $certificado->fondo = $values["fondo"];
        $certificado->sello = $values["sello"];
        $certificado->accesorios = $this->accesorios;
        $certificado->year = today()->year;
        $codigo = $ciudad->prefijo . "-" . $certificado->numero;
        $certificado->codigo = $codigo;
        $certificado->fecha = $fecha;
        $certificado->save();

        //$this->openModalSave = false;
        $this->dispatchBrowserEvent('certificado-save', ['vehiculo' => $certificado->vehiculos->placa]);
        $this->closeModal();
        $this->emit('updateTable');
    }

    public function updated($label)
    {
        $certificadoRequest = new CertificadosGpsRequest();
        $this->validateOnly($label, $certificadoRequest->rules(), $certificadoRequest->messages());
    }
}
