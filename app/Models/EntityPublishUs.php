<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityPublishUs extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_publish_us';
    protected $fillable = ['entity_id', 'type_id', 'value', 'about', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\EntityPublisUslType', 'id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}