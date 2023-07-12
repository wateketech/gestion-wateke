<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class Prefix extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='prefixs';
    protected $fillable = ['label', 'icon', 'meta', 'enable'];

    public function genders(){
        return $this->belongsToMany('App\Models\Gender', 'prefixs_genders', 'prefix_id', 'gender_id');
    }
}
