<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $table='entitys';
    protected $fillable = ['name', 'legal_name', 'is_mainoffice', 'is_retail', 'nif', 'iata', 'rp', 'about'];

    public function entity_emails()
    {
        return $this->hasMany('App\EntityEmails', 'entity_id');
    }
    // public function telefono_ent()
    // {
    //     return $this->hasMany('App\TelefonoEnt', 'entidad_id');
    // }
    // public function red_social_ent()
    // {
    //     return $this->hasMany('App\RedSocialEnt', 'entidad_id');
    // }


    // public function web_ent()
    // {
    //     return $this->hasMany('App\WebEnt', 'entidad_id');
    // }
    // public function nos_publica_ent()
    // {
    //     return $this->hasMany('App\NosPublica', 'entidad_id');
    // }
    // public function cuenta_bancaria_ent()
    // {
    //     return $this->hasMany('App\CuentaBancariaEnt', 'entidad_id');
    // }




}
