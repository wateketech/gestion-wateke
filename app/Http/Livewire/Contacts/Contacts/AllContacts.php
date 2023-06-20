<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use App\Models\EntityType as EntityTypes;
use App\Models\Contact as Contacts;

class AllContacts extends Component
{
    public $entity_types;
    protected $contacts;

    public $current_contact;
    private $perPage = 100;
    public $pageOffset = 0;

    // variables de busqueda y filtro en un solo campo (pseudo)
    public $search = '';
    private $search_alias, $search_name, $search_middle_name, $search_first_lastname, $search_second_lastname, $search_ids, $search_emails, $search_phones, $search_webs;

    public $is_search_name, $is_search_ids, $is_search_emails, $is_search_phones, $is_search_webs;
    public $is_search_all, $is_search_none;



    public function mount(){
        $this->restartFilter();
        $this->entity_types = EntityTypes::all();
        //$nextPage = $this->contacts->currentPage() + 1;
        //$nextPage = $this->contacts->currentPage() + $this->pageOffset;
        //$morePosts = Contacts::paginate(10, ['*'], 'page', $nextPage);
        // $this->pageOffset++;
        //dd($morePosts->currentPage());
    }
    public function restartFilter(){
        $this->is_search_name = false;
        $this->is_search_ids = false;
        $this->is_search_emails = false;
        $this->is_search_webs = false;
        $this->is_search_phones = false;
    }
    public function updatedSearch(){
        // poner condiciones terciarios para manejar si es uno el otro, todos o ninguno
        if ($this->is_search_name){
            $this->search_alias = $this->search;
            $this->search_name = $this->search;
            $this->search_middle_name = $this->search;
            $this->search_first_lastname = $this->search;
            $this->search_second_lastname = $this->search;
        }
        if ($this->is_search_ids) $this->search_ids = $this->search;
        if ($this->is_search_emails) $this->search_emails = $this->search;
        if ($this->is_search_phones) $this->search_phones = $this->search;
        if ($this->is_search_webs) $this->search_webs = $this->search;

        if ($this->is_search_all) $this->restartFilter(true);
        if ($this->is_search_none) $this->restartFilter(false);
        // cuando se limpia el search
        if ($this->search == '') $this->restartFilter(false);


        // pseudocodigos para buscado/filtrado
        $pseudokeys = array_filter(explode(',', explode('::', $this->search, 2)[0]));
        if ($pseudokeys){
            $query = explode('::', $this->search, 2)[1];

            foreach ($pseudokeys as $pseudokey){
                if ($pseudokeys == 'name'){
                    $this->search_alias = $query;
                    $this->search_name = $query;
                    $this->search_middle_name = $query;
                    $this->search_first_lastname = $query;
                    $this->search_second_lastname = $query;
                }
                if ($pseudokeys == 'id') $this->search_ids = $query;
                if ($pseudokeys == 'email') $this->search_emails = $query;
                if ($pseudokeys == 'movil') $this->search_phones = $query;
                if ($pseudokeys == 'web') $this->search_webs = $query;

                if ($pseudokeys == 'all') $this->restartFilter(true);
                if ($pseudokeys == 'none') $this->restartFilter(false);
            }
        }

    }
    public function render()
    {
        $this->contacts = Contacts::where('enable', true)
                                  ->where(function ($query) {
                                        $query->where('alias', 'like', '%'.$this->search_alias.'%')
                                              ->orWhere('name', 'like', '%'.$this->search_name.'%')
                                              ->orWhere('middle_name', 'like', '%'.$this->search_middle_name.'%')
                                              ->orWhere('first_lastname', 'like', '%'.$this->search_first_lastname.'%')
                                              ->orWhere('second_lastname', 'like', '%'.$this->search_second_lastname.'%')
                                              ->orWhereHas('ids', function ($query) { $query->where('value', 'like', '%'.$this->search_ids.'%'); })
                                              ->orWhereHas('emails', function ($query) { $query->where('value', 'like', '%'.$this->search_emails.'%'); })
                                              ->orWhereHas('phones', function ($query) { $query->whereRaw("JSON_EXTRACT(value_meta, '$.call_number') LIKE ?", ['%'.$this->search_phones.'%']); })
                                              ->orWhereHas('webs', function ($query) { $query->where('value', 'like', '%'.$this->search_webs.'%');
                                        });
                                    })
                                  ->paginate($this->perPage);
        return view('livewire.contacts.contacts.all-contacts')->with('contacts', $this->contacts);
    }

    public function selectContact($id){
        $this->current_contact = Contacts::find($id);
    }
}
