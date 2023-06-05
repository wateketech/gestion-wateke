<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactInstantMessageType as ContactInstantMessageTypes;

class ContactInstantMessageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactInstantMessageTypes::createMany([
            [
                'label' => 'WhatsApp',
                'regEx' => '/^[a-zA-Z0-9_-]{5,20}$/i',
                'about' => 'Recuerda incluir el código de país',
            ],[
                'label' => 'Telegram',
                'regEx' => '/^[a-zA-Z0-9_]{5,32}$/i',
                'about' => null,
            ],[
                'label' => 'Microsoft Teams',
                'regEx' => '/^[a-zA-Z0-9_@.-]{1,64}$/i',
                'about' => null,
            ],[
                'label' => 'Hangouts',
                'regEx' => '/^[a-zA-Z0-9._-]{6,30}$/i',
                'about' => null,
            ],[
                'label' => 'Slack',
                'regEx' => '/^[a-zA-Z0-9._-]{1,21}$/i',
                'about' => null,
            ],[
                'label' => 'Facebook Messenger',
                'regEx' => '/^[a-zA-Z][a-zA-Z0-9_.,-]{5,31}$/i',
                'about' => null,
            ],[
                'label' => 'Snapchat',
                'regEx' => '/^[a-zA-Z0-9._-]{3,15}$/i',
                'about' => null,
            ],[
                'label' => 'WeChat',
                'regEx' => '/^[a-zA-Z0-9_-]{6,20}$/i',
                'about' => null,
            ],[
                'label' => 'Line',
                'regEx' => '/^[a-zA-Z0-9]{3,20}$/i11',
                'about' => null,
            ],[
                'label' => 'Viber',
                'regEx' => '/^[a-zA-Z0-9._-]{2,30}$/i',
                'about' => null,
            ],[
                'label' => 'Signal',
                'regEx' => '/^[a-zA-Z0-9]+([ _.-][a-zA-Z0-9]+)*$/i',
                'about' => null,
            ]
        ]);
    }
}
