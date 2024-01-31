<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compromisosdepago extends Model
{
    use HasFactory;

    public function gastosclubes(){
        return $this->hasMany('App\Models\GastosClubes');
    }

    public function gastosoficina(){
        return $this->hasMany('App\Models\GastosOficina');
    }

    public function gastosPersonales(){
        return $this->hasMany('App\Models\GastosPersonales');
    }

}
