<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastosOficina extends Model
{
    use HasFactory;


    public function compromiso_pago(){
        return $this->belongsTo('App\Models\compromisosdepago');
    }

    protected $fillable = [
        'mes',
        'compromiso_pago_id',
        'user_id',
        'fecha_de_pago',
        'valor_de_pago',
        'soporte_de_pago',
        'observacion'
    ];  

}
