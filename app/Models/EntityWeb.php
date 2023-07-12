<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityWeb extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_webs';
    protected $fillable = ['entity_id', 'type_id', 'value', 'meta', 'about', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\EntityWebType', 'id', 'type_id');
    }
}
