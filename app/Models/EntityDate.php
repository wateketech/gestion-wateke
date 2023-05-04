<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityDate extends Model
{
    use HasFactory;
    protected $table='entity_dates';
    protected $fillable = ['entity_id', 'type_id', 'value'];

    public function type(){
        return $this->belongsTo('App\Models\EntityDateType', 'id');
    }
}
