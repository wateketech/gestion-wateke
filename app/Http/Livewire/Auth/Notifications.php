<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Notification;
use App\Models\UserHasNotification;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.auth.notifications');
    }
}
