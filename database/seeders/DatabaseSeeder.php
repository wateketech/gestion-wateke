<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddressCountriesSeeder::class);
        $this->call(AddressStatesSeeder::class);
        $this->call(AddressCitiesSeeder::class);

        $this->call(PrefixsGendersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(EntityTypesSeeder::class);

        $this->call(EntityBankAccountTypesSeeder::class);
        $this->call(EntityDateTypesSeeder::class);
        $this->call(EntityEmailTypesSeeder::class);
        $this->call(EntityIdTypesSeeder::class);
        $this->call(EntityInstantMessageTypesSeeder::class);
        $this->call(EntityPhoneTypesSeeder::class);
        $this->call(EntityPublishUsTypesSeeder::class);
        $this->call(EntityRrssTypesSeeder::class);
        $this->call(EntityWebTypesSeeder::class);

        $this->call(ContactBankAccountTypesSeeder::class);
        $this->call(ContactDateTypesSeeder::class);
        $this->call(ContactEmailTypesSeeder::class);
        $this->call(ContactIdTypesSeeder::class);
        $this->call(ContactInstantMessageTypesSeeder::class);
        $this->call(ContactPhoneTypesSeeder::class);
        $this->call(ContactPublishUsTypesSeeder::class);
        $this->call(ContactRrssTypesSeeder::class);
        $this->call(ContactWebTypesSeeder::class);






    }
}
