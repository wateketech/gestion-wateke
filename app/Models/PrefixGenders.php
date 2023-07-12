<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class PrefixGenders extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='prefixs_genders';
    protected $fillable = ['gender_id', 'prefix_id'];

    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function prefixs()
    {
        return $this->belongsTo('App\Models\Prefix', 'prefix_id');
    }
}
