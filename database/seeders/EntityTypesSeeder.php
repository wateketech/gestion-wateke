<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityType as EntityTypes;

class EntityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityTypes::createMany([
            [
                "model" => "App\Models\ManagementGroup",
                "table" => "management_groups",
                "visual_name_s" => "Grupo de Gestión",
                "visual_name_p" => "Grupos de Gestión",
                "icon" => "<i class='fas fa-users opacity-10' aria-hidden='true'></i>",
                "color" => "#E9EDC9"
            ],[
                "model" => "App\Models\AgencyMainoffice",
                "table" => "agency_mainoffices",
                "visual_name_s" => "Agencia Minorista",
                "visual_name_p" => "Agencias Minoristas",
                "icon" => "<i class='fas fa-store-alt opacity-10' aria-hidden='true'></i>",
                "color" => "#CDB4DB"
            ],[
                "model" => "App\Models\AgencyBranch",
                "table" => "agency_branchs",
                "visual_name_s" => "Agencia Mayorista",
                "visual_name_p" => "Agencias Mayoristas",
                "icon" => "<i class='fas fa-store opacity-10' aria-hidden='true'></i>",
                "color" => "#FFAFCC"
            ],[
                "model" => "App\Models\Restaurant",
                "table" => "restaurants",
                "visual_name_s" => "Restaurante",
                "visual_name_p" => "Restaurantes",
                "icon" => "<i class='fas fa-glass-cheers opacity-10' aria-hidden='true'></i>",
                "color" => "#D2B48C"
            ],[
                "model" => "App\Models\HotelGroup",
                "table" => "hotel_groups",
                "visual_name_s" => "Grupo Hotelero",
                "visual_name_p" => "Grupos Hoteleros",
                "icon" => "<i class='fas fa-city opacity-10' aria-hidden='true'></i>",
                "color" => "#D8E2DC"
            ],[
                "model" => "App\Models\Hotel",
                "table" => "hotels",
                "visual_name_s" => "Hotel",
                "visual_name_p" => "Hoteles",
                "icon" => "<i class='fas fa-hotel opacity-10' aria-hidden='true'></i>",
                "color" => "#D0F4DE"
            ],[
                "model" => "App\Models\Hostel",
                "table" => "hostels",
                "visual_name_s" => "Hostal",
                "visual_name_p" => "Hostales",
                "icon" => "<i class='fas fa-house-user opacity-10' aria-hidden='true'></i>",
                "color" => "#A9DEF9"
            ],[
                "model" => "App\Models\Paladar",
                "table" => "paladars",
                "visual_name_s" => "Paladar",
                "visual_name_p" => "Paladares",
                "icon" => "<i class='fas fa-utensils opacity-10' aria-hidden='true'></i>",
                "color" => "#8B4513"
            ],[
                "model" => "App\Models\Carrier",
                "table" => "carriers",
                "visual_name_s" => "Transportista",
                "visual_name_p" => "Transportistas",
                "icon" => "<i class='fas fa-car-side opacity-10' aria-hidden='true'></i>",
                "color" => "#2F4F4F"
            ],[
                "model" => "App\Models\Airline",
                "table" => "airlines",
                "visual_name_s" => "Compañía Aérea",
                "visual_name_p" => "Compañías Aéreas",
                "icon" => "<i class='fas fa-plane-arrival opacity-10' aria-hidden='true'></i>",
                "color" => "#87CEEB"
            ],[
                "model" => "App\Models\AirConsolidator",
                "table" => "air_consolidators",
                "visual_name_s" => "Consolidador Aéreo",
                "visual_name_p" => "Consolidadores Aéreos",
                "icon" => "<i class='fas fa-suitcase opacity-10' aria-hidden='true'></i>",
                "color" => "#A2D2FF"
            ],[
                "model" => "App\Models\Bar",
                "table" => "bars",
                "visual_name_s" => "Bar",
                "visual_name_p" => "Bares",
                "icon" => "<i class='fas fa-beer opacity-10' aria-hidden='true'></i>",
                "color" => "#FF99C8"
            ]
        ]);
    }
}
