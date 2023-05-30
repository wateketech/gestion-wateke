<?php

namespace Database\Seeders;

use App\Models\AddressCity as AddressCities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_string = file_get_contents('./database/seeders/data/address_cities.json');
        if (json_last_error() !== JSON_ERROR_NONE) die('Error: No se pudo decodificar el archivo JSON');
        $decoded_data = json_decode($json_string, true);


        foreach($decoded_data as $city){
            AddressCities::create([
                "id" => $city["id"],
                "name" => $city["name"],
                "state_id" => $city["state_id"],
                "state_code" => $city["state_code"],
                "state_name" => $city["state_name"],
                "country_id" => $city["country_id"],
                "country_code" => $city["country_code"],
                "country_name" => $city["country_name"],
                "latitude" => $city["latitude"],
                "longitude" => $city["longitude"],
                "wikiDataId" => $city["wikiDataId"],
            ]);
        };

    }
}
