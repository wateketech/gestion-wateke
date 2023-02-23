<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Alberto',
            'email' => 'soporteit@wateke.tech',
            'role' => 'Admin',
            'password' => Hash::make('Wateke2023+'),
            'phone' => '+53 54771254',
            'about' => 'No se que poner de descripcion'
        ]);
        User::factory()->create([
            'name' => 'Kadir',
            'email' => 'a.general@wateke.tech',
            'role' => 'Admin',
            'password' => Hash::make('Wateke2023+'),
            'phone' => '+53 58354698',
            'about' => 'Una descripcion mia de ejemplo para el perfil de la app'
        ]);
        User::factory()->create([
            'name' => 'Patricia',
            'email' => 'rrhh@wateke.tech',
            'role' => 'RRHH',
            'password' => Hash::make('Wateke2023+'),
            'phone' => '+53 52346500',
            'about' => 'Hola este es una descripcion breve mia'
        ]);
        User::factory()->create([
            'name' => 'Norge',
            'email' => 'comercial@wateke.travel',
            'role' => 'Comercial',
            'password' => Hash::make('Wateke2023+'),
            'phone' => '+53 53667802',
            'about' => 'Hola este es mi descripcion como comercial'
        ]);

        




    }
}
