<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInstantMessageType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_instant_message_types';
    protected $fillable = ['label', 'enable'];

    public function instant_messages(){
        return $this->hasMany('App\Models\InstantMessage', 'id');
    }
}
