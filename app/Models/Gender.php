<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class Gender extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='genders';
    protected $fillable = ['label', 'pronoun', 'icon', 'meta', 'enable'];

    public function prefixs(){
        return $this->belongsToMany('App\Models\Prefix', 'prefixs_genders', 'gender_id', 'prefix_id');
    }
}
