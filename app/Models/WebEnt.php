<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebEnt extends Model
{
    use HasFactory;
    protected $table='web_ent';
    protected $fillable = ['link', 'observ', 'entidad_id'];
}
