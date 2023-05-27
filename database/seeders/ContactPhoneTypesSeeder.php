<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactPhoneType as ContactPhoneTypes;

class ContactPhoneTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactPhoneTypes::createMany([
            ['label' => 'Movil', 'icon' => '<i class="fas fa-mobile-alt fa-lg px-1"></i>' ],
            ['label' => 'Casa', 'icon' => '<i class="fas fa-home fa-lg"></i>' ],
            ['label' => 'Trabajo', 'icon' => '<i class="fas fa-briefcase fa-lg"></i>' ],
            ['label' => 'Oficina', 'icon' => '<i class="fas fa-building fa-lg"></i>' ],
            ['label' => 'Fax', 'icon' => '<i class="fas fa-fax fa-lg"></i>' ],
            ['label' => 'VoIP', 'icon' => '<i class="fas fa-voicemail"></i>' ]
        ]);
    }
}
