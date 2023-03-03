<?php

namespace App\Http\Livewire\Account\Management\UserTask\Layouts;

use Livewire\Component;
use App\Models\User;
use App\Models\Task;
use DateTime;

class DataTable extends Component
{
    public $prueba;
    public $tableview = 'days';
    public $tableviews = ['days', 'months', 'years'];
    public $today, $today_day, $today_month, $today_year, $d_month;
    public $days = [];
    public $users, $metrics, $average;
    public $task_name = "Presupuestos Respondidos por Correo";
    public $task_names = ['Presupuestos Respondidos por Correo', 'Presupuestos Respondidos por Web', 'Presupuestos Respondidos por Movil'];

    public function todayDate(){
        $this->today = new DateTime();
        $this->today_day = date('d');
        $this->today_month = date('m');
        $this->today_year = date('y');
        $this->d_month = cal_days_in_month(CAL_GREGORIAN,$this->today_month, $this->today_year);

        foreach (range(1, $this->d_month) as $day){
            $wday = (string) date("l", mktime(0, 0, 0, $this->today_month, $day, $this->today_year));
            array_push($this->days, [$day, $wday]);
        }

    }
    public function updatedTaskName(){
        $this->average = (Task::select('tasks.average')
            ->where('tasks.name', '=', $this->task_name)
            ->get())[0]->average;


        $this->users = User::select('users.name', 'users.email')
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
            ->where('tasks.name', '=',  $this->task_name)
            ->where('users.enable', '=', true)
            ->groupBy('users.id')
            ->get();


    }

    public function getMetric($day, $user)
    {
        // las metricas deshabilitadas se controlan en la generacion del combobox a elegir
        $metric = User::selectRaw("SUM( user_tasks.value) AS value, DAY(user_tasks.manually_time) as day")
        ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
        ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
        ->where('tasks.name', '=', $this->task_name )
        ->whereRaw('MONTH(user_tasks.manually_time) = ' .  $this->today_month)
        ->whereRaw('DAY(user_tasks.manually_time) = '. $day)
        // ->where('user_tasks.manually_time', '=', $this->today_month)
        ->where('users.email', '=', $user)
        ->groupBy('day')
        ->get();

        return $metric;
    }

    public function mount(){
        $this->average = (Task::select('tasks.average')
        ->where('tasks.name', '=', $this->task_name)
            ->get())[0]->average;

        $this->users = User::select('users.name', 'users.email')
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
            ->where('tasks.name', '=', $this->task_name)
            ->where('users.enable', '=', true)
            ->groupBy('users.id')
            ->get();

        $this->todayDate();
    }

    public function render()
    {

        return view('livewire.account.management.user-task.layouts.data-table');
    }
}
