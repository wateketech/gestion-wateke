<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $table='entitys';
    protected $fillable = ['alias', 'legal_name', 'comercial_name', 'about', 'enable', 'entity_type_id'];

}
