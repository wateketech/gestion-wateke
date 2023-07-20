<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use App\Models\EntityType as EntityTypes;
use App\Models\Contact as Contacts;

class AllContacts extends Component
{
    public $prueba;
    public $filter_view = false;
    public $group_view = false;

    protected $listeners = [
        'multiple_selection',
        'delete_contact' => 'deleteContact',
        'delete_contacts' => 'deleteContacts',
        'enable_contacts' => 'enableContacts'
        ];

    public $entity_types;
    protected $contacts;

    public $multiple_selection = false;
    public $current_contacts = [];
    public $current_contact;

    private $perPage = 100;
    public $pageOffset = 0;

    // variables de busqueda y filtro en un solo campo (pseudo)
    public $search = '';
    public $search_alias, $search_name, $search_middle_name, $search_first_lastname, $search_second_lastname, $search_ids, $search_emails, $search_phones, $search_webs;

    public $is_search_all, $is_search_name, $is_search_ids, $is_search_emails, $is_search_phones, $is_search_webs;


    public function multiple_selection($args){
        $this->multiple_selection = $args['is_multiple'];
        if (!in_array($this->current_contact, $this->current_contacts) && $this->current_contact !== null) {
            $this->current_contacts[] = $this->current_contact;
        }
    }
    public function updatedCurrentContact(){
        if ($this->multiple_selection){
            $this->emitTo('contacts.contacts.current-contact', 'remount_multiple', ['id' => $this->current_contact]);
            if (!in_array($this->current_contact, $this->current_contacts) && $this->current_contact !== null) {
                $this->current_contacts[] = $this->current_contact;
            }

        }else{
            $this->emitTo('contacts.contacts.current-contact', 'remount', ['id' => $this->current_contact]);
            $this->current_contacts= [];
        }
    }

    public function mount($id = null ){
        $this->current_contact = $id;

        if (isset($id) || $id !== null) {
            if (Contacts::find($id) === null) abort(404);
        }

        $this->restartFilter(false);
        $this->entity_types = EntityTypes::all();
        //$nextPage = $this->contacts->currentPage() + 1;
        //$nextPage = $this->contacts->currentPage() + $this->pageOffset;
        //$morePosts = Contacts::paginate(10, ['*'], 'page', $nextPage);
        // $this->pageOffset++;
        //dd($morePosts->currentPage());




    }






// ------------------------------ SEARCHS --------------------------------

    public function restartFilter($value){
        $this->is_search_name = $value;
        $this->is_search_ids = $value;
        $this->is_search_emails = $value;
        $this->is_search_webs = $value;
        $this->is_search_phones = $value;
    }
    public function resetSearch($value){
        $this->search_alias = $value;
        $this->search_name = $value;
        $this->search_middle_name = $value;
        $this->search_first_lastname = $value;
        $this->search_second_lastname = $value;
        $this->search_ids = $value;
        $this->search_emails = $value;
        $this->search_phones = $value;
        $this->search_webs = $value;
    }


    public function updatedSearch(){    $this->resetSearch($this->search); }

    // EN PROCESO (busquedas filtradas)
    public function zz_updatedSearch(){
        // $this->resetSearch(" ");

        // cuando se limpia el search
        // if ($this->search == '') $this->restartFilter(false); $this->resetSearch(null);

        // switch(true) {
        //     case $this->is_search_name:
        //         $this->search_alias = $this->search;
        //         $this->search_name = $this->search;
        //         $this->search_middle_name = $this->search;
        //         $this->search_first_lastname = $this->search;
        //         $this->search_second_lastname = $this->search;
        //         break;

        //    case $this->is_search_ids:
        //        $this->search_ids = $this->search;
        //        break;

        //    case $this->is_search_emails:
        //        $this->search_emails = $this->search;
        //        break;

        //    case $this->is_search_phones:
        //        $this->search_phones = $this->search;
        //        break;

        //    case $this->is_search_webs:
        //        $this->search_webs = $this->search;
        //        break;

        //    default:
        //        $this->resetSearch($this->search);
        // }

        // $this->render();








        // poner condiciones terciarios para manejar si es uno el otro, todos o ninguno
            // if ($this->is_search_name){
            //     $this->search_alias = $this->search;
            //     $this->search_name = $this->search;
            //     $this->search_middle_name = $this->search;
            //     $this->search_first_lastname = $this->search;
            //     $this->search_second_lastname = $this->search;
            // }
            // if ($this->is_search_ids) $this->search_ids = $this->search;
            // if ($this->is_search_emails) $this->search_emails = $this->search;
            // if ($this->is_search_phones) $this->search_phones = $this->search;
            // if ($this->is_search_webs) $this->search_webs = $this->search;

            // if ($this->is_search_all) $this->restartFilter(true) $this->resetSearch($this->search);;
            // cuando se limpia el search
            // if ($this->search == '') $this->restartFilter(false); $this->resetSearch(null);


        // pseudocodigos para buscado/filtrado
        //$pseudokeys = array_filter(explode(',', explode('::', $this->search, 2)[0]));
        //if ($pseudokeys){
        //    $query = explode('::', $this->search, 2)[1];

        //    foreach ($pseudokeys as $pseudokey){
        //        if ($pseudokeys == 'name'){
        //            $this->search_alias = $query;
        //            $this->search_name = $query;
        //            $this->search_middle_name = $query;
        //            $this->search_first_lastname = $query;
        //            $this->search_second_lastname = $query;
        //        }
        //        if ($pseudokeys == 'id') $this->search_ids = $query;
        //        if ($pseudokeys == 'email') $this->search_emails = $query;
        //        if ($pseudokeys == 'movil') $this->search_phones = $query;
        //        if ($pseudokeys == 'web') $this->search_webs = $query;

        //        if ($pseudokeys == 'all') $this->restartFilter(true);
        //        if ($pseudokeys == 'none') $this->restartFilter(false);
        //    }
    }

