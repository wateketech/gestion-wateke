<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserRole;
use DB;



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
            'about' => '  '
        ])->assignRole('SuperAdmin');

        User::factory()->create([
            'name' => 'Eduardo',
            'email' => 'pjunior@wateke.tech',
            'password' => Hash::make('B3lcr0s5*8905'),
            'phone' => '+53 58643912',
            'about' => '  '
        ])->assignRole('SuperAdmin');

        // User::factory()->create([
        //     'name' => 'Kadir',
        //     'email' => 'a.general@wateke.tech',
        //     'role' => 'Admin',
        //     'password' => Hash::make('Wateke2023+'),
        //     'phone' => '+53 58354698',
        //     'about' => 'Una descripcion mia de ejemplo para el perfil de la app'
        // ]);
        // User::factory()->create([
        //     'name' => 'Patricia',
        //     'email' => 'rrhh@wateke.tech',
        //     'role' => 'RRHH',
        //     'password' => Hash::make('Wateke2023+'),
        //     'phone' => '+53 52346500',
        //     'about' => 'Hola este es una descripcion breve mia'
        // ]);
        // User::factory()->create([
        //     'name' => 'Norge',
        //     'email' => 'comercial@wateke.travel',
        //     'role' => 'Comercial',
        //     'password' => Hash::make('Wateke2023+'),
        //     'phone' => '+53 53667802',
        //     'about' => 'Hola este es mi descripcion como comercial'
        // ]);







    }
}
