<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityInstantMessageType as EntityInstantMessageTypes;

class EntityInstantMessageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityInstantMessageTypes::createMany([
            [
                'label' => 'WhatsApp',
                'regEx' => '/^[a-zA-Z0-9_-]{5,20}$/i',
            ],[
                'label' => 'Telegram',
                'regEx' => '/^[a-zA-Z0-9_]{5,32}$/i',
            ],[
                'label' => 'Microsoft Teams',
                'regEx' => '/^[a-zA-Z0-9_@.-]{1,64}$/i',
            ],[
                'label' => 'Hangouts',
                'regEx' => '/^[a-zA-Z0-9._-]{6,30}$/i',
            ],[
                'label' => 'Slack',
                'regEx' => '/^[a-zA-Z0-9._-]{1,21}$/i',
            ],[
                'label' => 'Facebook Messenger',
                'regEx' => '/^[a-zA-Z][a-zA-Z0-9_.,-]{5,31}$/i',
            ],[
                'label' => 'Snapchat',
                'regEx' => '/^[a-zA-Z0-9._-]{3,15}$/i',
            ],[
                'label' => 'WeChat',
                'regEx' => '/^[a-zA-Z0-9_-]{6,20}$/i',
            ],[
                'label' => 'Line',
                'regEx' => '/^[a-zA-Z0-9]{3,20}$/i11',
            ],[
                'label' => 'Viber',
                'regEx' => '/^[a-zA-Z0-9._-]{2,30}$/i',
            ],[
                'label' => 'Signal',
                'regEx' => '/^[a-zA-Z0-9]+([ _.-][a-zA-Z0-9]+)*$/i',
            ]
        ]);
    }
}
