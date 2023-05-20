<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityRrssType as EntityRrssTypes;

class EntityRrssTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityRrssTypes::createMany([
            [
                'label' => 'LinkedIn',
                'icon' => '<i class="fab fa-linkedin-in" style="transform:scale(1.5)"></i>',
                'color' => '#0077b5',
            ],[
                'label' => 'Twitter',
                'icon' => '<i class="fab fa-twitter" style="transform:scale(1.5)"></i>',
                'color' => '#1da1f2',
            ],[
                'label' => 'Facebook',
                'icon' => '<i class="fab fa-facebook-f" style="transform:scale(1.5)"></i>',
                'color' => '#3b5998',
            ],[
                'label' => 'Instagram',
                'icon' => '<i class="fab fa-instagram" style="transform:scale(1.8)"></i>',
                'color' => '#e4405f',
            ],[
                'label' => 'Google Plus',
                'icon' => '<i class="fab fa-google-plus-g" style="transform:scale(1.5)"></i>',
                'color' => '#dd4b39',
            ],[
                'label' => 'Youtube',
                'icon' => '<i class="fab fa-youtube" style="transform:scale(1.5)"></i>',
                'color' => '#c4302b',
            ],[
                'label' => 'Pinterest',
                'icon' => '<i class="fab fa-pinterest" style="transform:scale(1.5)"></i>',
                'color' => '#bd081c',
            ]
        ]);
    }
}
