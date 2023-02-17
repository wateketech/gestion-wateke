<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;
    protected $table='agente';
    protected $fillable = ['nombre', 'apellido', 'cargo', 'cumpleagno', 'entidad_id'];


    public function correo_age()
    {
        return $this->hasMany('App\CorreoAge', 'agente_id');
    }
    public function telefono_age()
    {
        return $this->hasMany('App\TelefonoAge', 'agente_id');
    }
    public function red_social_age()
    {
        return $this->hasMany('App\RedSocialAge', 'agente_id');
    }
}
