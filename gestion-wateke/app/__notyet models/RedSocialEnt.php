<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedSocialEnt extends Model
{
    use HasFactory;
    protected $table='red_social_ent';
    protected $fillable = ['link', 'observ', 'entidad_id'];
}
