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
                "model" => "App\Models\Association",
                "table" => "associations",
                "route" => "asociaciones",
                "visual_name_s" => "Asociación",
                "visual_name_p" => "Asociaciones",
                "icon" => "<i class='fas fa-user-friends opacity-10' aria-hidden='true'></i>",
                "color" => "#ff9b85"
            ],[
                "model" => "App\Models\ManagementGroup",
                "table" => "management_groups",
                "route" => "grupos-de-gestion",
                "visual_name_s" => "Grupo de Gestión",
                "visual_name_p" => "Grupos de Gestión",
                "icon" => "<i class='fas fa-users opacity-10' aria-hidden='true'></i>",
                "color" => "#90937c"
            ],[
                "model" => "App\Models\AgencyBranch",
                "table" => "agency_branchs",
                "route" => "agencias-mayoristas",
                "visual_name_s" => "Agencia Mayorista",
                "visual_name_p" => "Agencias Mayoristas",
                "icon" => "<i class='fas fa-store opacity-10' aria-hidden='true'></i>",
                "color" => "#9d8aa7"
            ],[
                "model" => "App\Models\AgencyMainoffice",
                "table" => "agency_mainoffices",
                "route" => "agencias-minoristas",
                "visual_name_s" => "Agencia Minorista",
                "visual_name_p" => "Agencias Minoristas",
                "icon" => "<i class='fas fa-store-alt opacity-10' aria-hidden='true'></i>",
                "color" => "#CDB4DB"
            ],[
                "model" => "App\Models\Insurance",
                "table" => "insurances",
                "route" => "seguros",
                "visual_name_s" => "Seguro",
                "visual_name_p" => "Seguros",
                "icon" => "<i class='fas fa-hand-holding-heart opacity-10' aria-hidden='true'></i>",
                "color" => "#FF99C8"
            ],[
                "model" => "App\Models\Ttoo",
                "table" => "ttoos",
                "route" => "ttoos",
                "visual_name_s" => "Tour Operador",
                "visual_name_p" => "Tour Operadores",
                "icon" => "<i class='fas fa-headset opacity-10' aria-hidden='true'></i>",
                "color" => "#fe6d73"
            ],[
                "model" => "App\Models\Dmc",
                "table" => "dmcs",
                "route" => "dmcs",
                "visual_name_s" => "DMC",
                "visual_name_p" => "DMC's",
                "icon" => "<i class='fas fa-route opacity-10' aria-hidden='true'></i>",
                "color" => "#3d5a80"
            ],[
                "model" => "App\Models\Visa",
                "table" => "visas",
                "route" => "visados",
                "visual_name_s" => "Visado",
                "visual_name_p" => "Visados",
                "icon" => "<i class='fas fa-passport opacity-10' aria-hidden='true'></i>",
                "color" => "#98c1d9"
            ],[
                "model" => "App\Models\AirConsolidator",
                "table" => "air_consolidators",
                "route" => "consolidadores-aereos",
                "visual_name_s" => "Consolidador Aéreo",
                "visual_name_p" => "Consolidadores Aéreos",
                "icon" => "<i class='fas fa-suitcase opacity-10' aria-hidden='true'></i>",
                "color" => "#43bccd"
            ],[
                "model" => "App\Models\Airline",
                "table" => "airlines",
                "route" => "companias-aereas",
                "visual_name_s" => "Compañía Aérea",
                "visual_name_p" => "Compañías Aéreas",
                "icon" => "<i class='fas fa-plane opacity-10' aria-hidden='true'></i>",
                "color" => "#87CEEB"
            ],[
                "model" => "App\Models\CarRental",
                "table" => "car_rentals",
                "route" => "renta-cars",
                "visual_name_s" => "Renta Car",
                "visual_name_p" => "Renta Cars",
                "icon" => "<i class='fas fa-car-side opacity-10' aria-hidden='true'></i>",
                "color" => "#457575"
            ],[
                "model" => "App\Models\Carrier",
                "table" => "carriers",
                "route" => "transportistas",
                "visual_name_s" => "Transportista",
                "visual_name_p" => "Transportistas",
                "icon" => "<i class='fas fa-bus-alt opacity-10' aria-hidden='true'></i>",
                "color" => "#2F4F4F"
            ],[
                "model" => "App\Models\Restaurant",
                "table" => "restaurants",
                "route" => "restaurantes",
                "visual_name_s" => "Restaurante",
                "visual_name_p" => "Restaurantes",
                "icon" => "<i class='fas fa-glass-cheers opacity-10' aria-hidden='true'></i>",
                "color" => "#D2B48C"
            ],[
                "model" => "App\Models\Paladar",
                "table" => "paladars",
                "route" => "paladares",
                "visual_name_s" => "Paladar",
                "visual_name_p" => "Paladares",
                "icon" => "<i class='fas fa-utensils opacity-10' aria-hidden='true'></i>",
                "color" => "#8B4513"
            ],[
                "model" => "App\Models\Bar",
                "table" => "bars",
                "route" => "bares",
                "visual_name_s" => "Bar",
                "visual_name_p" => "Bares",
                "icon" => "<i class='fas fa-beer opacity-10' aria-hidden='true'></i>",
                "color" => "#f6bd60"
            ],[
                "model" => "App\Models\HotelGroup",
                "table" => "hotel_groups",
                "route" => "grupos-hoteleros",
                "visual_name_s" => "Grupo Hotelero",
                "visual_name_p" => "Grupos Hoteleros",
                "icon" => "<i class='fas fa-city opacity-10' aria-hidden='true'></i>",
                "color" => "#5b8e7d"
            ],[
                "model" => "App\Models\HotelChain",
                "table" => "hotel_chains",
                "route" => "cadenas-hoteleras",
                "visual_name_s" => "Cadena Hotelera",
                "visual_name_p" => "Cadenas Hoteleras",
                "icon" => "<i class='fas fa-city opacity-10' aria-hidden='true'></i>",
                "color" => "#55a630"
            ],[
                "model" => "App\Models\Hotel",
                "table" => "hotels",
                "route" => "hoteles",
                "visual_name_s" => "Hotel",
                "visual_name_p" => "Hoteles",
                "icon" => "<i class='fas fa-hotel opacity-10' aria-hidden='true'></i>",
                "color" => "#17c3b2"
            ],[
                "model" => "App\Models\Hostel",
                "table" => "hostels",
                "route" => "hostales",
                "visual_name_s" => "Hostal",
                "visual_name_p" => "Hostales",
                "icon" => "<i class='fas fa-house-user opacity-10' aria-hidden='true'></i>",
                "color" => "#b0c4b1"
            ]
        ]);
    }
}
