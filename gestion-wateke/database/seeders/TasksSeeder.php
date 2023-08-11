<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default metrics
        Task::create([
            'name' => 'Visitas Comerciales',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Realizar visitas comerciales a agencias',
            'enable' => true,
            'type_frec' => 'daily',
            'permanent' => true
        ],[
            'name' => 'Presupuestos Solicitados',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron solicitados',
            'enable' => true,
            'type_frec' => 'daily',
            'permanent' => true
        ],[
            'name' => 'Presupuestos Respondidos por Correo',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron enviados por el Correo',
            'enable' => true,
            'type_frec' => 'daily',
            'permanent' => true
        ],[
            'name' => 'Presupuestos Respondidos por Web',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron enviados por la Web',
            'enable' => true,
            'type_frec' => 'daily',
            'permanent' => true
        ],[
            'name' => 'Presupuestos Respondidos por Movil',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron enviados por el Movil',
            'enable' => true,
            'type_frec' => 'daily',
            'permanent' => true
        ],[
            'name' => 'Reservas en Firme',
            'type_value' => 'number',
            'average' => '1',
            'about' => 'Presupuestos que fueron convertidos a reservas',
            'enable' => true,
            'type_frec' => 'daily',
            'permanent' => true
        ]);
    }
}
