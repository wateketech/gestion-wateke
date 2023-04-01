<?php

namespace App\Http\Livewire\Account\Management\UserTask\Layouts;
use Illuminate\Support\Facades\DB;

use App\Models\Task as Tasks;
use App\Models\UserTask as UserTasks;
use App\Models\User as User;

use DateTime;
use Livewire\Component;

class VisualTable extends Component
{
    public $prueba = 0;
    public $today, $today_day, $today_month, $today_year, $d_month;
    public $months = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] ;
    public $weeks = [ 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    public $days;
    public $colors = [  '#32CD32', '#FF6400', '#FF00FF', '#800000', '3A416F', 'e3316e', '17c1e8' ];


    public $metrics, $users, $selected_user, $selected_month;
    public $dataset, $values, $labels, $label, $data, $color;

    public $tension = 0.4;
    public $borderWidth1 = 0;
    public $pointRadius = 2;
    public $borderWidth2 = 3;
    public $maxBarThickness = 6;
    public $backgroundColor = 'transparent';

    protected $listeners = [
        'rerender' => "rerender",
    ];

    public function rerender(){
        $this->todayDate();
        $this->mount();
        $this->dispatchBrowserEvent('update-user-metrics', ['days' => $this->days ,'dataset' => $this->dataset]);
    }
    public function build_user_metrics(){
        $this->dispatchBrowserEvent('build-user-metrics', ['days' => $this->days ,'dataset' => $this->dataset]);
    }

    public function updatedSelectedUser()
    {
        $this->rerender();
    }
    public function updatedSelectedMonth()
    {
        $this->rerender();
    }
    public function todayDate(){

        if (isset($this->selected_month)){
            $this->today = date("M-d-Y", mktime(0, 0, 0, array_search($this->selected_month, $this->months)+1, 5, $this->today_year));
            $this->today_month = date('m', mktime(0, 0, 0, array_search($this->selected_month, $this->months)+1, 5, $this->today_year));
        }else{
            $this->today = new DateTime();
            $this->today_month = date('m');
        }
        $this->today_day = date('d');
        $this->today_year = date('y');
        $this->d_month = cal_days_in_month(CAL_GREGORIAN,$this->today_month, $this->today_year);
        $this->days = "[";
        foreach (range(1, $this->d_month) as $day){
            $this->days .= "'día " . $day . "',";
        }
        $this->days .= "]";  

        $this->selected_month = $this->months[$this->today_month-1];
    }

    public function mount() {
        $this->users = User::selectRaw('users.id, users.name')
                // ->join('user_tasks', 'user_tasks.user_id', '=', 'users.id')
                // ->whereRaw('count(user_tasks.user_id)')
                // ->groupBy('tasks.name')
                ->get();
        $this->metrics = UserTasks::selectRaw('tasks.name, count(tasks.name) as count')
                ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
                ->where('tasks.type_value', '=', 'number')      // metricas de tipo numerico
                ->where('user_tasks.user_id', '=', (isset($this->selected_user)) ? $this->selected_user : $this->users[0]->id)
                ->groupBy('tasks.name')
                ->get();

        // $this->values = UserTasks::selectRaw('sum(value) AS value, day(manually_time) AS DAY, MONTH(manually_time) AS MONTH, YEAR(manually_time) AS YEAR')
        //         ->where('user_tasks.user_id', '=', auth()->user()->id)
        //         ->where('user_tasks.task_id', '=', 5)
        //         ->groupBy('DAY')
        //         ->groupBy('MONTH')
        //         ->groupBy('YEAR')
        //         ->get();

                // SELECT  * FROM (


                //     ) AS tt WHERE tt.YEAR = '2023'

        $this->todayDate();
        $this->fillDataset();
    }


    public function fillDataset(){

        $this->dataset = "[";
        $this->labels = $this->days;
        for ($i=0; $i < count($this->metrics); $i++){


                $this->label = $this->metrics[$i]['name'];
                $this->color = $this->colors[$i%6] ;

                $this->data = '';


                $this->values = UserTasks::selectRaw('sum(value) AS value, day(manually_time) AS DAY, MONTH(manually_time) AS MONTH, YEAR(manually_time) AS YEAR')
                    ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
                    ->where('user_tasks.user_id', '=', (isset($this->selected_user)) ? $this->selected_user : $this->users[0]->id)
                    ->where('tasks.name', '=', $this->metrics[$i]['name'])
                    ->where('tasks.enable', '=', true)
                    ->groupBy('DAY')
                    ->groupBy('MONTH')
                    ->groupBy('YEAR')
                    ->orderBy('MONTH')
                    ->orderBy('DAY')
                    ->get();
                // ) as tt where tt.month = $this->today_month

                for ($k=1; $k < $this->d_month+1; $k++){
                    $flag = false;

                    for ($j=0; $j < count($this->values); $j++){

                        if ($this->values[$j]['MONTH'] == $this->today_month){

                            if ( $k == $this->values[$j]['DAY']){
                                $flag = true;
                                $this->data .=  $this->values[$j]['value'] . ', '  ;
                                break;
                            }
                            else
                                $flag = false;

                        }
                    }

                    if (! $flag)
                        $this->data .= '0, ';

                }




                $this->dataset .= "{
                    label: '" . $this->label . "',
                    tension: 0.4,
                    pointRadius: 2,
                    pointBackgroundColor: '" . $this->color . "',
                    borderColor: '" . $this->color . "',
                    borderWidth: 3,
                    backgroundColor: 'transparent',
                    data: [" . $this->data . "],
                    maxBarThickness: 6
                },";

        }
        $this->dataset .= "]";


    }

    public function setDaily(){

    }
    public function setWeekly(){

    }

    public function setMonthly(){

    }




    public function render()
    {
        return view('livewire.account.management.user-task.layouts.visual-table');
    }

    public function setDataset(){

    }

}
