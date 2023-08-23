<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];





    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withTimestamps();
    }
    public function link_contact()
    {
        return $this->hasOne('App\Models\ContactLinkUser', 'user_id', 'id')->with('contact');
    }

    public function is_editing_contact()
    {
        return $this->hasMany('App\Models\Contact', 'edited_by')->where('is_editing', true);
    }



}
