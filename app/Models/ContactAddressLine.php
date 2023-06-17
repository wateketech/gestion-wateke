<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAddressLine extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_address_lines';
    protected $fillable = ['address_id', 'label', 'value'];

    public function address(){
        return $this->belongsTo('App\Models\ContactAddress', 'id');
    }
}
