<?php

namespace App\Models;

use App\Scopes\EliminadoScope;
use App\Scopes\EmpresaScope;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Certificados extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'certificados';

    protected $casts = [
        'sello' => 'boolean',
        'fondo' => 'boolean',
        'estado' => 'boolean',
        'eliminado' => 'boolean',
        'accesorios' => AsCollection::class,
        'fin_cobertura' => 'date:Y/m/d',
    ];


    // protected function accesorios(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }


    // Scope local de activo
    public function scopeActive($query, $status)
    {
        return $query->where('is_active', $status);
    }


    //Relacion uno a muchos inversa

    public function ciudades()
    {
        return $this->belongsTo(Ciudades::class, 'ciudades_id')->withoutGlobalScope(EliminadoScope::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'vehiculos_id')->withoutGlobalScope(EliminadoScope::class);
    }

    //GLOBAL SCOPE EMPRESA
    protected static function booted()
    {
        static::addGlobalScope(new EmpresaScope);
    }


    public function getPDFData()
    {

        $plantilla = plantilla::where('empresa_id', session('empresa'))->first();;
        $fondo = $plantilla->img_documentos;
        $sello = $plantilla->img_firma;
        view()->share([
            'certificado' => $this,
            'plantilla' => $plantilla,
            'fondo' => $fondo,
            'sello' => $sello,

        ]);

        $pdf = PDF::loadView('pdf.certificado');

        return $pdf->stream('CERTIFICADO-' . $this->vehiculo->placa . ' ' . $this->codigo . '.pdf');

        //return $pdf;
        //return view('pdf.acta');
    }
}
