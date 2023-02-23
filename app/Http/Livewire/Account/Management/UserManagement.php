<?php

namespace App\Http\Livewire\Account\Management;

use Livewire\Component;

class UserManagement extends Component
{
    public $view = 'user';
    public function render()
    {
        return view('livewire.account.management.user-management');
    }
}
