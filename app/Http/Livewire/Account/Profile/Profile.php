<?php

namespace App\Http\Livewire\Account\Profile;
use App\Models\User;

use Livewire\Component;

class Profile extends Component
{
    public User $user;
    public $showSuccesNotification  = true;

    public $showDemoNotification = false;
    
    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.email' => 'email:rfc,dns',
        'user.phone' => 'max:10',
        'user.about' => 'max:200',
        'user.location' => 'min:3'
    ];

    public function mount() { 
        $this->user = auth()->user();
    }

    public function save() {
        if(env('IS_DEMO')) {
           $this->showDemoNotification = true;
        } else {
            $this->validate();
            $this->showSuccesNotification = true;
            // $this->user->save();
        }
    }
    public function render()
    {
        return view('livewire.account.profile.profile');
    }
}
