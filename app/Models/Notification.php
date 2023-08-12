<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $fillable = ['message','is_html','type_id','frequency_id','priority_id','is_persistent','deaddate','redirect','enable','meta'];

    public function type(){
        return $this->belongsTo('App\Models\NotificationType', 'type_id');
    }

    public function frequency(){
        return $this->belongsTo('App\Models\NotificationFrequency', 'frequency_id');
    }

    public function priority(){
        return $this->belongsTo('App\Models\NotificationPriority', 'priority_id');
    }
    

}
