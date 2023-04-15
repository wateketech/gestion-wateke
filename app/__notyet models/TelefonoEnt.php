<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoEnt extends Model
{
    use HasFactory;
    protected $table='telefono_ent';
    protected $fillable = ['telefono', 'observ', 'entidad_id'];
}
