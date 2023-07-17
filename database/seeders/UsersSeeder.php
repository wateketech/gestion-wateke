<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create default users with roles
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

        User::factory()->create([
            'name' => 'Archi',
            'email' => 'arquimedes@placeresmompeller.com',
            'password' => Hash::make('Wateke2023+'),
            'phone' => '+53 58958864',
            'about' => '  ',
            'enable' => true
        ])->assignRole('SuperAdmin');
    }
}
