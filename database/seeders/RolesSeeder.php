<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        Role::create(['name' => 'Invitado', 'display_name' => 'Invitado']);

        // create roles and assign permissions
        Role::create(['name' => 'SuperAdmin', 'display_name' =>'SuperAdmin' ]);
        //     ->givePermissionTo(Permission::all());

        // roles internos
        Role::create(['name' => 'Gerencia', 'display_name' => 'Gerencia']);
        Role::create(['name' => 'OG Manager', 'display_name' => 'OG Manager']);
        Role::create(['name' => 'Cobros y Pagos', 'display_name' => 'Cobros y Pagos']);
        Role::create(['name' => 'Comercial', 'display_name' => 'Comercial']);
        Role::create(['name' => 'Documentaciones', 'display_name' => 'Documentaciones']);
        Role::create(['name' => 'Presupuestos Cuba', 'display_name' => 'Presupuestos Cuba']);
        Role::create(['name' => 'Presupuestos Costa Rica', 'display_name' => 'Presupuestos Costa Rica']);
        Role::create(['name' => 'Presupuestos Guatemala', 'display_name' => 'Presupuestos Guatemala']);
        Role::create(['name' => 'Presupuestos Wateke', 'display_name' => 'Presupuestos Wateke']);
        Role::create(['name' => 'Product Manager', 'display_name' => 'Product Manager']);
        Role::create(['name' => 'Proveedores Cuba', 'display_name' => 'Proveedores Cuba']);
        Role::create(['name' => 'Proveedores Costa Rica', 'display_name'=> 'Proveedores Costa Rica']);
        Role::create(['name' => 'Proveedores Guatemala', 'display_name' => 'Proveedores Guatemala']);
        Role::create(['name' => 'Proveedores Wateke', 'display_name' => 'Proveedores Wateke']);
        Role::create(['name' => 'Reservas en Firme', 'display_name'=> 'Reservas en Firme']);
        Role::create(['name' => 'Social Media', 'display_name' => 'Social Media']);

        // roles externos
        Role::create(['name' => 'Proveedores Externos', 'display_name' => 'Proveedores Externos']);
        Role::create(['name' => 'Prestatarios Externos', 'display_name' => 'Prestatarios Externos']);
    }
}
