<?php

namespace App\Http\Livewire\Account\Management\UserTask\Layouts;
use App\Models\UserTask as UserTasks;
use Livewire\Component;

class Lasts extends Component
{
    public $prueba;
    public $last_metrics;

    public function mount()
    {
        $this->last_metrics = UserTasks::selectRaw('tasks.name as task, users.name as username, users.email as useremail, user_tasks.manually_time as time, user_tasks.value as value')
                ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
                ->join('users', 'users.id', '=', 'user_tasks.user_id')
                ->take(5)->get();
    }
    public function render()
    {
        return view('livewire.account.management.user-task.layouts.lasts');
    }
}
