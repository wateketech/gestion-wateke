<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityId extends Model
{
    protected $table='entity_ids';
    protected $fillable = ['entity_id', 'type_id', 'value', 'meta',];

    public function type(){
        return $this->hasOne('App\Models\EntityIdType', 'id', 'type_id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}
