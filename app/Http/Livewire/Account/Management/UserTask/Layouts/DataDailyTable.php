<?php

namespace App\Http\Livewire\Account\Management\UserTask\Layouts;

use Livewire\Component;
use App\Models\User;

class DataDailyTable extends Component
{
    public $users = 0;

    public function mount(){
        $this->users = User::select('users.name')
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->where('users.enable', '=', true)
            ->groupBy('users.id')->get();
    }

    public function render()
    {

        return view('livewire.account.management.user-task.layouts.data-daily-table');
    }
}
