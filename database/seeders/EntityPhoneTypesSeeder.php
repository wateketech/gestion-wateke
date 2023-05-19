<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityPhoneType as EntityPhoneTypes;
class EntityPhoneTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityPhoneTypes::createMany([
            ['label' => 'Principal' ],
            ['label' => 'Atención al cliente' ],
            ['label' => 'Soporte técnico' ],
            ['label' => 'Compras' ],
            ['label' => 'Ventas' ],
            ['label' => 'Recursos humanos' ],
            ['label' => 'Contabilidad' ],
            ['label' => 'Marketing' ]
        ]);
    }
}
