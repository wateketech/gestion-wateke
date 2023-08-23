<?php

namespace App\Http\Livewire\Account\Management;

use Livewire\Component;
use App\Models\User as Users;

class UsersManagement extends Component
{
    public $filter_view = false;
    public $group_view = false;

    protected $listeners = [
        'multiple_selection',
        'delete_contact' => 'deleteContact',
        'delete_contacts' => 'deleteContacts',
        'enable_contacts' => 'enableContacts'
        ];

    public $search_name, $search_email, $search_phone;

    public $roles;
    protected $users;

    public $multiple_selection = false;
    public $current_users = [];
    public $current_user;

    private $perPage = 100;
    public $pageOffset = 0;

    // variables de busqueda y filtro en un solo campo (pseudo)
    public $search = '';

    
    public function render()
    {
        $this->users = Users::where('enable', true)
            ->where(function ($query) {
                $query->where(function ($query) {
                        $query->where('name', 'like', '%'.$this->search_name.'%')
                                ->orWhere('email', 'like', '%'.$this->search_email.'%')
                                ->orWhere('phone', 'like', '%'.$this->search_phone.'%')                                ;
                            ;
                });
            })
            ->paginate($this->perPage);
        return view('livewire.account.management.users-management')->with('users', $this->users);

    }
    // ------------------------------ VIEWS --------------------------------

        public function updatedFilterView()
        {
            $this->group_view = false;
        }
        public function updatedGroupView()
        {
            $this->filter_view = false;
        }
}
