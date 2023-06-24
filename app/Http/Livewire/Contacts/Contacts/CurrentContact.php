<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use App\Models\Contact as Contacts;
use Psy\ExecutionLoop\Listener;

class CurrentContact extends Component
{
    public $prueba;
    public $multiple_selection = 'holaa';
    public $contacts = [];
    public $contacts_emails = [];
    public $contact;
    protected $listeners = [
        'mount', 'remount', 'remount_multiple'
        ];


    public function remount($args){
        $contact_id = $args['id'];

        $this->multiple_selection = false;
        $this->contact = Contacts::where('enable', true)->find($contact_id);
        $this->contacts = [];
    }

    public function remount_multiple($args){
        $contact_id = $args['id'];

        $this->multiple_selection = true;
        if ($this->contacts > 1){
            $this->contacts[] = $this->contact;
            this->getMassivePropertys();
        }
        $this->contacts[] = Contacts::where('enable', true)->find($contact_id);
        $this->contact = null;

        this->getMassivePropertys();
    }


    private function getMassivePropertys($id){
        foreach ($this->contacts as $contact) {
            $email = $contact->emails->where('is_primary', true)->first();
            if ($email) {
                $this->contacts_emails->push($email->value);
            }
        }
        $this->contacts_emails = $this->contacts_emails->toArray();

    }

    public function render()
    {
        return view('livewire.contacts.contacts.layouts.current-contact'); //->with('contact', $this->contact);
    }
}
