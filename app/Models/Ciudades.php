<?php

namespace App\Models;

use App\Scopes\EliminadoScope;
use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudades extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ciudades';
    protected $guarded = ['id', 'created_at', 'updated_at'];



    // Scope local de activo
    public function scopeActive($query, $status)
    {
        return $query->where('is_active', $status);
    }


    public function actas()
    {
        return $this->hasMany(Actas::class, 'ciudades_id');
    }
    public function certificados()
    {
        return $this->hasMany(Certificados::class, 'ciudades_id');
    }
    public function velocimetros()
    {
        return $this->hasMany(CertificadosVelocimetros::class, 'ciudades_id');
    }


    public function contratos()
    {
        return $this->hasMany(Contratos::class, 'ciudades_id');
    }
    /**
     * Scope para traer activos y no
     *
     * eliminados
     */
}
