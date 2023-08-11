<?php

namespace App\Http\Livewire\Dashboard\Layouts;
use App\Models\User;
use App\Models\Task;
use DateTime;

use Livewire\Component;

class UserMetrics extends Component
{

    public $prueba;
    public $today, $today_day, $today_month, $today_year, $d_month;
    public $days = [];
    public $users, $metrics, $average;

    protected $listeners = [
        'remount' => "mount",
    ];


    public function todayDate(){
        $this->today = new DateTime();
        $this->today_day = date('d');
        $this->today_month = date('m');
        $this->today_year = date('y');
        $this->d_month = cal_days_in_month(CAL_GREGORIAN, $this->today_month, $this->today_year);

        foreach (range(1, $this->d_month) as $day){
            $wday = (string) date("l", mktime(0, 0, 0, $this->today_month, $day, $this->today_year));
            array_push($this->days, [$day, $wday]);
        }

    }
    public function getTodayValue($user, $metric){
        // Los usuarios y metricas deshabititados se muesrtran en funcion de los parametros (no es necesario volver a validarlos ya que no se contruira visualmente usuarios/metricas no validadas)
        $value = User::selectRaw("SUM(user_tasks.value) as value")
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
            ->where('users.id', '=', $user )
            ->where('tasks.id', '=', $metric )
            ->whereRaw('DAY(user_tasks.manually_time) = ' .  $this->today_day)
            ->get();

        return $value[0]->value != Null ? $value[0]->value : 0;
    }

    public function getAccumulatedValue($user, $metric){
        // Los usuarios y metricas deshabititados se muesrtran en funcion de los parametros (no es necesario volver a validarlos ya que no se contruira visualmente usuarios/metricas no validadas)
        $value = User::selectRaw("SUM(user_tasks.value) as value")
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
            ->where('users.id', '=', $user )
            ->where('tasks.id', '=', $metric )
            ->whereRaw('MONTH(user_tasks.manually_time) = ' .  $this->today_month)
            ->get();

        return $value[0]->value != Null ? $value[0]->value : 0;
    }

    public function mount(){

        $this->todayDate();

        $this->users = User::select('users.id', 'users.name', 'users.email')
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->where('users.enable', '=', true)
            ->whereRaw('MONTH(user_tasks.manually_time) = ' .  $this->today_month)
            ->groupBy('users.id')
            ->get();

        $this->metrics = Task::select('tasks.id', 'tasks.name', 'tasks.average')
            ->join('user_tasks', 'user_tasks.task_id', '=', 'tasks.id')
            ->where('tasks.enable', '=', true)
            ->where('tasks.type_value', '=', 'number')
            ->whereRaw('MONTH(user_tasks.manually_time) = ' .  $this->today_month)
            ->groupBy('tasks.id')
            ->get();
    }


    public function render()
    {
        return view('livewire.dashboard.layouts.user-metrics');
    }
}
