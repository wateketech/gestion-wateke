<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoGestion extends Model
{
    use HasFactory;
    protected $table='grupo_gestion';
    protected $fillable = ['nombre'];

    public function entidad()
    {
        return $this->hasMany('App\Entidad', 'entidad_id');
    }
}
