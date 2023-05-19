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
            ['label' => 'Movil' ],
            ['label' => 'Casa' ],
            ['label' => 'Trabajo' ],
            ['label' => 'Oficina' ],
            ['label' => 'Fax' ],
            ['label' => 'VoIP' ]
        ]);
    }
}
