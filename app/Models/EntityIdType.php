<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class EntityIdType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_id_types';
    protected $fillable = ['label', 'title', 'regEx'];

    public function ids(){
        return $this->hasMany('App\Models\EntityId', 'id');
    }
}
