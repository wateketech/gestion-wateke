<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityPublishUsType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_publish_us_types';
    protected $fillable = ['label', 'enable'];

    public function publish_us(){
        return $this->hasMany('App\Models\EntityPublishUs', 'id');
    }
}
