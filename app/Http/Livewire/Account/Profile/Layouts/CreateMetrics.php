<?php

namespace App\Http\Livewire\Account\Profile\Layouts;
use App\Models\UserTask as UserTasks;
use App\Models\Task as Tasks;
use App\Models\User as Users;

use Livewire\Component;

class CreateMetrics extends Component
{
    public $isVisible = false;
    public $prueba;
    public $id_user_task, $task_id, $user_id, $value, $manually_time, $about;
    public $tasks;

    protected $listeners = [
        'showCreate' => "showCreate",
    ];
    // public $validatedData;
    protected $rules = [
        'task_id' => 'required',
        'user_id' => 'required',
        'value' => 'required|numeric',
        'manually_time' => 'required|date',
        'about' => ''
    ];
    protected $messages = [
        '*.required' => 'El campo es obligatorio',
        'value.numeric' => 'El valor tiene que ser numerico',
    ];

    public function showCreate(){
        $this->isVisible = true;
    }
    public function mount()
    {
        $this->isVisible = false;
        $this->tasks = Tasks::select('id', 'name')->where('enable', '=', true)->get();
        $this->user_id = auth()->user()->id;
        if (count($this->tasks) > 0){    $this->task_id = $this->tasks[0]['id'];   }
    }
    //  ---------------------  RENDER ---------------------
    public function refresh(){
        // renderizar la tabla
        $this->emitTo('account.profile.layouts.metrics', 'rerefresh');
        $this->reset();
        $this->mount();
    }
    public function render()
    {
        return view('livewire.account.profile.layouts.create-metrics');
    }

    //  ---------------------  SAVE ---------------------
    public function save(){
        $this->user_id = auth()->user()->id;
        $validatedData = $this->validate();
        UserTasks::create($validatedData);

        $this->dispatchBrowserEvent('show-metric-asignComfirmed');
        $this->refresh();
    }
}
