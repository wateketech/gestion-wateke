<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoAge extends Model
{
    use HasFactory;
    protected $table='telefono_age';
    protected $fillable = ['telefono', 'observ', 'agente_id'];

}
