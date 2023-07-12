<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class ContactIdType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_id_types';
    protected $fillable = ['label', 'title', 'icon', 'regEx', 'enable'];

    public function ids(){
        return $this->hasMany('App\Models\ContactId', 'id');
    }
}
