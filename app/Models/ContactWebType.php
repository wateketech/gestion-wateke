<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWebType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_web_types';
    protected $fillable = ['label', 'enable'];

    public function webs(){
        return $this->hasMany('App\Models\ContactWeb', 'id');
    }
}
