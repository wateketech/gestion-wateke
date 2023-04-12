<?php

namespace App\Http\Livewire\Account\Management\Task;

use App\Models\Task;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\User as Users;
use \Spatie\Permission\Models\Role as Roles;
use App\Models\UserHasTasks as UserHasTasks;
use App\Models\RoleHasTasks as RoleHasTasks;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TaskTable extends LivewireDatatable
{
    public $model = Task::class;
    // public $hideable = 'select';
    // public $exportable = true;
    // public $buttonsSlot = 'livewire.usuario.main';
    public function builder()
    {
        return Task::query()
            ->where('enable', '=', true);
    }

    public function columns()
    {
        return[
            Column::name('tasks.name')  ->label('Nombre'),
            // Column::name('tasks.type_value')  ->label('Valor'),
            Column::name('tasks.average') ->label('Promedio'),
            // Column::name('tasks.type_frec') ->label('Frecuencia'),

            Column::callback(['id'], function($id_task){
                $userData = UserHasTasks::where('task_id', $id_task)
                ->join('users', 'users.id', '=', 'user_has_tasks.user_id')
                ->select('users.name')
                ->pluck('name');
                $html = '';
                if (count($userData) == Users::all()->where('enable', '=', true)->count()){
                    $title = '';
                    foreach ($userData as $user) {
                        $title .=  $user . ' | ';
                    }
                    $title = rtrim(ltrim($title, ' | '), ' |');
                    $html .= '<span class="badge rounded-pill bg-light text-dark" title="' . $title . '">Todos los Roles</span>';
                }else{
                    foreach ($userData as $user) {
                        $html .= '<span class="badge rounded-pill bg-light text-dark">' . $user . '</span>';
                    }
                }

                return $html;
            })->unsortable()->label('Usuarios'),

            Column::callback(['id', 'average'], function($id_task){
                $roleData = RoleHasTasks::where('task_id', $id_task)
                ->join('roles', 'roles.id', '=', 'role_has_tasks.role_id')
                ->select('roles.name')
                ->pluck('name');

                $html = '';
                if (count($roleData) == Roles::all()->count()){
                    $title = '';
                    foreach ($roleData as $role) {
                        $title .=  $role . ' | ';
                    }
                    $title = rtrim(ltrim($title, ' | '), ' |');
                    $html = '<span class="badge rounded-pill bg-light text-dark" title="' . $title . '">Todos los Roles</span>';
                }else{
                    foreach ($roleData as $role) {
                        $html .= '<span class="badge rounded-pill bg-light text-dark">' . $role . '</span>';
                    }
                }
                return $html;
            })->unsortable()->label('Roles'),

            Column::name('tasks.about') ->label('Observaciones'),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.account.management.task.table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()->label('Acciones')
        ];
    }
}
