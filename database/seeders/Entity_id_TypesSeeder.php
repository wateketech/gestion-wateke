<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityIdType as EntityIdTypes;

class EntityIdTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityIdTypes::createMany([
            [
                'label' => 'NIF',
                'title' => 'Número de Identificación Fiscal',
                'regEx' => json_encode([
                    'es' => "/^[0-9]{1,8}[A-Za-z0-9][A-Za-z0-9]?$/",
                    'ad' => "/^[0-9]{8}[A-Za-z0-9]$/",
                    'de' => "/^\d{10,11}$/"
                ])
            ],[
                'label' => 'NIT',
                'title' => 'Número de Identificación Tributaria',
                'regEx' => json_encode([
                    'cr' => "/^[0-9]{10}$/",
                    'cu' => "/^[A-Z]{3}\d{6}[A-Z]?$/"
                ])
            ],[
                'label' => 'CIF',
                'title' => 'Código Único de Identificación',
                'regEx' => json_encode([
                    "gt" => "/^\d{4}\s?\d{6}\s?\d{3}\s?\d{1}$/"
                ])
            ],[
                'label' => 'CUI',
                'title' => 'Código de Identificación Fiscal',
                'regEx' => json_encode([
                    "cu" => "/^[A-Z]{3}\d{6}[A-Z]?$/"
                ])
            ],[
                'label' => 'RFC',
                'title' => 'Registro Federal de Contribuyentes',
                'regEx' => json_encode([
                    "mx" => "/^[A-ZÑ&]{3,4}\d{6}[A-Z\d]{3}$/"
                ])
            ],[
                'label' => 'EIN',
                'title' => 'Número de identificación de empresa',
                'regEx' => json_encode([
                    "us" => "/^(\d{2}-\d{7})$/"
                ])
            ]
        ]);
    }
}
