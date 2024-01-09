<?php

namespace App\Livewire\Admin\Certificados\Actas;

use App\Models\Actas;
use Livewire\Component;

class Delete extends Component
{
    public Actas $acta;
    public $openModalDelete;

    protected $listeners = [
        'EliminarActa' => 'openModalDelete'
    ];

    public function delete()
    {
        $this->acta->delete();
        $this->dispatch('acta-delete');
        $this->dispatch('updateTable');
    }
    public function openModalDelete(Actas $acta)
    {
        $this->openModalDelete = true;
        $this->acta = $acta;
    }
    public function render()
    {
        return view('livewire.admin.certificados.actas.delete');
    }
}