<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWebType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_web_types';
    protected $fillable = ['label', 'enable'];

    public function webs(){
        return $this->hasMany('App\Models\ContactWeb', 'id');
    }
}
