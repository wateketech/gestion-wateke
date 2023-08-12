<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactBankAccountBank extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_bank_account_banks';
    protected $fillable = ['name', 'title', 'meta', 'enable'];

    public function accounts(){
        return $this->hasMany('App\Models\ContactBankAccount', 'id');
    }
}
