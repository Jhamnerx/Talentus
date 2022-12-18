<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use App\Scopes\EliminadoScope;
use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Clientes extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'clientes';
    // SCOPE DE EMPRESA


    //GLOBAL SCOPE EMPRESA
    protected static function booted()
    {
        static::addGlobalScope(new EmpresaScope);
    }


    // Scope local de activo
    public function scopeActive($query, $status)
    {
        return $query->where('is_active', $status);
    }
    //relacion uno a muchos

    public function presupuestos()
    {
        return $this->hasMany(Presupuestos::class, 'clientes_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }

    //relacion uno a muchos
    public function facturas()
    {
        return $this->hasMany(Facturas::class, 'clientes_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }

    //relacion uno a muchos
    public function recibos()
    {
        return $this->hasMany(Recibos::class, 'clientes_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }


    //relacion uno a muchos
    public function contratos()
    {
        return $this->hasMany(Contratos::class, 'clientes_id');
    }


    //relacion uno a muchos
    public function flotas()
    {
        return $this->hasMany(Flotas::class, 'clientes_id');
    }


    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'clientes_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }


    //Relacion uno a muchos inversa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }


    public function certificados()
    {
        return $this->hasMany(Certificados::class, 'certificados_id');
    }


    //relacion uno a muchos contactos

    public function contactos()
    {
        return $this->hasMany(Contactos::class, 'clientes_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }

    //relacion uno a muchos

    public function cobros()
    {
        return $this->hasMany(Cobros::class, 'clientes_id')->withTrashed()->withoutGlobalScope(EmpresaScope::class);
    }

    public function tareas()
    {

        return $this->hasMany(Tareas::class, 'cliente_id')->withoutGlobalScope(EmpresaScope::class);
    }
}
