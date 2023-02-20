<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table='pais';

    public function provincia()
    {
        return $this->hasMany('App\Provincia', 'pais_id');
    }
}
