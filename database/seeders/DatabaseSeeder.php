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

        




    }
}
