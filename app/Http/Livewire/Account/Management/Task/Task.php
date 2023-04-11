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
        'update-metric' => 'update',

        'transferRoleToActiveEvent', 'transferRoleToAvailableEvent', 'transferUserToActiveEvent', 'transferUserToAvailableEvent',
        'transferRoleToActive' => 'transferRole',
        'transferRoleToAvailable' => 'transferRole',
        'transferUserToActive' => 'transferUser',
        'transferUserToAvailable' => 'transferUser',


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
    public function transferRoleToActiveEvent() {   $this->dispatchBrowserEvent('transferRoleToActiveEvent');    }
    public function transferRoleToAvailableEvent(){ $this->dispatchBrowserEvent('transferRoleToAvailableEvent'); }
    public function transferUserToActiveEvent() {    $this->dispatchBrowserEvent('transferUserToActiveEvent');   }
    public function transferUserToAvailableEvent(){  $this->dispatchBrowserEvent('transferUserToAvailableEvent');}

    //  ---------------------  TRANSFER-All ---------------------
    public function transferAllUsersToActive(){
        $this->availableUsers = [];
        $this->activeUsers = Users::all()->toArray();
    }
    public function transferAllUsersToAvailable(){
        $this->availableUsers = Users::all()->toArray();
        $this->activeUsers = [];
    }
    public function transferAllRolesToActive(){
        $this->availableRoles = [];
        $this->activeRoles = \Spatie\Permission\Models\Role::all()->toArray();
    }
    public function transferAllRolesToAvailable(){
        $this->activeRoles = [];
        $this->availableRoles = \Spatie\Permission\Models\Role::all()->toArray();
    }
    //  ---------------------  TRANSFER-ONE ---------------------
    public function transferRole($arg){
        if ($arg[1] == 'toactive') {
            foreach ($this->availableRoles as $role) {
                if (in_array($role['id'], $arg[0]) ){
                    array_push($this->activeRoles, $role);
                    unset($this->availableRoles[array_search($role, $this->availableRoles)]);
                }
            }
        }
        else if ($arg[1] == 'toavailable') {
            foreach ($this->activeRoles as $role) {
                if (in_array($role['id'], $arg[0]) ){
                    array_push($this->availableRoles, $role);
                    unset($this->activeRoles[array_search($role, $this->activeRoles)]);
                }
            }
        }
    }
    public function transferUser($arg){

        if ($arg[1] == 'toactive') {
            foreach ($this->availableUsers as $user) {
                if (in_array($user['id'], $arg[0]) ){
                    array_push($this->activeUsers, $user);
                    unset($this->availableUsers[array_search($user, $this->availableUsers)]);
                }
            }
        }
        else if ($arg[1] == 'toavailable') {
            foreach ($this->activeUsers as $user) {
                if (in_array($user['id'], $arg[0]) ){
                    array_push($this->availableUsers, $user);
                    unset($this->activeUsers[array_search($user, $this->activeUsers)]);
                }
            }
        }
    }

    //  ---------------------  RENDER ---------------------
    public function mount(){
        $this->availableRoles = \Spatie\Permission\Models\Role::all()->toArray();
        $this->availableUsers = Users::all()->toArray();
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
