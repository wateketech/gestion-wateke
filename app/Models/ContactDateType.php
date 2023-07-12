<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Model;

class contactDateType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_date_types';
    protected $fillable = ['label', 'color', 'icon', 'enable'];

    public function dates(){
        return $this->hasMany('App\Models\ContactDate', 'id');
    }
}
