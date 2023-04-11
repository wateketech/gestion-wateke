<?php

namespace App\Http\Livewire\Account\Management\Task;
use App\Models\Task as Tasks;
use App\Models\User as Users;
use App\Models\UserHasTasks as UserHasTasks;
use App\Models\RoleHasTasks as RoleHasTasks;

use Livewire\Component;

class Task extends Component
{
    public $prueba;
    public $view;
    public $id_task, $name, $average, $about;
    private $enable = true;
    public $type_value = 'number';
    public $type_values = ['number' =>'Cuantitativo',]; // 'text' => 'Cualitativo', 'datetime-local' => 'Fecha'];
    public $type_frec = 'daily';
    public $type_frecs = ['daily' =>'Diaria', 'weekly' => 'Semanal', 'monthly' => 'Mensual'];

    protected $listeners = [
        'viewUpdate-metric' => 'view_update',
        'deleteComfirmed-metric' => 'deleteComfirmed',
        'delete-metric' => 'delete',
        'update-metric' => 'update'
    ];
    protected $rules = [
        'name' => 'required',
        'type_value' => 'required',
        'average' => 'required',
        'type_frec' => 'required',
        'about' => 'nullable'
    ];
    protected $messages = [
        '*.required' => 'Campo Oblitgatorio'
    ];

    public $availableRoles = [];
    public $availableUsers = [];
    public $activeRoles = [];
    public $activeUsers = [];
    public $selectedRoles = [];
    public $selectedUsers = [];
    //  ---------------------  TRANSFER-All ---------------------

    public function transferAllUsers($to){
        if ($to == 'active') {
            $this->activeUsers = $this->availableUsers;
            $this->availableUsers = [];
        }
        else if ($to == 'avaible') {
            $this->availableUsers = $this->activeUsers;
            $this->activeUsers = [];
        } 
    }
    public function transferAllRoles($to){
        if ($to == 'active') {
            $this->activeRoles = $this->availableRoles;
            $this->availableRoles = [];
        }
        else if ($to == 'avaible') {
            $this->availableRoles = $this->activeRoles;
            $this->activeRoles = [];
        } 
    }
    //  ---------------------  TRANSFER-ONE ---------------------

    public function transferUser($to){
        if ($to == 'active') {
            
        }
        else if ($to == 'avaible') {

        } 
    }
    public function transferRole($to){
        if ($to == 'active') {
            
        }
        else if ($to == 'avaible') {

        } 
    }
    //  ---------------------  RENDER ---------------------

    public function mount(){
        $this->availableRoles = \Spatie\Permission\Models\Role::all();
        $this->availableUsers = Users::all();
    }
    public function refresh(){
        $this->reset();
    }
    public function render()
    {
        return view('livewire.account.management.task.task');
    }
    private function loadDatas($id){
        $metric = Tasks::find($id);
        $this->id_task = $id;
        $this->name = $metric->name;
        $this->type_value = $metric->type_value;
        $this->average = $metric->average;
        $this->about = $metric->about;
    }
    //  ---------------------  SAVE ---------------------
    public function save(){
        $validatedData = $this->validate();
        Tasks::create($validatedData);

        $this->dispatchBrowserEvent('show-metric-createComfirmed');
        $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  DELETE ---------------------
    public function deleteComfirmed($id){
        $this->loadDatas($id);
        $this->dispatchBrowserEvent('show-metric-deleteComfirmed');
    }
    public function delete(){
        Tasks::find($this->id_task)
            ->update(['enable' => false]);
        $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  UPDATE ---------------------
    public function view_update($id){
        $this->loadDatas($id);
        $this->view = 'edit' ;
    }
    public function updateComfirmed(){
        $this->dispatchBrowserEvent('show-metric-updateComfirmed');
    }
    public function update(){
        $validatedData = $this->validate();

        Tasks::find($this->id_task)
            ->update($validatedData);

        $this->emit('resetTable');
        $this->reset();
    }

}
