<?php

namespace App\Http\Livewire\Dashboard\Layouts;

use Exception;
use Livewire\Component;
use App\Models\UserTask;
use DateTime;

class Budgets extends Component
{
    public $prueba;
    public $view = 'days';
    public $views = ['days', 'months', 'years'];
    public $today, $today_day, $today_month, $today_year, $d_month;
    public $days = [];
    public $users, $metrics, $average;

    public $received_budgets;
    public $answered_budgets;
    public $budgets_bookings;
    public $conversion_rate;

    public function todayDate(){
        $this->today = new DateTime();
        $this->today_day = date('d');
        $this->today_month = date('m');
        $this->today_year = date('Y');
        $this->d_month = cal_days_in_month(CAL_GREGORIAN,$this->today_month, $this->today_year);

        foreach (range(1, $this->d_month) as $day){
            $wday = (string) date("l", mktime(0, 0, 0, $this->today_month, $day, $this->today_year));
            array_push($this->days, [$day, $wday]);
        }

    }

    public function mount(){

        $this->todayDate();

        $this->received_budgets = $this->get_received_budgets('MONTH');

        $this->answered_budgets = $this->get_answered_budgets('MONTH');

        $this->budgets_bookings = $this->get_budgets_bookings('MONTH');

        $this->conversion_rate = (intval($this->get_budgets_bookings('YEAR')) == 0) ? 0
            : $this->get_answered_budgets('YEAR') / $this->get_budgets_bookings('YEAR');


    }





    public function render()
    {
        return view('livewire.dashboard.layouts.budgets');
    }


    public function get_received_budgets($group){

        if ($group == 'DAY'){
            $gb = $this->today_day;
        }
        else if ($group == 'MONTH'){
            $gb = $this->today_month;
        }
        else if ($group == 'YEAR'){
            $gb = $this->today_year;
        }

        $temp = (UserTask::selectRaw('SUM(user_tasks.value) AS value, ' . $group . '(manually_time) AS ' . $group)
        ->join('tasks', 'tasks.id', 'user_tasks.task_id')
        ->where('tasks.name', 'LIKE', '%Presupuestos Solicitados%')
        ->whereRaw($group . '(user_tasks.manually_time) = ' .  $gb)
        ->groupBy($group)
        ->get());

        return (count($temp) > 0) ? $temp[0]->value : 0;

    }



    public function get_answered_budgets($group){

        if ($group == 'DAY'){
            $gb = $this->today_day;
        }
        else if ($group == 'MONTH'){
            $gb = $this->today_month;
        }
        else if ($group == 'YEAR'){
            $gb = $this->today_year;
        }

        $answered_budgets = (UserTask::selectRaw('SUM(user_tasks.value) AS value, ' . $group . '(manually_time) AS ' . $group)
        ->join('tasks', 'tasks.id', 'user_tasks.task_id')
        ->where('tasks.name', 'LIKE', '%Presupuestos Respondidos%')
        ->whereRaw($group . '(user_tasks.manually_time) = ' .  $gb)
        ->groupBy($group)
        ->get());

        return (count($answered_budgets) > 0) ? $answered_budgets[0]->value : 0;

    }


    public function get_budgets_bookings($group){

        if ($group == 'DAY'){
            $gb = $this->today_day;
        }
        else if ($group == 'MONTH'){
            $gb = $this->today_month;
        }
        else if ($group == 'YEAR'){
            $gb = $this->today_year;
        }

        $budgets_bookings = (UserTask::selectRaw('SUM(user_tasks.value) AS value, ' . $group . '(manually_time) AS ' . $group)
        ->join('tasks', 'tasks.id', 'user_tasks.task_id')
        ->where('tasks.name', 'LIKE', '%Reservas en Firme%')
        ->whereRaw($group . '(user_tasks.manually_time) = ' .  $gb)
        ->groupBy($group)
        ->get());

        return (count($budgets_bookings) > 0) ? $budgets_bookings[0]->value : 0;

    }



}
