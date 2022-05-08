<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class CategoriasIndex extends Component
{


    public $search;
    public $sort = "id";
    public $direction = "desc";

    public function render()
    {
        $empresa_id = session('empresa');

        $categorias = Categoria::where(function ($query) {
            $query->where('descripcion', 'like', '%' . $this->search . '%')
                ->orwhere('nombre', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc')
            ->paginate(10);
        // ->get();

        $total = Categoria::all()->count();
        return view('livewire.admin.categorias-index', compact('categorias', 'total'));
    }
}
