<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;
    protected $table='localidad';
    protected $fillable = ['nombre', 'longitud', 'latitud'];

    public function direccion()
    {
        return $this->hasMany('App\Direccion', 'direccion_id');
    }

}
