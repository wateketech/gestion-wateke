<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gds extends Model
{
    use HasFactory;
    protected $table='gds';
    protected $fillable = ['nombre'];

    public function entidad()
    {
        return $this->hasMany('App\Entidad', 'gds_id');
    }
}