    // }



    public function render()
    {
        $this->contacts = Contacts::where('enable', true)
                                  ->where(function ($query) {
                                        $query->where(function ($query) {
                                                $query->where('name', 'like', '%'.$this->search_name.'%')
                                                      // ->orWhere('middle_name', 'like', '%'.$this->search_middle_name.'%')
                                                      ->orWhere('first_lastname', 'like', '%'.$this->search_first_lastname.'%')
                                                      ->orWhere('second_lastname', 'like', '%'.$this->search_second_lastname.'%')
                                                      // ->orWhere('alias', 'like', '%'.$this->search_alias.'%')
                                                      ;
                                                })
                                              ->orWhereHas('ids', function ($query) { $query->where('value', 'like', '%'.$this->search_ids.'%'); })
                                              ->orWhereHas('emails', function ($query) { $query->where('value', 'like', '%'.$this->search_emails.'%'); })
                                              ->orWhereHas('phones', function ($query) { $query->whereRaw("JSON_EXTRACT(value_meta, '$.call_number') LIKE ?", ['%'.$this->search_phones.'%']); })
                                              ->orWhereHas('webs', function ($query) { $query->where('value', 'like', '%'.$this->search_webs.'%');
                                        });
                                    })
                                  ->paginate($this->perPage);
        return view('livewire.contacts.contacts.all-contacts')->with('contacts', $this->contacts);
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

// ------------------------------ ACTIONS --------------------------------
    public function selectContact($id){
        $this->current_contact = Contacts::find($id);
    }

    public function createGroup ($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function importContacts(){
        $this->emitTo('contacts.import-export', 'importContacts');
    }

    public function exportContact($id){
        $this->emitTo('contacts.import-export', 'exportContact', ['id' => $id]);
    }

    public function exportContacts($ids){
        $this->emitTo('contacts.import-export', 'exportContacts', ['ids' => $ids]);
    }














// ------------------------------ REMOVE ACTIONS --------------------------------

    public function deleteContact_Q($id){
        $this->dispatchBrowserEvent('show-delete-contact', ['contact_id' => $id, 'current_contact' => $this->current_contact]);
    }
    public function deleteContacts_Q($ids){
        $this->dispatchBrowserEvent('show-delete-contacts', ['contacts_id' => $ids, 'current_contacts' => $this->current_contacts]);
    }
    public function deleteContact($id, $value){
        if ($id == $this->current_contact && $id == $value && $this->current_contact == $value) {
            Contacts::find($id)->update(['enable' => false]);
        }
    }
    public function deleteContacts($ids, $value){
        if ($ids == $this->current_contacts) {
            foreach ($ids as $id){
                Contacts::find($id)->update(['enable' => false]);
            }
        }
    }


    public function enableContact($id){
        if ($id == $this->current_contact){
            $contact_id = Contacts::find($id)->update(['enable' => true]);
            $this->dispatchBrowserEvent('show-recovery-contact-success', ['is_muliple' => false]);
        }
        else $this->dispatchBrowserEvent('show-recovery-contact-error', ['is_muliple' => false]);

    }
    public function enableContacts($ids){
        if (json_decode($ids) == $this->current_contacts){
            foreach ($this->current_contacts as $id){
                $contact_id = Contacts::find($id)->update(['enable' => true]);
            }
            $this->dispatchBrowserEvent('show-recovery-contact-success', ['is_muliple' => true]);
        }
        else $this->dispatchBrowserEvent('show-recovery-contact-error', ['is_muliple' => true]);
    }

}
