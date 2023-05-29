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
        $decoded_data = json_decode($json_string, true);

        $countries = array_map(function ($country) {
            return [
                "id" => $country["id"],
                "name" =>  $country["name"],
                "iso3" =>  $country["iso3"],
                "iso2" =>  $country["iso2"],
                "numeric_code" =>  $country["numeric_code"],
                "phone_code" =>  $country["phone_code"],
                "capital" =>  $country["capital"],
                "currency" =>  $country["currency"],
                "currency_name" =>  $country["currency_name"],
                "currency_symbol" =>  $country["currency_symbol"],
                "tld" =>  $country["tld"],
                "native" =>  $country["native"],
                "region" =>  $country["region"],
                "subregion" =>  $country["subregion"],
                "timezones" => json_encode($country["timezones"][0]),
                "translations" => json_encode($country["translations"]),
                "latitude" => $country["latitude"],
                "longitude" => $country["longitude"],
                "emoji" => $country["emoji"],
                "emojiU" => $country["emojiU"],
            ];
        }, $decoded_data);

        // dd($countries[1]);

        foreach($countries as $country){
        AddressCountries::createMany([
            $country
            ]);
        }
    }
}
