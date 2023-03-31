<?php

namespace App\Http\Livewire\Account\Management\User;

use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserTable extends LivewireDatatable
{
    public $model = User::class;
    // public $hideable = 'select';
    // public $exportable = true;
    // public $buttonsSlot = 'livewire.usuario.main';
    public function builder()
    {
        return User::query()
            ->where('enable', '=', true);
    }

    public function columns()
    {
        return[
            Column::name('users.name')  ->label('Nombre'),
            
            Column::callback(['id'], function ($id) {
                return User::selectRaw('roles.name')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('users.id', '=', $id)
                ->get()[0]->name;
                })->label('Rol'),

            Column::name('users.email') ->label('Correo'),
            Column::name('users.phone') ->label('Movil'),

            Column::callback(['id', 'name'], function ($id, $name) {
                $a = User::selectRaw('roles.name')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('users.id', '=', $id)
                ->get()[0]->name;
                return view('livewire.account.management.user.table-actions', ['id' => $id, 'name' => $name, 'role' => $a]);
            })->unsortable()->label('Acciones')

        ];
    }
}
