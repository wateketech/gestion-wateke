<?php

namespace App\Http\Livewire\Account\Profile\Layouts;

use App\Models\Task as Tasks;
use App\Models\UserTask as UserTasks;

use DateTime;
use Livewire\Component;

class Metrics extends Component
{
    public $prueba;
    public $today, $today_day, $today_month, $today_year, $d_month;
    public $months = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] ;
    public $weeks = [ 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    public $days;
    public $colors = [  '#32CD32', '#FAF0E6', '#FF00FF', '#800000', '3A416F', 'e3316e', '17c1e8' ];




    public $metrics;
    public $dataset = '';
    public $label, $data;
    public $pointBackgroundColor, $borderColor;

    public $tension = 0.4;
    public $borderWidth1 = 0;
    public $pointRadius = 2;
    public $borderWidth2 = 3;
    public $maxBarThickness = 6;
    public $backgroundColor = 'transparent';


    public function todayDate(){
        $this->today = new DateTime();
        $this->today_day = date('d');
        $this->today_month = date('m');
        $this->today_year = date('y');
        $this->d_month = cal_days_in_month(CAL_GREGORIAN,$this->today_month, $this->today_year);
        $this->days = range(0, $this->d_month);
    }

    public function mount() {
        $this->metrics = UserTasks::select('tasks.name', 'user_tasks.value', 'user_tasks.manually_time')
                ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
                ->where('user_tasks.user_id', '=', auth()->user()->id)
                ->get();

        $this->todayDate();
        $this->fillDataset();
    }

    public function fillDataset(){


        $this->dataset = "{
                label: 'Valor Promedio',
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 2,
                pointBackgroundColor: '#e3316e',
                borderColor: '#e3316e',
                borderWidth: 3,
                backgroundColor: 'transparent',
                data: [50, 50, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6
              },";
    }

    public function setDaily(){

    }
    public function setWeekly(){

    }

    public function setMonthly(){

    }






    public function render()
    {
        return view('livewire.account.profile.layouts.metrics');
    }


    public function setDataset(){

    }

}
