<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedSocialAge extends Model
{
    use HasFactory;
    protected $table='red_social_age';
    protected $fillable = ['link', 'observ', 'agente_id'];
}
