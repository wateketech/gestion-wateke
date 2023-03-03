<?php

namespace App\Http\Livewire\Contacts\Entidad;

use Livewire\Component;
use App\Models\Entidad as Entidades;

use Livewire\WithPagination;

class Entidad extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $prueba;
    public $perPage = '5';
    public $view = 'main';
    public $search;

    public $entidad_id, $grupo_gestion_id, $direccion_id, $gds_id,
        $nombre, $num_oficina, $nombre_fiscal, $nif, $es_minorista, $es_central, $iata, $rp,  $observ;


    protected $listeners=[
        'addRrss', 'addWeb', 'addMovil', 'addEmail',
    ];
    
    public $c_cuenta = 1;
    public $c_rrss = 1;
    public $c_web = 1;
    public $c_movil = 1;
    public $c_email = 1;

    public function addRrss(){    $this->c_rrss += 1;    }
    public function addWeb(){     $this->c_web += 1;     }
    public function addMovil(){   $this->c_movil += 1;   }
    public function addEmail(){   $this->c_email += 1;   }
    // public function render()
    // {
    //     $entidades = Entidades::where('nombre', "LIKE", "%{$this->search}%")
    //                         ->paginate($this->perPage);

    //     return view('livewire.contacts.entidad.entidad', compact('entidades'));
    // }
    
}
