<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRrssType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_rrss_types';
    protected $fillable = ['label', 'enable'];

    public function rrss(){
        return $this->hasMany('App\Models\ContactRrss', 'id');
    }
}
