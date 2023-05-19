<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityDate extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_dates';
    protected $fillable = ['entity_id', 'type_id', 'value'];

    public function type(){
        return $this->belongsTo('App\Models\EntityDateType', 'id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}
