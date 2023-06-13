<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class Gender extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='genders';
    protected $fillable = ['label', 'pronoun', 'icon', 'meta', 'enable'];

    public function prefixs(){
        return $this->belongsToMany('App\Models\Prefix', 'prefixs_genders', 'gender_id', 'prefix_id');
    }
}
