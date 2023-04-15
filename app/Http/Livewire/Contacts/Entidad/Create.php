<?php

namespace App\Http\Livewire\Contacts\Entidad;

use Livewire\Component;
use App\Models\Entidad as Entidades;

class Create extends Component
{
    public $entidad_id, $grupo_gestion_id, $direccion_id, $gds_id,
        $nombre, $num_oficina, $nombre_fiscal, $nif, $es_minorista, $es_central, $iata, $rp,  $observ;

    public $prueba;
    public $perPage = '5';
    public $view = "show";
    public $search;

    public $c_cuenta = 1;
    public $c_rrss = 1;
    public $c_web = 1;
    public $c_movil = 1;
    public $emails = ['observ' => '', 'correo' => ''];

    protected $listeners = [
        'addRrss', 'addWeb', 'addMovil', 'addEmail',
    ];
    
    public function addRrss(){    $this->c_rrss += 1;    }
    public function addWeb(){     $this->c_web += 1;     }
    public function addMovil(){   $this->c_movil += 1;   }
    public function addEmail(){   
        $this->emails[] = ['observ' => '', 'correo' => ''];
        // $this->c_email += 1; 
    }
    public function lessEmail($index)
    {
        array_splice($this->emails, $index, 1);
    }

    public function render()
    {
        return view('livewire.contacts.entidad.create');
    }
}
