<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityRrssType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_rrss_types';
    protected $fillable = ['label', 'icon', 'color', 'enable'];

    public function rrss(){
        return $this->hasMany('App\Models\EntityRrss', 'id');
    }
}
