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
                'icon' => "<i class='fab fa-whatsapp fa-lg'></i>",
                'url' => 'https://wa.me/',
                'about' => 'Recuerda incluir el código de país',
            ],[
                'label' => 'Telegram',
                'regEx' => '/^[a-zA-Z0-9_]{5,32}$/i',
                'icon' => "<i class='fab fa-telegram fa-lg'></i>",
                'url' => 'https://t.me/',
                'about' => null,
            ],[
                'label' => 'Microsoft Teams',
                'regEx' => '/^[a-zA-Z0-9_@.-]{1,64}$/i',
                'icon' => "<i class='fab fa-microsoft fa-lg'></i>",
                'url' => 'https://teams.microsoft.com/l/chat/0/',
                'about' => null,
            ],[
                'label' => 'Hangouts',
                'regEx' => '/^[a-zA-Z0-9._-]{6,30}$/i',
                'icon' => "<i class='fab fa-google-plus-g fa-lg'></i>",
                'url' => 'https://hangouts.google.com/chat/person/',
                'about' => null,
            ],[
                'label' => 'Slack',
                'regEx' => '/^[a-zA-Z0-9._-]{1,21}$/i',
                'icon' => "<i class='fab fa-slack fa-lg'></i>",
                'url' => 'https://{nombre-del-equipo}.slack.com/team/',
                'about' => null,
            ],[
                'label' => 'Facebook Messenger',
                'regEx' => '/^[a-zA-Z][a-zA-Z0-9_.,-]{5,31}$/i',
                'icon' => "<i class='fab fa-facebook-messenger fa-lg'></i>",
                'url' => 'https://m.me/',
                'about' => null,
            ],[
                'label' => 'Snapchat',
                'regEx' => '/^[a-zA-Z0-9._-]{3,15}$/i',
                'icon' => "<i class='fab fa-snapchat fa-lg'></i>",
                'url' => 'https://www.snapchat.com/add/',
                'about' => null,
            ],[
                'label' => 'WeChat',
                'regEx' => '/^[a-zA-Z0-9_-]{6,20}$/i',
                'icon' => "<i class='fab fa-weixin fa-lg'></i>",
                'url' => null,
                'about' => null,
            ],[
                'label' => 'Line',
                'regEx' => '/^[a-zA-Z0-9]{3,20}$/i11',
                'icon' => "<i class='fab fa-line fa-lg'></i>",
                'url' => 'https://line.me/ti/p/~',
                'about' => null,
                
            ],[
                'label' => 'Viber',
                'regEx' => '/^[a-zA-Z0-9._-]{2,30}$/i',
                'icon' => "<i class='fab fa-viber fa-lg'></i>",
                'url' => 'viber://add?number=',
                'about' => null,
            ],[
                'label' => 'Signal',
                'regEx' => '/^[a-zA-Z0-9]+([ _.-][a-zA-Z0-9]+)*$/i',
                'icon' => "<i class='fab fa-signal fa-lg'></i>",
                'url' => null,
                'about' => null,
            ]
        ]);
    }
}
