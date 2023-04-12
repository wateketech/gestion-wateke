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
        'name' => 'required', // |unique:table_name,column_name,except_id,id',
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
        switch ($arg[1]){
            case 'toactive' :
                foreach ($this->availableRoles as $role) {
                    if (in_array($role['id'], $arg[0]) ){
                        array_push($this->activeRoles, $role);
                        unset($this->availableRoles[array_search($role, $this->availableRoles)]);
                    }
                }break;
            case 'toavailable' :
                foreach ($this->activeRoles as $role) {
                    if (in_array($role['id'], $arg[0]) ){
                        array_push($this->availableRoles, $role);
                        unset($this->activeRoles[array_search($role, $this->activeRoles)]);
                    }
                }break;
        }
    }
    public function transferUser($arg){
        switch ($arg[1]){
            case 'toactive' :
                foreach ($this->availableUsers as $user) {
                    if (in_array($user['id'], $arg[0]) ){
                        array_push($this->activeUsers, $user);
                        unset($this->availableUsers[array_search($user, $this->availableUsers)]);
                    }
                }break;
            case 'toavailable' :
                foreach ($this->activeUsers as $user) {
                    if (in_array($user['id'], $arg[0]) ){
                        array_push($this->availableUsers, $user);
                        unset($this->activeUsers[array_search($user, $this->activeUsers)]);
                    }
                }break;
        }
    }

    //  ---------------------  RENDER ---------------------
    public function mount(){
        $this->availableRoles = \Spatie\Permission\Models\Role::all()->toArray();
        $this->availableUsers = Users::all()->toArray();
    }
    public function refresh(){
        $this->reset();
        $this->mount();
    }
    public function render()
    {
        return view('livewire.account.management.task.task');
    }
    private function loadDatas($id){
        $this->refresh();
        $metric = Tasks::find($id);
        $this->id_task = $id;
        $this->name = $metric->name;
        $this->type_value = $metric->type_value;
        $this->average = $metric->average;
        $this->about = $metric->about;

        $userData = UserHasTasks::where('task_id', $this->id_task)->pluck('user_id')->toArray();
        $roleData = RoleHasTasks::where('task_id', $this->id_task)->pluck('role_id')->toArray();
        if(count($userData)!=0){
            $this->transferUser([$userData, 'toactive']);
        }
        if(count($roleData)!=0){
            $this->transferRole([$roleData, 'toactive']);
        }
    }
    //  ---------------------  SAVE ---------------------
    public function save(){
        $validatedData = $this->validate();
        Tasks::create($validatedData);
        $task_id = Tasks::latest()->first()->id;

        $userData = [];
        foreach ($this->activeUsers as $user) {
            array_push($userData, ['task_id' => $task_id, 'user_id' => $user['id']]);
        }
        UserHasTasks::createMany($userData);

        $roleData = [];
        foreach ($this->activeRoles as $role) {
            array_push($roleData, ['task_id' => $task_id, 'role_id' => $role['id']]);
        }
        RoleHasTasks::createMany($roleData);


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
        Tasks::find($this->id_task)->update($validatedData);

        $removeUsers = array_intersect(array_column($this->availableUsers, 'id'), UserHasTasks::where('task_id', $this->id_task)->pluck('user_id')->toArray());
        $createUsers =      array_diff(array_column($this->activeUsers, 'id'), UserHasTasks::where('task_id', $this->id_task)->pluck('user_id')->toArray());

        $removeRoles = array_intersect(array_column($this->availableRoles, 'id'), RoleHasTasks::where('task_id', $this->id_task)->pluck('role_id')->toArray());
        $createRoles =      array_diff(array_column($this->activeRoles, 'id'), RoleHasTasks::where('task_id', $this->id_task)->pluck('role_id')->toArray());


        UserHasTasks::whereIn('user_id', $removeUsers)->where('task_id', $this->id_task)->delete();
        RoleHasTasks::whereIn('role_id', $removeRoles)->where('task_id', $this->id_task)->delete();

        $userData = array_map(function($user) {
            return ['task_id' => $this->id_task, 'user_id' => $user];
        }, $createUsers);
        UserHasTasks::createMany($userData);


        $roleData = array_map(function($role) {
            return ['task_id' => $this->id_task, 'role_id' => $role];
        }, $createRoles);
        RoleHasTasks::createMany($roleData);


        $this->emit('resetTable');
        $this->reset();
    }

}
