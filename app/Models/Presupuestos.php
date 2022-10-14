<?php

namespace App\Models;

use App\Notifications\Ventas\EnviarPresupuestoCliente;
use App\Scopes\ActiveScope;
use App\Scopes\EliminadoScope;
use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuestos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'presupuestos';

    protected $casts = [
        'fecha' => 'date:Y/m/d',
        'fecha_caducidad' => 'date:Y/m/d',
    ];
    /**
     * Scope para traer activos y no
     *
     * eliminados
     */
    protected static function booted()
    {
        //
        static::addGlobalScope(new EliminadoScope);
        static::addGlobalScope(new EmpresaScope);
    }

    //Relacion uno a muchos inversa

    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'clientes_id')->withoutGlobalScope(EliminadoScope::class, ActiveScope::class);
    }

    //relacion uno a muchos

    public function detalles()
    {
        return $this->hasMany(DetallePresupuestos::class, 'presupuestos_id');
    }



    public static function createItems($presupuesto, $presupuestoItems)
    {
        foreach ($presupuestoItems as $presupuestoItem) {

            $presupuestoItem['presupuestos_id'] = $presupuesto->id;

            $item = $presupuesto->detalles()->create($presupuestoItem);
        }
    }

    public function getPDFData($action)
    {

        $plantilla = plantilla::where('empresa_id', session('empresa'))->first();
        $fondo = $plantilla->img_documentos;
        $sello = $plantilla->img_firma;
        view()->share([
            'presupuesto' => $this,
            'plantilla' => $plantilla,
        ]);

        $pdf = PDF::loadView('pdf.presupuesto.pdf');

        if ($action == 1) {

            return $pdf->download('PRE-' . $this->numero . '.pdf');
        } else {
            return $pdf->stream('PRE-' . $this->numero . '.pdf');
        };
    }
    public function getPDFDataToMail($data)
    {

        $plantilla = plantilla::where('empresa_id', session('empresa'))->first();
        $fondo = $plantilla->img_documentos;
        $sello = $plantilla->img_firma;

        view()->share([
            'presupuesto' => $this,
            'plantilla' => $plantilla,
        ]);

        $pdf = PDF::loadView('pdf.presupuesto.pdf');

        //$this->clientes->notify(new EnviarPresupuestoCliente($this, $pdf, $data));
        $this->clientes->notify(new EnviarPresupuestoCliente($this, $pdf, $data));
    }


    public function factura()
    {
        return $this->hasOne(Facturas::class, 'presupuestos_id');
    }
    public function recibo()
    {
        return $this->hasOne(Recibos::class, 'presupuestos_id');
    }
}
