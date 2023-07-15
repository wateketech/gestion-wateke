<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Notification;
use App\Models\UserHasNotification;

class Notifications extends Component
{
    protected $listeners = [
        'set_open_menu'
    ];

    public $is_open_menu;
    public $is_editing_contact;
    public $notifications = [];
    public $unreadNotifications = 0;



    public function refresh(){
        // $this->countNotifications();
    }
    public function set_open_menu($value){
        // dd($value);
        $this->is_open_menu = $value;
    }

    public function mount(){

    }
    public function render()
    {
        $this->is_editing_contact = auth()->user()->is_editing_contact;
        $this->countNotifications();
        return view('livewire.auth.notifications');
    }

    private function countNotifications(){
        $this->unreadNotifications =
            count($this->is_editing_contact)
            + count($this->notifications)
        ;
    }

    public function finish_editing_contact($id){
        $this->is_editing_contact->find($id)->update(['is_editing' => false]);
    }
}
