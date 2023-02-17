<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table='direccion';
    protected $fillable = ['direccion', 'cod_postal', 'localidad_id'];


    public function entidad()
    {
        return $this->hasMany('App\Entidad', 'entidad_id');
    }

}
