<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactWebType as ContactWebTypes;

class ContactWebTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactWebTypes::createMany([
            ['label' => 'Blog' ],
            ['label' => 'Portafolio' ],
            ['label' => 'Foro' ],
            ['label' => 'Comunidad' ],
            ['label' => 'eCommerce' ],
            ['label' => 'Web' ]
        ]);
    }
}
