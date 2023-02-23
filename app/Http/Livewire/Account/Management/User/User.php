<?php

namespace App\Http\Livewire\Account\Management\User;
use App\Models\User as Users;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class User extends Component
{

    public $prueba;
    public $view;
    public $id_usuario, $name, $email, $role, $public_password;
    public $password;

    protected $listeners = [

    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required',
        'password' => 'required'
    ];
    protected $messages = [

    ];

    //  ---------------------  RENDER ---------------------
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
        $user = Users::find($id);
        $this->id_usuario = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }
    //  ---------------------  SAVE ---------------------
    public function save(){
        $validatedData = $this->validate();
        Users::create($validatedData);

        // $this->dispatchBrowserEvent('show-user-createComfirmed');
        // $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  DELETE ---------------------
    public function deleteComfirmed($id){
        $this->loadDatas($id);
        // $this->dispatchBrowserEvent('show-user-deleteComfirmed');
    }
    public function delete(){
        Users::destroy($this->id_usuario);
        // $this->emit('resetTable');
        $this->refresh();
    }

    //  ---------------------  UPDATE ---------------------
    public function view_update($id){
        $this->loadDatas($id);
        $this->view = 'edit' ;
    }
    public function updateComfirmed(){
        // $this->dispatchBrowserEvent('show-user-updateComfirmed');
    }
    public function update(){
        $validatedData = $this->validate();

        Users::find($this->id_usuario)
            ->update($validatedData);

        // $this->emit('resetTable');
        $this->reset();
    }
}
