<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class ContactBankAccountType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_bank_account_types';
    protected $fillable = ['label', 'logo', 'color', 'regEx', 'enable'];

    public function accounts(){
        return $this->hasMany('App\Models\ContactBankAccount', 'id');
    }
}
