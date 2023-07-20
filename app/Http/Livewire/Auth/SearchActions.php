<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use SebastianBergmann\CodeCoverage\Util\Percentage;

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


    public function emitEvent($component, $event){
        $this->emitTo($component, $event);
    }



    // variables
    public $search;
    public $matches = [];
    public $actions = [
        'crear contacto' => ["redirect",  "/crear-contacto"],





        'cerrar sesión' =>  ["emitEvent", 'auth.logout', "logout"],
    ];


}
