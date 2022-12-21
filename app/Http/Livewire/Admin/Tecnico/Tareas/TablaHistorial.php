<?php

namespace App\Http\Livewire\Admin\Tecnico\Tareas;

use App\Models\Tareas;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\Admin\UtilesController;

class TablaHistorial extends Component
{
    use WithPagination;
    public $search = '';
    public $pages = 10;

    protected $listeners = [
        'updateIndex' => 'render'
    ];

    public function render()
    {

        $tareas = Tareas::whereHas('vehiculo', function ($vehiculo) {
            $vehiculo->where('placa', 'LIKE', '%' . $this->search . '%');
        })->orWhereHas('cliente', function ($cliente) {
            $cliente->where('razon_social', 'LIKE', '%' . $this->search . '%');
        })->orWhereHas('user', function ($user) {
            $user->where('name', 'LIKE', '%' . $this->search . '%');
        })->orWhereHas('tipo_tarea', function ($user) {
            $user->where('nombre', 'LIKE', '%' . $this->search . '%');
        })->orWhere('dispositivo', 'LIKE', '%' . $this->search . '%')
            ->orWhere('numero', 'LIKE', '%' . $this->search . '%')
            ->with('vehiculo', 'cliente', 'user', 'tipo_tarea')
            ->orderBy('id', 'desc')
            ->paginate($this->pages);

        return view('livewire.admin.tecnico.tareas.tabla-historial', compact('tareas'));
    }

    public function addTask()
    {
        $this->emit('addTask');
    }

    public function editTask(Tareas $task)
    {
        $this->emit('openModalEdit', $task);
    }

    public function showTecnicos()
    {
        $this->emit('openModalTecnicos');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function pagination($pages)
    {
        $this->pages = $pages;
    }
    public function deleteTask(Tareas $task)
    {

        $this->dispatchBrowserEvent('update-task', ['titulo' => 'TAREA ELIMINADA', 'message' => 'Se elimino la tarea',  'token' => $task->token, 'color' => '#f87171', 'progressBarColor' => 'rgb(255,255,255)']);
        $task->delete();
        $this->render();
    }

    public function sendGroupWhatsApp(Tareas $task)
    {
        $util = new UtilesController();
        $respuesta = $util->whatsAppSendMessageInstalationGroup($task);
    }

    public function infoTask(Tareas $tarea)
    {
    }
}
