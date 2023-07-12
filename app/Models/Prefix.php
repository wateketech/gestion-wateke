<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class Prefix extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='prefixs';
    protected $fillable = ['label', 'icon', 'meta', 'enable'];

    public function genders(){
        return $this->belongsToMany('App\Models\Gender', 'prefixs_genders', 'prefix_id', 'gender_id');
    }
}
