<?php

namespace App\Models;

use App\Scopes\EliminadoScope;
use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'vehiculos';

    // Scope local de activo
    public function scopeActive($query, $status)
    {
        return $query->where('is_active', $status);
    }


    //GLOBAL SCOPE EMPRESA
    protected static function booted()
    {
        static::addGlobalScope(new EmpresaScope);
    }

    //Relacion uno a muchos inversa
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'clientes_id')->withoutGlobalScope(EliminadoScope::class);
    }

    //relacion uno a muchos a modelos
    public function sim_card()
    {
        return $this->belongsTo(SimCard::class, 'sim_card_id')->withoutGlobalScope(EliminadoScope::class);
    }

    //relacion uno a muchos a dispositivos
    public function dispositivos()
    {
        return $this->belongsTo(Dispositivos::class);
    }

    //relacion uno a muchos a reportes
    public function reportes()
    {
        return $this->hasMany(Reportes::class, 'vehiculos_id');
    }

    //relacion uno a muchos a actas
    public function actas()
    {
        return $this->hasMany(Actas::class, 'vehiculos_id');
    }

    //relacion uno a muchos a actas
    public function certificados()
    {
        return $this->hasMany(Certificados::class, 'vehiculos_id');
    }

    //relacion uno a muchos a actas
    public function cert_velocimetros()
    {
        return $this->hasMany(CertificadosVelocimetros::class, 'vehiculos_id');
    }

    //Relacion muchos a ,muchos
    public function detalle_contrato()
    {
        return $this->hasMany(DetalleContratos::class, 'vehiculos_id')->withoutGlobalScope(EliminadoScope::class);;
    }


    //Relacion muchos a ,muchos
    public function contratos()
    {
        return $this->belongsToMany(Contratos::class);
    }

    //relacion uno a muchos
    public function cobros()
    {
        return $this->hasMany(Cobros::class, 'vehiculos_id');
    }

    public function flotas()
    {
        return $this->belongsToMany(Flotas::class, 'vehiculos_flotas', 'vehiculos_id', 'flotas_id')->withoutGlobalScope(EliminadoScope::class);
    }
}
