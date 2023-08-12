<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityEmailType as EntityEmailTypes;

class EntityEmailTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityEmailTypes::createMany([
            [
                'label' => 'Microsoft',
                'value' => 'outlook',
            ],[
                'label' => 'Google',
                'value' => 'gmail',
            ],[
                'label' => 'Apple',
                'value' => 'icloud',
            ],[
                'label' => 'Yahoo',
                'value' => 'yahoo',
            ],[
                'label' => 'AOL',
                'value' => 'aol',
            ]
        ]);
    }
}
