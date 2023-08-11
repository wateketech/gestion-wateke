<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table='municipio';
    protected $fillable = ['nombre', 'longitud', 'latitud'];

    public function localidad()
    {
        return $this->hasMany('App\Localidad', 'municipio_id');
    }
}
