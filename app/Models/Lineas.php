<?php

namespace App\Models;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineas extends Model
{
    use HasFactory;
    // protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $guarded = array();


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new EmpresaScope);
    }


    public function sim_card()
    {

        return $this->hasOne(SimCard::class, 'lineas_id');
    }
    public function sim()
    {

        return $this->hasOne(SimCard::class, 'lineas_id');
    }

    public function cambios_old()
    {

        return $this->hasMany(CambiosLineas::class);
    }

    public function cambios_new()
    {

        return $this->hasMany(CambiosLineas::class, 'new_numero');
    }
}
