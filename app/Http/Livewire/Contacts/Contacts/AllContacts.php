<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\EntityType as EntityTypes;
use App\Models\Contact as Contacts;
use App\Models\ContactGroup as ContactGroups;

class AllContacts extends Component
{
    public $prueba;
    public $filter_view = false;
    public $group_view = false;

    protected $listeners = [
        'multiple_selection',
        'delete_contact' => 'deleteContact',
        'delete_contacts' => 'deleteContacts',
        'enable_contacts' => 'enableContacts',
        'create_contact_group' => 'createGroup',
        'update_contact_group' => 'updateGroup',
        'delete_contact_group' => 'deleteGroup'
        ];

    public $contact_groups;
    public $entity_types;
    protected $contacts;

    public $multiple_selection = false;
    public $current_contacts = [];
    public $current_contact;
    public $current_group = Null;

    private $perPage = Null;
    public $pageOffset = 0;

    // variables de busqueda y filtro en un solo campo (pseudo)
    public $search = '';
    public $search_alias, $search_name, $search_middle_name, $search_first_lastname, $search_second_lastname, $search_ids, $search_emails, $search_phones, $search_webs;

    public $is_search_all, $is_search_name, $is_search_ids, $is_search_emails, $is_search_phones, $is_search_webs;

    // variables de ordenacion
    public $order_by = 'name';
    public $order_asc = true;

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

