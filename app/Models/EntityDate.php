<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityDate extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_dates';
    protected $fillable = ['entity_id', 'type_id', 'meta', 'value'];

    public function type(){
        return $this->hasOne('App\Models\EntityDateType', 'id', 'type_id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}
