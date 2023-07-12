<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Model;

class EntityLogo extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_logos';
    protected $fillable = ['entity_id', 'label', 'name', 'store', 'meta', 'label', 'is_primary', 'enable'];
    public function entity(){
        return $this->belongsTo('App\Models\Entity', 'id');
    }
}
