<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityDateType as EntityDateTypes;


class EntityDateTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityDateTypes::createMany([
            [
                'label' => 'Ignaguración',
                'color' => 'rgb(236, 198, 25)',
                'icon' => '<i class="fas fa-birthday-cake"></i>',
            ]
        ]);
    }
}
