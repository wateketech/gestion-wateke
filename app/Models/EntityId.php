<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityId extends Model
{
    protected $table='entity_ids';
    protected $fillable = ['entity_id', 'type_id', 'value'];

    public function type(){
        return $this->hasOne('App\Models\EntityIdType', 'id');
    }
}
