<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


use DB;
use App\Models\User;
use App\Models\Task;



use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'delete articles']);
        // Permission::create(['name' => 'publish articles']);
        // Permission::create(['name' => 'unpublish articles']);

        Role::create(['name' => 'Invitado']);

        // create roles and assign created permissions
        Role::create(['name' => 'SuperAdmin'])
            ->givePermissionTo(Permission::all());

        // roles internos
        Role::create(['name' => 'Gerencia']);
        Role::create(['name' => 'OG Manager']);
        Role::create(['name' => 'Cobros y Pagos']);
        Role::create(['name' => 'Comercial']);
        Role::create(['name' => 'Documentaciones']);
        Role::create(['name' => 'Presupuestos Cuba']);
        Role::create(['name' => 'Presupuestos Costa Rica']);
        Role::create(['name' => 'Presupuestos Guatemala']);
        Role::create(['name' => 'Presupuestos Wateke']);
        Role::create(['name' => 'Product Manager']);
        Role::create(['name' => 'Proveedores Cuba']);
        Role::create(['name' => 'Proveedores Costa Rica']);
        Role::create(['name' => 'Proveedores Guatemala']);
        Role::create(['name' => 'Proveedores Wateke']);
        Role::create(['name' => 'Reservas en Firme']);
        Role::create(['name' => 'Social Media']);

        // roles externos
        Role::create(['name' => 'Proveedores Externos']);
        Role::create(['name' => 'Prestatarios Externos']);







        // create default users
        User::factory()->create([
            'name' => 'Alberto',
            'email' => 'soporteit@wateke.tech',
            'password' => Hash::make('B3lcr0s5*8905'),
            'phone' => '+53 54771254',
            'about' => '  ',
            'enable' => true
        ])->assignRole('SuperAdmin');

        User::factory()->create([
            'name' => 'Eduardo',
            'email' => 'pjunior@wateke.tech',
            'password' => Hash::make('B3lcr0s5*8905'),
            'phone' => '+53 58643912',
            'about' => '  ',
            'enable' => true
        ])->assignRole('SuperAdmin');

        User::factory()->create([
            'name' => 'Erduin',
            'email' => 'itmanager@wateke.tech',
            'password' => Hash::make('B3lcr0s5*8905'),
            'phone' => '+53 58640646',
            'about' => '  ',
            'enable' => true
        ])->assignRole('SuperAdmin');


        // default metrics
        Task::create([
            'name' => 'Presupuestos Solicitados',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron solicitados',
            'enable' => true,
            'type_frec' => 'dialy'
        ]);
        Task::create([
            'name' => 'Presupuestos Respondidos por Correo',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron enviados por el Correo',
            'enable' => true,
            'type_frec' => 'dialy'
        ]);
        Task::create([
            'name' => 'Presupuestos Respondidos por Web',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron enviados por la Web',
            'enable' => true,
            'type_frec' => 'dialy'
        ]);
        Task::create([
            'name' => 'Presupuestos Respondidos por Movil',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron enviados por el Movil',
            'enable' => true,
            'type_frec' => 'dialy'
        ]);
        Task::create([
            'name' => 'Reservas en Firme',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron convertidos a reservas',
            'enable' => true,
            'type_frec' => 'dialy'
        ]);
        










    }
}
