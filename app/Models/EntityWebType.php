<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityWebType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_web_types';
    protected $fillable = ['label', 'enable'];

    public function web(){
        return $this->hasMany('App\Models\EntityWeb', 'id');
    }
}
