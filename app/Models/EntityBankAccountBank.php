<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityBankAccountBank extends Model
{
    use HasFactory;
    protected $table='entity_bank_account_banks';
    protected $fillable = ['name', 'title'];

    public function accounts(){
        return $this->hasMany('App\Models\EntityBankAccount', 'id');
    }
}
