<?php

namespace App\Http\Livewire\Account\Profile;
use App\Models\User as User;
use App\Models\UserHasTasks as UserHasTasks;
use App\Models\RoleHasTasks as RoleHasTasks;

use Livewire\Component;

class Profile extends Component
{

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

    public function mount() {
        $this->user = auth()->user();

        $this->visit =
            (count(RoleHasTasks::whereIn('role_has_tasks.role_id', auth()->user()->roles()->pluck('id')->toArray())
                ->where('tasks.enable', '=', '1')->where('tasks.id', '=', '1')->orWhere('tasks.name', '=', 'Visitas Comerciale3s')
                ->join('tasks', 'tasks.id', '=', 'role_has_tasks.task_id')->get()) !=0 ) ||
            (count (UserHasTasks::where('user_has_tasks.user_id', '=', auth()->user()->id)->where('tasks.enable', '=', '1')->where('tasks.id', '=', '1')->orWhere('tasks.name', '=', 'Visitas Comerciale3s')
                ->join('tasks', 'tasks.id', '=', 'user_has_tasks.task_id')->get()) !=0 )
            ? true : false;


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
