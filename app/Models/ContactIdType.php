<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class ContactIdType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_id_types';
    protected $fillable = ['label', 'title', 'icon', 'regEx', 'enable'];

    public function ids(){
        return $this->hasMany('App\Models\ContactId', 'id');
    }
}
