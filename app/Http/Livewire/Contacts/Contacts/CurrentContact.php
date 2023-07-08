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
    public $contacts_phones = [];
    public $contacts_instant_messages = [];

    public $contact;
    protected $listeners = [
        'mount', 'remount', 'remount_multiple', 'remount_multiple_unset'
        ];


    public function mount($contact_id = null){
        if ($contact_id) $this->remount(['id' => $contact_id]);
    }

    public function remount($args){
        $contact_id = $args['id'];

        $this->contact = Contacts::where('enable', true)->find($contact_id);

        // for else multiple selection
        $this->multiple_selection = false;
        $this->contacts = [ $this->contact ];
        $this->cleanMassivePropertys();

        if ($this->contact) $this->getMassivePropertys($contact_id);

    }

    public function remount_multiple($args){
        $contact_id = $args['id'];

        $this->multiple_selection = true;
        $this->contact = null;

        // Si el contacto no existe, lo agregamos al arreglo
        $existingIndex = array_search($contact_id, array_column($this->contacts, 'id'));
        if ($existingIndex === false) {
            $this->contacts[] = Contacts::with('pics', 'emails', 'phones')
                ->where('enable', true)->find($contact_id)->toArray();
        }

        $this->getMassivePropertys($contact_id);
    }

    public function remount_multiple_unset($args){
        $contact_id = $args['id'];
        $this->multiple_selection = true;

        foreach ($this->contacts as $key => $contact) {
            if ($contact->id == $contact_id) unset($this->contacts[$key]);
        }

        $this->unsetMassivePropertys($contact_id);
    }


    private function getMassivePropertys($id){
        $email = Contacts::where('enable', true)->find($id)->emails->where('is_primary', true)->first();
        if ($email) $this->contacts_emails[] = $email;

        $phone = Contacts::where('enable', true)->find($id)->phones->where('is_primary', true)->first();
        if ($phone) $this->contacts_phones[] = $phone;

        $instant_message = Contacts::where('enable', true)->find($id)->instant_messages->where('is_primary', true)->first();
        if ($instant_message) $this->contacts_instant_messages[] = $instant_message;

    }
    private function cleanMassivePropertys(){
        $this->contacts_emails = [];
        $this->contacts_phones = [];
        $this->contacts_instant_messages = [];
    }
    private function unsetMassivePropertys($id){
        $this->contacts_emails = array_filter($this->contacts_emails, function ($email) use ($id) { return ($email->contact_id != $id); });
        $this->contacts_phones = array_filter($this->contacts_phones, function ($phones) use ($id) { return ($phones->contact_id != $id); });
        $this->contacts_instant_messages = array_filter($this->contacts_instant_messages, function ($instant_messages) use ($id) { return ($instant_messages->contact_id != $id); });
    }

    public function render()
    {
        return view('livewire.contacts.contacts.current-contact'); //->with('contact', $this->contact);
    }


    public function getEmails(){
        $emailsString = '';
        if (count($this->contacts_emails) != 0){
            $emailsArray = array_column($this->contacts_emails, 'value');
            $emailsString = implode(',', $emailsArray);
        }

        return $emailsString;
    }
}
