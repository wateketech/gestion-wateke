<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityWeb extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_webs';
    protected $fillable = ['entity_id', 'type_id', 'value', 'meta', 'about', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\EntityWebType', 'id');
    }
}
