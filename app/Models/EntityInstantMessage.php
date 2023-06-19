<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityInstantMessage extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_instant_messages';
    protected $fillable = ['entity_id', 'type_id', 'meta', 'value', 'about', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\EntityInstantMessageType', 'id', 'type_id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}



