<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class SearchActions extends Component
{




    public $search;

    public $matches = [

    ];

    public $actions = [
        'crear contacto1' => 'd',
        'crear contacto2' => 'a',
        'crear contacto3' => 2,
        'crear contacto4' => 3,
    ];



    // function encontrarCoincidencias($array, $string) {
    //     $coincidencias = array();

    //     foreach ($array as $elemento) {
    //         $distancia = levenshtein($elemento, $string);
    //         $longitud = max(strlen($elemento), strlen($string));
    //         $similitud = 1 - ($distancia / $longitud);

    //         if ($similitud >= 0.8) {
    //             $coincidencias[] = $elemento;
    //         }
    //     }

    //     return $coincidencias;
    // }




    public function updatedSearch(){
        // algoritmo de coincidencias entre la busqueda y las posibles acciones




    }
    public function render()
    {
        return view('livewire.auth.search-actions');
    }

}
