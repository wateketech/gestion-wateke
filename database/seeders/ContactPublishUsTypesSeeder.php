<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactPublishUsType as ContactPublishUsTypes;

class ContactPublishUsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactPublishUsTypes::createMany([
            ['label' => 'Blog' ],
            ['label' => 'Portafolio' ],
            ['label' => 'Foro' ],
            ['label' => 'Comunidad' ],
            ['label' => 'eCommerce' ],
            ['label' => 'Testimonios o Reseñas'],
            ['label' => 'Web' ]
        ]);
    }
}
