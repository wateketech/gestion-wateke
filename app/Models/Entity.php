<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $table='entitys';
    protected $fillable = ['alias', 'legal_name', 'comercial_name', 'about', 'meta', 'entity_type_id',
        'enable', 'locked', 'is_editing', 'edited_by', 'created_by', 'busy', 'busy_by'];

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





    public function edited_by_user(){
        return $this->hasOne('App\Models\User', 'edited_by', 'id')->with('user');
    }
    public function created_by_user(){
        return $this->hasOne('App\Models\User', 'created_by', 'id')->with('user');
    }


    // public function busy_by(){
    //     return $this->hasOne('App\Models\', 'busy_by', 'id')->with('process');
    // }




}
