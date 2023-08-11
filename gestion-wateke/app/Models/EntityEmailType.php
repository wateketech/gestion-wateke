<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityEmailType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_email_types';
    protected $fillable = ['label', 'value', 'enable'];

    public function emails(){
        return $this->hasMany('App\Models\EntityEmail', 'id');
    }
}
