<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreoEnt extends Model
{
    use HasFactory;
    protected $table='correo_ent';
    protected $fillable = ['correo', 'observ', 'entidad_id'];
}
