<?php

namespace App\Http\Livewire\Account\Management\User;
use App\Models\User as Users;
use App\Models\UserRole as UserRoles;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class User extends Component
{

    public $prueba;
    public $view;
    public $id_user, $name, $email, $role, $public_password;
    public $password;
    public $roles;

    protected $listeners = [
        'viewUpdate-user' => 'view_update',
        'deleteComfirmed-user' => 'deleteComfirmed',
        'delete-user' => 'delete',
        'update-user' => 'update'
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ];
    protected $messages = [
        '*.required' => 'Campo Oblitgatorio'
    ];

    //  ---------------------  RENDER ---------------------
    public function updatedView(){
        $this->roles = \Spatie\Permission\Models\Role::all();
    }


    public function updatedPublicPassword(){
        $this->password = Hash::make($this->public_password);
    }
    public function refresh(){
        $this->reset();
    }
    public function render()
    {
        return view('livewire.account.management.user.user');
    }

    private function loadDatas($id){
        $this->roles = \Spatie\Permission\Models\Role::all();
        $user = Users::find($id);
        $this->id_user = $id;
        $this->name = $user->name;
        $this->email = $user->email;

        $role = Users::find($id)->roles->pluck('id');
        $this->role = isset($role[0]) ? $role[0] : 1; 
    }
    //  ---------------------  SAVE ---------------------
    public function save(){
        $validatedData = $this->validate();
        Users::create($validatedData)
            ->assignRole($this->role);

        $this->dispatchBrowserEvent('show-user-createComfirmed');
        $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  DELETE ---------------------
    public function deleteComfirmed($id){
        $this->loadDatas($id);
        $this->dispatchBrowserEvent('show-user-deleteComfirmed');
    }
    public function delete(){
        Users::find($this->id_user)
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
        $this->dispatchBrowserEvent('show-user-updateComfirmed');
    }
    public function update(){
        $validatedData = $this->validate();

        Users::find($this->id_user)
            ->update($validatedData);

        $this->emit('resetTable');
        $this->reset();
    }
}
