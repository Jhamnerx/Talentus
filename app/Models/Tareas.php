<?php

namespace App\Models;

use App\Enums\TareasStatus;
use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tareas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'tareas';

    protected $casts = [

        'estado' => TareasStatus::class,
        'fecha_hora' => 'datetime',
        'fecha_termino' => 'datetime',
        'respuesta' => 'boolean',
    ];

    //relacion con tipo de tareas

    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }


    public function tipo_tarea()
    {
        return $this->belongsTo(tipoTareas::class, 'tipo_tarea_id')->withoutGlobalScope(EmpresaScope::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'vehiculos_id')->withoutGlobalScope(EmpresaScope::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id')->withoutGlobalScope(EmpresaScope::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withoutGlobalScope(EmpresaScope::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id')->withoutGlobalScope(EmpresaScope::class);
    }

    //Relacion uno A UNO POLIMORFICA IMAGEN
    public function image()
    {
        return $this->morphOne(Imagen::class, 'imageable')->withoutGlobalScope(EmpresaScope::class);
    }
}