<?php

namespace App\Http\Livewire\Account\Management\UserTask;
use App\Models\UserTask as UserTasks;
use App\Models\Task as Tasks;
use App\Models\User as Users;

use Livewire\Component;

class UserTask extends Component
{
    public $prueba;
    public $view;
    public $id_user_task, $task_id, $user_id, $value, $manually_time, $about;
    public $users, $tasks;

    protected $listeners = [
        'viewCreate-user-metric' => "view_create",
        'viewUpdate-user-metric' => 'view_update',
        'deleteComfirmed-user-metric' => 'deleteComfirmed',
        'delete-user' => 'delete',
        'update-user' => 'update',
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

    public function mount()
    {
        $this->tasks = Tasks::select('id', 'name')->where('enable', '=', true)->get();
        $this->users = Users::select('id', 'name')->where('enable', '=', true)->get();
    }
    //  ---------------------  RENDER ---------------------
    public function updatedView(){
        $this->tasks = Tasks::select('id', 'name')->where('enable', '=', true)->get();
        if (count($this->tasks) > 0){    $this->task_id = $this->tasks[0]['id'];   }
        $this->users = Users::select('id', 'name')->where('enable', '=', true)->get();
        if (count($this->users) > 0){    $this->user_id = $this->users[0]['id'];   }
    }
    public function updated(){
        $this->task_id = (int) $this->task_id;
        $this->user_id = (int) $this->user_id;
        // $this->manually_time = (int) $this->id_usuario;
    }

    public function refresh(){
        $this->emitTo('account.management.user-task.layouts.lasts', 'remount');
        $this->emitTo('account.management.user-task.layouts.data-table', 'remount');
        $this->emitTo('account.management.user-task.layouts.visual-table', 'rerender');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.account.management.user-task.user-task');
    }
    private function loadDatas($id){
        $rel = UserTasks::find($id);
        $this->id_user_task = $rel->id;
        $this->task_id = $rel->task_id;
        $this->user_id = $rel->user_id;
        $this->value = $rel->value;
        $this->manually_time = $rel->manually_time;
        $this->about = $rel->about;
    }
    //  ---------------------  SAVE ---------------------
    public function view_create(){
        $this->view = 'create';
        $this->tasks = Tasks::select('id', 'name')->where('enable', '=', true)->get();
        if (count($this->tasks) > 0){    $this->task_id = $this->tasks[0]['id'];   }
        $this->users = Users::select('id', 'name')->where('enable', '=', true)->get();
        if (count($this->users) > 0){    $this->user_id = $this->users[0]['id'];   }
    }   
    public function save(){
        $validatedData = $this->validate();
        UserTasks::create($validatedData);

        $this->dispatchBrowserEvent('show-metric-asignComfirmed');
        $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  DELETE ---------------------
    public function deleteComfirmed($id){
        $this->loadDatas($id);
        $this->dispatchBrowserEvent('show-metric-user-deleteComfirmed');
    }
    public function delete(){
        UserTasks::destroy($this->id_user_task);
        $this->emit('resetTable');
        $this->refresh();
    }

    //  ---------------------  UPDATE ---------------------
    public function view_update($id){
        $this->loadDatas($id);
        $this->view = 'edit' ;
    }
    public function updateComfirmed(){
        $this->validate();
        $this->dispatchBrowserEvent('show-metric-user-updateComfirmed');
    }
    public function update(){
        $validatedData = $this->validate();

        UserTasks::find($this->id_user_task)
            ->update($validatedData);

        $this->emit('resetTable');
        $this->refresh();
    }

}
