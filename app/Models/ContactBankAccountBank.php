<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactBankAccountBank extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_bank_account_banks';
    protected $fillable = ['name', 'title', 'meta', 'enable'];

    public function accounts(){
        return $this->hasMany('App\Models\ContactBankAccount', 'id');
    }
}
