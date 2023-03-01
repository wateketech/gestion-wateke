<?php

namespace App\Http\Livewire\Account\Management\UserTask\Layouts;

use Livewire\Component;
use App\Models\User;
use DateTime;

class DataDailyTable extends Component
{
    public $today, $today_day, $today_month, $today_year, $d_month;
    public $days = [];
    public $users = 0;

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

    public function mount(){
        $this->users = User::select('users.name')
            ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
            ->where('users.enable', '=', true)
            ->groupBy('users.id')->get();

        $this->todayDate();
    }

    public function render()
    {

        return view('livewire.account.management.user-task.layouts.data-daily-table');
    }
}
