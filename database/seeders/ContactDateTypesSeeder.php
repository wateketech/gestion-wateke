<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactDateType as ContactDateTypes;


class ContactDateTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactDateTypes::createMany([
            [
                'label' => 'Cumpleaños',
                'color' => 'rgb(236, 198, 25)',
                'icon' => '<i class="fas fa-birthday-cake"></i>',

            ],[
                'label' => 'Aniversario',
                'color' => 'rgb(255, 153, 200)',
                'icon' => '<i class="fas fa-heart"></i>',

            ],[
                'label' => 'Santo',
                'color' => 'rgb(194, 194, 194)',
                'icon' => '<i class="fas fa-pray"></i>',

            ],[
                'label' => 'Graduación',
                'color' => 'rgb(73, 162, 232)',
                'icon' => '<i class="fas fa-user-graduate">',
            ]
        ]);

    }
}
