<?php

namespace App\Models;

use App\Enums\VentasStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comprobantes extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'comprobantes';
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha_emision' => 'date:Y-m-d',
        'tipo_cambio' => 'decimal:2',
        'op_gravadas' => 'decimal:2',
        'op_exoneradas' => 'decimal:2',
        'op_inafectas' => 'decimal:2',
        'op_gratuitas' => 'decimal:2',
        'descuento' => 'decimal:2',
        'igv' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'total' => 'decimal:2',
        'cliente_id' => 'integer',
        'sustento_id' => 'integer',
        'sustento_id' => 'string',
        'serie_correlativo' => 'string',
        'user_id' => 'integer',
        'fe_estado' => 'string',
        'estado' => VentasStatus::class,
        'invoice_id' => 'integer',
        'detalle_cuotas' => AsCollection::class,
        'nota' => AsCollection::class,
    ];

    public function getSerie(): BelongsTo
    {
        return $this->belongsTo(Series::class, 'serie', 'serie');
    }

    public function venta(): HasOne
    {
        return $this->hasOne(Ventas::class, 'id', 'invoice_id');
    }

    public function notaCreditoDetalles(): HasMany
    {
        return $this->hasMany(NotaCreditoDetalle::class);
    }

    public function tipoComprobante(): BelongsTo
    {
        return $this->belongsTo(\App\Models\TipoComprobantes::class, 'tipo_comprobante_id', 'codigo');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Clientes::class);
    }

    public function sustento(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sustentos::class);
    }

    public function comprobante(): BelongsTo
    {
        return $this->belongsTo(Ventas::class, 'serie_correlativo_ref', 'serie_correlativo');
    }
}
