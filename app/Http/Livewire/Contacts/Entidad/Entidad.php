<?php

namespace App\Http\Livewire\Contacts\Entidad;

use Livewire\Component;
use App\Models\Entidad as Entidades;

use Livewire\WithPagination;

class Entidad extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = '5';
    public $view = 'main';
    public $search;

    public $entidad_id, $grupo_gestion_id, $direccion_id, $gds_id,
        $nombre, $num_oficina, $nombre_fiscal, $nif, $es_minorista, $es_central, $iata, $rp,  $observ;

    // public function render()
    // {
    //     $entidades = Entidades::where('nombre', "LIKE", "%{$this->search}%")
    //                         ->paginate($this->perPage);

    //     return view('livewire.contacts.entidad.entidad', compact('entidades'));
    // }
    
}