    public function setCurrentGroup($value){
        if ($this->current_group == $value) $this->current_group = Null;
        else $this->current_group = $value;
        $this->current_contacts = [];
        $this->current_contact = null;
        $this->updatedCurrentContact();
    }
    public function mount($id = null ){
        $this->current_contact = $id;

        if (isset($id) || $id !== null) {
            if (Contacts::find($id) === null) abort(404);
        }

        $this->restartFilter(false);
        // $this->entity_types = EntityTypes::all();
        $this->contact_groups = ContactGroups::all()->where('enable', true);
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

// ------------------------------ LIVE FILTERS --------------------------------
    private function getContacts(){
        return Contacts::where('enable', true)
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
                                  ->whereHas('groups', function ($query) {  if($this->current_group != Null) $query->where('group_id', $this->current_group); })
                                  ->orderby($this->order_by, $this->order_asc ? 'asc' : 'desc' )
                                  ->paginate($this->perPage);

    }
// ------------------------------ VIEWS --------------------------------

    public function render(){
        $this->contacts = $this->getContacts();
        return view('livewire.contacts.contacts.all-contacts')->with('contacts', $this->contacts);
    }
    public function updatedFilterView()
    {
        $this->group_view = false;
    }
    public function updatedGroupView()
    {
        $this->filter_view = false;
        $this->current_group = Null;
    }

// ------------------------------ ACTIONS --------------------------------
    public function selectAll(){
        $allContacts = $this->getContacts()->pluck('id')->toArray();
        if (count($allContacts) != count($this->current_contacts)){
            $this->multiple_selection = true;
            foreach($allContacts as $contact){
                $this->current_contact = $contact;
                $this->updatedCurrentContact();
            }
        }else{
            $this->multiple_selection = false;
            $this->current_contacts = [];
            $this->current_contact = null;
            $this->updatedCurrentContact();
        }
        $this->multiple_selection = false;
    }
    public function selectContact($id){
        $this->current_contact = Contacts::find($id);
    }





    public function importContacts(){
        $this->emitTo('contacts.import-export', 'importContactsQ');
    }

    public function exportContacts($id){
        switch (gettype(json_decode($id))) {
            case 'integer':
                $this->emitTo('contacts.import-export', 'exportContactsQ', ['multiple' => false, 'id' => json_decode($id)]);
                break;
            case 'array':
                $this->emitTo('contacts.import-export', 'exportContactsQ', ['multiple' => true, 'id' => json_decode($id)]);
                break;
        }
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
 // ------------------------------ GROUPS Management --------------------------------
    private function validateGroupForm($mode, $name, $color, $icon){

        if ($mode == 'create'){
            if (ContactGroups::where('name', $name)->count() != 0) return "Ya existe un grupo con este nombre.";
        }
        elseif($mode == 'update'){
            if (ContactGroups::where('name', $name)->count() != 0 && ContactGroups::where('name', $name) != $name) return "Ya existe un grupo con este nombre.";
        }

        if ($name == null) return "El campo es requerido.";
        elseif (strlen($name) > 15 || strlen($name) <= 1) return "El campo 'name' debe tener entre 1 y 15 caracteres.";


        return Null;
    }
    public function GroupForm($id = null, $enable = false){
        // enable group
        if ($enable == true){
            $group = ContactGroups::find($id);
            $this->dispatchBrowserEvent('contact-group-form',[
                'ccontactos' => count($group->contacts),
                'name' =>  $group->name,
                'color' =>  $group->color,
                'icon' =>  $group->icon,
                'error' => '<sub>¡ Este grupo había sido eliminado recientemente !</sub>',
                'mode' => 'enable',
                'id' => $id,
            ]);
            return;
        }
        // create mode
        if ($id == null){
            $this->dispatchBrowserEvent('contact-group-form',[
                'ccontactos' => count($this->current_contacts),
                'name' => '',
                'color' => '#ff6400',
                'icon' => '#ff6400',
                'error' => '',
                'mode' => 'create',
                'id' => $id,
            ]);
        // edit mode
        }else{
            // $group = ContactGroups::find($id)->update(['is_editing' => true, 'edited_by' => auth()->user()->id,]);
            $group = ContactGroups::find($id);

            $this->dispatchBrowserEvent('contact-group-form',[
                'ccontactos' =>  count($group->contacts),
                'name' =>  $group->name,
                'color' =>  $group->color,
                'icon' =>  $group->icon,
                'error' =>  '',
                'mode' => 'edit',
                'id' => $group->id,
            ]);
        }


    }
    public function deleteGroup($name, $id){
        $group = ContactGroups::find($id);
        if ($group->name == $name)
            if ($group->enable == false){
                foreach($group->contacts as $contact){
                    $contact->delete();
                }
                $group->delete();
                return;
            }

            $group->update(['enable' => false]);
            $this->contact_groups = ContactGroups::all()->where('enable', true);
    }
    public function updateGroup($name, $color = '#ff6400', $icon = '<i class="fas fa-user-friends"></i>', $id = Null){
        $name = trim($name);
        $error = $this->validateGroupForm('create', $name, $color, $icon);

        if ($error != null){
            $this->dispatchBrowserEvent('contact-group-form',[
                'ccontactos' => count($this->current_contacts),
                'name' => $name == null ? '' : $name,
                'color' => $color,
                'error' => '<p class="text-danger">' . $error .'</p>',
                'mode' => 'edit',
                'id' => $id
            ]);
        }else{

            DB::beginTransaction();
            try {
                // actualizar el grupo
                $group = ContactGroups::find($id)-> update([
                    'name' => $name,
                    'color' => $color,
                    'icon' => $icon,
                ]);

                // dar la posibilidad de incluir y eliminar contactos del grupo

                $this->contact_groups = ContactGroups::all()->where('enable', true);
                DB::commit();
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $this->dispatchBrowserEvent('ddbb-error', ['code' => $e->errorInfo[1], 'message' => $e->errorInfo[2], 'redirect' => '/contactos']);
            }

            $this->dispatchBrowserEvent('simple-toast-message',['text' => 'Grupo ' . $name . ' actualizado exitosamente', 'icon' => 'success']);
        }
    }
    public function createGroup($name, $color = '#ff6400', $icon = '<i class="fas fa-user-friends"></i>', $id = Null){
        $name = trim($name);

        $disabled = ContactGroups::where('name', $name)->where('enable', 0)->first();
        if ($disabled != Null){
            $this->GroupForm($disabled->id, true);
            return;
        };

        $error = $this->validateGroupForm('create', $name, $color, $icon);

        if ($error != null){
            $this->dispatchBrowserEvent('contact-group-form',[
                'ccontactos' => count($this->current_contacts),
                'name' => $name == null ? '' : $name,
                'color' => $color,
                'error' => '<p class="text-danger">' . $error .'</p>',
                'mode' => 'create',
                'id' => $id
            ]);
        }else{

            DB::beginTransaction();
            try {
                // crear el grupo
                $group = ContactGroups::create([
                    'name' => $name,
                    'color' => $color,
                    'icon' => $icon,
                ]);

                $current_contacts = array_map(function ($current_contacts) {
                    return ['contact_id' => $current_contacts];
                }, $this->current_contacts);
                $group->contacts()->createMany($current_contacts);


                $this->contact_groups = ContactGroups::all()->where('enable', true);
                DB::commit();
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $this->dispatchBrowserEvent('ddbb-error', ['code' => $e->errorInfo[1], 'message' => $e->errorInfo[2], 'redirect' => '/contactos']);
            }

            $this->dispatchBrowserEvent('simple-toast-message',['text' => 'Grupo ' . $name . ' creado exitosamente', 'icon' => 'success']);



        }
    }

}
