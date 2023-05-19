<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityPublishUsType as EntityPublishUsTypes;

class Entity_publish_us_TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityPublishUsTypes::createMany([]);
    }
}
