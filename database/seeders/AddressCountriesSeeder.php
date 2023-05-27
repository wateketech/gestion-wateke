<?php

namespace Database\Seeders;

use App\Models\AddressCountry as AddressCountries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_string = file_get_contents('./database/seeders/data/address_countries.json');
        if (json_last_error() !== JSON_ERROR_NONE) die('Error: No se pudo decodificar el archivo JSON');
        $countries = json_decode($json_string, true);

        AddressCountries::createMany([

            $countries


            ]);
    }
}
