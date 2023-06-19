<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityPhone extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_phones';
    protected $fillable = ['entity_id', 'type_id', 'value', 'value_meta', 'about', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\EntityPhoneType', 'id', 'type_id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}
