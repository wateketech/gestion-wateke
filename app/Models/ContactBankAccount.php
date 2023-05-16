<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactBankAccount extends Model
{
    use HasFactory;
    protected $table='contact_bank_accounts';
    protected $fillable = ['contact_id', 'type_id', 'bank_id', 'card_number', 'card_holder', 'expiration_date', 'is_credit', 'about', 'enable'];
    public function type(){
        return $this->belongsTo('App\Models\ContactBankAccountType', 'id');
    }
    public function bank(){
        return $this->belongsTo('App\Models\ContactBankAccountBank', 'id');
    }
}
