<?php

namespace App\Http\Livewire\Admin\Ajustes\Plantilla\Images;

use App\Models\Empresa;
use App\Models\plantilla;
use Livewire\Component;
use Livewire\WithFileUploads;

class Contrato extends Component
{

    use WithFileUploads;
    public plantilla $plantilla;

    public $fondo_contrato;

    public function render()
    {
        return view('livewire.admin.ajustes.plantilla.images.contrato');
    }

    public function openModalDelete($titulo, $val)
    {

        $this->emit('openModal', $titulo, $val);
    }


    public function updatedImgDocumento()
    {
        $this->validate([
            'fondo_contrato' => 'image|max:1024', // 1MB Max
        ], [
            'fondo_contrato.image' => 'el archivo debe ser una imagen',
            'fondo_contrato.max' => 'El tamaño debe ser menor a 1MB'
        ]);
    }
    public function saveImagenDocumentos()
    {
        $empresa = Empresa::actual()->first()->nombre;
        $this->validate([
            'fondo_contrato' => 'image|max:1024', // 1MB Max
        ], [
            'fondo_contrato.image' => 'el archivo debe ser una imagen',
            'fondo_contrato.max' => 'El tamaño debe ser menor a 1MB'
        ]);

        $url = $this->fondo_contrato->storeAs($empresa . '/imagenes', 'fondo_contrato.png');
        $this->plantilla->fondo_contrato = $url;
        $this->plantilla->save();
        $this->dispatchBrowserEvent('save.image', ['mensaje' => 'Fondo Contrato Guardado Correctamente.']);
    }
}