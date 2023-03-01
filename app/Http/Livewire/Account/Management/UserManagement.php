<?php

namespace App\Http\Livewire\Account\Management;

use Livewire\Component;

class UserManagement extends Component
{
    public $view = 'user-task';

    public function updatedView(){
        // eventos para los js al cambio de vista (en el menu)
        if ($this->view == 'user'){
            // los js por defecto ya llegan caragdos para esta seccion
        }
        if ($this->view == 'task'){
        }
        if ($this->view == 'user-task'){
            $this->dispatchBrowserEvent('build-user-metrics');
        }
    }

    public function render()
    {
        return view('livewire.account.management.user-management');
    }
}
