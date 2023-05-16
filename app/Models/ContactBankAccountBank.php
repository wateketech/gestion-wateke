<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactBankAccountBank extends Model
{
    use HasFactory;
    protected $table='contact_bank_account_banks';
    protected $fillable = ['name', 'title'];

    public function accounts(){
        return $this->hasMany('App\Models\ContactBankAccount', 'id');
    }
}
