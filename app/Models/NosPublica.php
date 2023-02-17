<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NosPublica extends Model
{
    use HasFactory;
    protected $table='nos_publica';
    protected $fillable = ['link', 'observ', 'entidad_id'];

}
