<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreoAge extends Model
{
    use HasFactory;
    protected $table='correo_age';
    protected $fillable = ['correo', 'observ', 'agente_id'];
}
