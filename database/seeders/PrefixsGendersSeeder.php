<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prefix as Prefixs;
use App\Models\Gender as Genders;

class PrefixsGendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

// ------------------------ GENDERS ------------------------
        $male = Genders::create([
                'label' => "Masculino",
                'pronoun' => "El",
                'meta' => null,
                'icon'=> '<i class="fas fa-male fa-lg"></i>'
            ]);
        $female = Genders::create([
                'label' => "Femenino",
                'pronoun' => "Ella",
                'meta' => null,
                'icon'=> '<i class="fas fa-female fa-lg"></i>'
            ]);



// ------------------------ PREFIXS ------------------------
        $Sr = Prefixs::create([
            'label' => json_encode([
                'abb' => "Sr",
                'exp' => "Señor",
                ]),
            'meta' => null,
            'icon'=> ''
            ])->id;
        $Sra = Prefixs::create([
            'label' => json_encode([
                'abb' => "Sra",
                'exp' => "Señora",
                ]),
            'meta' => null,
            'icon'=> ''
            ])->id;
        $Srta = Prefixs::create([
            'label' => json_encode([
                'abb' => "Srta",
                'exp' => "Señorita",
                ]),
            'meta' => null,
            'icon'=> ''
            ])->id;
        $Mr = Prefixs::create([
            'label' => json_encode([
                'abb' => "Mr",
                'exp' => "Master",
                ]),
            'meta' => null,
            'icon'=> ''
           ])->id;
        $Dr = Prefixs::create([
            'label' => json_encode([
                'abb' => "Dr",
                'exp' => "Doctor",
                ]),
            'meta' => null,
            'icon'=> ''
           ])->id;
        $Lic = Prefixs::create([
            'label' => json_encode([
                'abb' => "Lic",
                'exp' => "Licenciado",
                ]),
            'meta' => null,
            'icon'=> ''
            ])->id;
        $Ing = Prefixs::create([
            'label' => json_encode([
                'abb' => "Ing",
                'exp' => "Ingeniero",
                ]),
            'meta' => null,
            'icon'=> ''
            ])->id;




// ------------------------ RELATIONS ------------------------

        $male->prefixs()->attach([
            $Sr,
            $Mr,
            $Dr,
            $Lic,
            $Ing,
        ]);

        $female->prefixs()->attach([
            $Sra,
            $Srta,
            $Mr,
            $Dr,
            $Lic,
            $Ing,
        ]);

    }
}
