<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class EntityType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_types';
    protected $fillable = ['model', 'visual_name_s', 'visual_name_p', 'icon', 'color', 'enable'];

    public function entitys(){
        return $this->hasMany('App\Models\Entity', 'type_id');
    }
}
