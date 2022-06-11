<?php

namespace App\Http\Livewire\Admin\Header;

use Livewire\Component;

class Notificaciones extends Component
{
    public $notificaciones, $count;
    
    protected $listeners = [
        'notificaciones-update' => 'update',
    ];


    public function mount()
    {

        $this->update();


    }

    public function update(){

        $this->notificaciones = auth()->user()->unreadNotifications ;
        $this->count = auth()->user()->unreadNotifications->count();
    }
    
    public function render()
    {
        return view('livewire.admin.header.notificaciones');
    }

    public function resetNotificacion(){

    }
}
