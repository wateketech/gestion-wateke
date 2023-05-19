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
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(EntityTypesSeeder::class);

        $this->call(Entity_bank_account_TypesSeeder::class);
        $this->call(Entity_date_TypesSeeder::class);
        $this->call(Entity_email_TypesSeeder::class);
        $this->call(Entity_id_TypesSeeder::class);
        $this->call(Entity_instant_message_TypesSeeder::class);
        $this->call(Entity_phone_TypesSeeder::class);
        $this->call(Entity_publish_us_TypesSeeder::class);
        $this->call(Entity_rrss_TypesSeeder::class);
        $this->call(Entity_web_TypesSeeder::class);

        $this->call(Contact_bank_account_TypesSeeder::class);
        $this->call(Contact_date_TypesSeeder::class);
        $this->call(Contact_email_TypesSeeder::class);
        $this->call(Contact_id_TypesSeeder::class);
        $this->call(Contact_instant_message_TypesSeeder::class);
        $this->call(Contact_phone_TypesSeeder::class);
        $this->call(Contact_publish_us_TypesSeeder::class);
        $this->call(Contact_rrss_TypesSeeder::class);
        $this->call(Contact_web_TypesSeeder::class);

    }
}
