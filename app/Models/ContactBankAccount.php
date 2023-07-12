<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactBankAccount extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_bank_accounts';
    protected $fillable = ['contact_id', 'type_id', 'bank_id', 'card_number', 'card_holder', 'expiration_date', 'is_credit', 'meta', 'about', 'enable'];
    public function type(){
        return $this->hasOne('App\Models\ContactBankAccountType', 'id', 'type_id');
    }
    public function bank(){
        return $this->hasOne('App\Models\ContactBankAccountBank', 'id', 'bank_id');
    }
    public function contact(){
        return $this->hasOne('App\Models\Contact', 'id', 'type_id');
    }
}
