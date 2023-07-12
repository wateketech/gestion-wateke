<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityRrss extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_rrss';
    protected $fillable = ['entity_id', 'type_id', 'value', 'meta', 'about', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\EntityRrssType', 'id', 'type_id');
    }
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}
