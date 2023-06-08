<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $table='entitys';
    protected $fillable = ['alias', 'legal_name', 'comercial_name', 'about', 'meta', 'enable', 'entity_type_id'];

    public function entity_type(){
        return $this->hasOne('App\Models\EntityType', 'id');
    }
    public function bank_accounts(){
        return $this->hasMany('App\Models\EntityBankAccount', 'entity_id');
    }
    public function dates(){
        return $this->hasMany('App\Models\EntityDate', 'entity_id');
    }
    public function emails(){
        return $this->hasMany('App\Models\EntityEmail', 'entity_id');
    }
    public function ids(){
        return $this->hasMany('App\Models\EntityId', 'entity_id');
    }
    public function instant_messages(){
        return $this->hasMany('App\Models\EntityInstantMessage', 'entity_id');
    }
    public function phones(){
        return $this->hasMany('App\Models\EntityPhone', 'entity_id');
    }
    public function logos(){
        return $this->hasMany('App\Models\EntityLogo', 'entity_id');
    }
    public function publish_us(){
        return $this->hasMany('App\Models\EntityPublishUs', 'entity_id');
    }
    public function rrss(){
        return $this->hasMany('App\Models\EntityRrss', 'entity_id');
    }
    public function webs(){
        return $this->hasMany('App\Models\EntityWeb', 'entity_id');
    }










}
