<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Model;

class EntityDateType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_date_types';
    protected $fillable = ['label'];

    public function dates(){
        return $this->hasMany('App\Models\EntityDate', 'id');
    }
}
