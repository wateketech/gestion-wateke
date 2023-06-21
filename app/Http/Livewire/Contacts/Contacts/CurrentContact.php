<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use App\Models\Contact as Contacts;
use Psy\ExecutionLoop\Listener;

class CurrentContact extends Component
{
    public $contact;
    protected $listeners = [
        'remount', 'mount'
        ];




    public function remount($args){
        $contact_id = $args['id'];

        $this->contact = Contacts::where('enable', true)->find($contact_id);
    }
    public function render()
    {
        return view('livewire.contacts.contacts.layouts.current-contact'); //->with('contact', $this->contact);
    }
}
