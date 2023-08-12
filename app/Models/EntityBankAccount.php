<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityBankAccount extends Model
{
    use HasFactory;
    protected $table='entity_bank_accounts';
    protected $fillable = ['entity_id', 'type_id', 'bank_id', 'card_number', 'card_holder', 'expiration_date', 'is_credit', 'meta', 'about', 'enable'];
    public function type(){
        return $this->belongsTo('App\Models\EntityBankAccountType', 'id');
    }
    public function bank(){
        return $this->belongsTo('App\Models\EntityBankAccountBank', 'id');
    }
    public function entity(){
        return $this->hasOne('App\Models\Entity', 'id', 'type_id');
    }
}
