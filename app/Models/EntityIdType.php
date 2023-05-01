<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class EntityIdType extends Model
{
    use MassAssignmentConcerns;
    protected $table='entity_id_types';
    protected $fillable = ['label', 'title', 'regEx'];

    public function type(){
        return $this->belongsTo('App\Models\EntityId', 'id');
    }
}
