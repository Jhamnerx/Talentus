<?php

namespace App\Http\Livewire\Admin\Usuarios;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $from = '';
    public $to = '';
    protected $listeners = [
        'render' => 'render',
    ];
    public function render()
    {
        $usuarios = User::Where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
            
        $total = User::all()->count();
        return view('livewire.admin.usuarios.index', compact('usuarios', 'total'));
    }
}
