<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityInstantMessageType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_instant_message_types';
    protected $fillable = ['label', 'regEx', 'enable'];

    public function instant_messages(){
        return $this->hasMany('App\Models\EntityInstantMessage', 'id');
    }
}
