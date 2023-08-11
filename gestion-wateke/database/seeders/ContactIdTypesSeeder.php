<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactIdType as ContactIdTypes;

class ContactIdTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactIdTypes::createMany([
            [
                'label' => 'CI',
                'icon' =>'<i class="fas fa-id-card pr-4"> CI</i>',
                'title' => 'Carnet de Identidad',
                'regEx' => json_encode([
                    "es" => "/^[0-9]{8}[A-Z]{1}$/",
                    "cu" => "/^[0-9]{11}$/",
                    "cr" => "/^[1-9]{1}[0-9]{8}$/",
                    "gt" => "/^[1-9]{1}[0-9]{7}[1-9A-Z]{1}$/",
                    "us" => "/^[0-9]{9}$/",
                    "uk" => "/^[A-Z]{2}[0-9]{6}[A-Z]{0,1}$/",
                    "ca" => "/^[1-9]{1}[0-9]{8}$/",
                    "fr" => "/^[1-9]{1}[0-9]{12}$/"
                ])
            ],[
                'label' => 'PSP',
                'icon' =>'<i class="fas fa-passport pr-2"> PSP</i>',
                'title' => 'Pasaporte',
                'regEx' => json_encode([
                    "es" => "/^[A-Z]{1}[0-9]{7}$/",
                    "cu" => "/^[A-Z]{2}[0-9]{7}$/",
                    "cr" => "/^[A-Z]{2}\d{6}$/",
                    "gt" => "/^[A-Z]{2}\d{6}[A-Z]$/",
                    "us" => "/^[A-Z]{1}[0-9]{8}$/",
                    "uk" => "/^[A-Z]{2}[0-9]{7}$/",
                    "ca" => "/^[A-Z]{1}[0-9]{7}$/",
                    "fr" => "/^[A-Z]{2}[0-9]{7}$/"
                ])
            ]
        ]);
    }
}
