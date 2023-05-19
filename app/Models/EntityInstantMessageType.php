<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityInstantMessageType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='Entity_instant_messages';
    protected $fillable = ['label', 'enable'];

    public function instant_messages(){
        return $this->hasMany('App\Models\EntityInstantMessage', 'id');
    }
}
