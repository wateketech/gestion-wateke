<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class SearchActions extends Component
{
    private function findMatches($search, $percentage = 0.4) {
        $matches = array();

        foreach ($this->actions as $name => $action) {
            $distance = levenshtein(strtolower($name), strtolower($search));
            $len = max(strlen($name), strlen($search));
            $similar = 1 - ($distance / $len);

            if ($similar >= $percentage) {
                $matches[$name] = $action;
            }
        }

        return $matches;
    }

    public function updatedSearch(){
       $this->matches =  $this->findMatches($this->search);
    }


    public function render()
    {
        return view('livewire.auth.search-actions');
    }

    protected function resolveComponent($component)
    {
        $component = ucwords($component, ".-");
        $component = str_replace('.', '\\', $component);
        $component = str_replace('-', '', $component);

        $componentClass = 'App\\Http\\Livewire\\' . $component;
        return app($componentClass);
    }

    public function emitEvent($component, $event){
        $this->emitTo($component, $event);
    }



    // variables
    public $prueba = 'contacts.import-export';
    public $component;
    public $search;
    public $matches = [];
    public $actions = [
        'crear contacto' => ["redirect",  "/crear-contacto"],



        'importar contactos' =>  ["emitEvent", 'contacts.import-export', "importContacts"],
        'cerrar sesión' =>  ["emitEvent", 'auth.logout', "logout"],

    ];


}
