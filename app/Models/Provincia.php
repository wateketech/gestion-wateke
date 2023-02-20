<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $table='provincia';
    protected $fillable = ['name', 'latitude', 'longitude'];


    public function municipio()
    {
        return $this->hasMany('App\municipio', 'provincia_id');
    }
}
