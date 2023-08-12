<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityWebType as EntityWebTypes;

class EntityWebTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityWebTypes::createMany([
            ['label' => 'Web Corporativa' ],
            ['label' => 'eCommerce' ],
            ['label' => 'Marketplace'],
            ['label' => 'Landing Page'],
            ['label' => 'Blog' ],
            ['label' => 'Foro' ],
            ['label' => 'Comunidad' ],
            ['label' => 'Web' ]
        ]);
    }
}
