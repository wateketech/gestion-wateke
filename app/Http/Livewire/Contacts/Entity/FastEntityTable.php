<?php

namespace App\Http\Livewire\Contacts\Entity;

use App\Models\Entity;
use App\Models\EntityEmail;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

class FastEntityTable extends LivewireDatatable
{
    public $model = Entity::class;

    public function builder()
    {
        return Entity::query()
            ->where('enable', '=', true)
            ->where('nif', '=', ' ');
    }

    public function columns()
    {
        return[
            Column::name('entitys.legal_name') ->label('Nombre Fiscal'),
            Column::name('entitys.name')  ->label('Nombre Comercial'),
            Column::callback(['id'], function ($id) {
                $email = EntityEmail::selectRaw('entity_emails.email')
                    ->where('entity_emails.entity_id', '=', $id)
                    ->where('entity_emails.label', '=', 'primary')
                    ->pluck('entity_emails.email');
                
                return isset($email[0]) ? $email[0] : '<span class="text-danger">Ninguno</span>';
            })->label('Email Primario'),

            Column::callback(['is_retail', 'is_mainoffice'], function ($is_retail, $is_mainoffice) {

                $html = '<span class="badge rounded-pill bg-light text-dark">';
                $html .= $is_mainoffice ? 'Central</span>' : 'Sucursal</span>';
                $html .= '<span class="ml-1 badge rounded-pill bg-light text-dark">'; 
                $html .= $is_retail ? 'Minorista</span>' : 'Mayorista</span>';

                return $html;
            })->label('Tipo'),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.contacts.entity.fast-table-actions', ['id' => $id]);
            })->unsortable()->label('Acciones')
        ];
    }
}