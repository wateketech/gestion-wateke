<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmailType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_email_types';
    protected $fillable = ['label', 'value', 'enable'];

    public function emails(){
        return $this->hasMany('App\Models\ContactEmail', 'id');
    }
}
