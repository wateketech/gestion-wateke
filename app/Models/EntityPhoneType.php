<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityPhoneType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='Entity_phone_types';
    protected $fillable = ['label', 'enable'];

    public function phones(){
        return $this->hasMany('App\Models\EntityPhone', 'id');
    }
}
