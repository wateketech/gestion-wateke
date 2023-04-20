<?php

namespace App\Http\Livewire\Account\Profile;
use App\Models\User as User;
use App\Models\UserHasVisits as UserHasVisits;

use Livewire\Component;

class Profile extends Component
{
    public $prueba;
    public $visit = false;
    public $user;
    public $showSuccesNotification  = true;

    public $showDemoNotification = false;

    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.email' => 'email:rfc,dns',
        'user.phone' => 'max:10',
        'user.about' => 'max:200',
        'user.location' => 'min:3'
    ];
    protected $listeners = [
        'refresh',
    ];

    public function refresh(){
        $this->reset();
        $this->mount();
    }
    public function mount() {
        $this->user = auth()->user();

        $this->visit = (count (UserHasVisits::where('user_has_visits.user_id', '=', auth()->user()->id)->where('user_has_visits.enable', 1)->get()) !=0 ) ? true : false;
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
