<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Auth;
use Livewire\Component;

class Logout extends Component
{

    protected $listeners = [
        'logout'
    ];

    public function logout() {
        $this->cleanEditions();

        auth()->logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }

    private function cleanEditions(){
        $is_editing_contact = auth()->user()->is_editing_contact;
        foreach ($is_editing_contact as $contact) {
            $contact->update(['is_editing' => false]);
        }
    }
}
