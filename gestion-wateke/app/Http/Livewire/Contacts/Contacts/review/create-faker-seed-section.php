<?php

use Livewire\Component;


class Create extends Component
{

// -------------------------- DATOS DE PRUEBA  --------------------------
    private function datos_prueba()
    {
        $this->alias = 'El bebe';
        $this->name = 'Alberto';
        $this->middle_name = 'de Jesús';
        $this->first_lastname = 'Licea';
        $this->second_lastname = 'Vallejo';
        $this->about = 'Una pequeña descripción del contacto en cuestión.';
        $this->gender = 1;
        $this->prefix = 5;
        $this->ids = [
            ['type_id' => 1, 'value' => '00090120123'],
            ['type_id' => 2, 'value' => 'A1234567'],
        ];
        // $this->main_profile_pic = 0;
        // $this->profile_pics = [];

        $this->emails = [
            ['type_id' => '1', 'is_primary' => false, 'label' => 'Personal', 'value' => 'albertolicea00@outlook.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '3', 'is_primary' => true, 'label' => 'Personal', 'value' => 'albertolicea00@icloud.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '2', 'is_primary' => false, 'label' => 'Trabajo', 'value' => 'albertolicea00@gmail.com', 'about' => '', 'meta' => "{\"is_valid\":false}"],
        ];

        $this->phones = [
            ['type_id' => 2, 'value' => '32292629', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32292629\",\"number\":\"+5332292629\",\"call_number\":\"+5332292629\",\"clean_number\":\"32292629\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ['type_id' => 3, 'value' => '32271900', 'is_primary' => true, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32271900\",\"number\":\"+5332271900\",\"call_number\":\"+5332271900\",\"clean_number\":\"32271900\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ['type_id' => 1, 'value' => '5615459878', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+1 5615459878\",\"number\":\"+15615459878\",\"call_number\":\"+15615459878\",\"clean_number\":\"5615459878\",\"country_code\":null,\"country_dial_code\":\"1\",\"country_iso2\":\"us\",\"country_name\":\"United States\"}"],
            ['type_id' => 6, 'value' => '354771264', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":false,\"value\":\"+53 54771264\",\"number\":\"+5354771264\",\"call_number\":\"+5354771264\",\"clean_number\":\"54771264\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
        ];
        $this->instant_messages = [
            ['type_id' => 2, 'label' => 'Personal', 'value' => '+5354771264', 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 1, 'label' => 'Personal', 'value' => '+5354771264', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"],
            ['type_id' => 3, 'label' => 'Trabajo', 'value' => 'soporteit@wateke.travel', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => 1, 'label' => 'Ventas', 'value' => '+54771264', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];

        $this->webs = [
            ['type_id' => 1, 'value' => 'albertos-blog.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 2, 'value' => 'alberto.licea', 'about' => '', 'meta' => "{\"is_valid\":null}"],
            ['type_id' => 6, 'value' => 'wateke.travel', 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];
        $this->rrss = [
            ['type_id' => 4, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => 1, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 2, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];


        $this->address = [
            ['city_id' => "21825", 'country_id' => "56", 'geolocation' => null, 'name' => "Casa 1", 'state_id' => "286", 'zip_code' => "70100"],
            ['city_id' => "21825", 'country_id' => "56", 'geolocation' => null, 'name' => "Casa 2", 'state_id' => "286", 'zip_code' => "70100"],
        ];
        $this->address_line = [
            [
                ['label' => "Localidad", 'value' => "Centro"],
                ['label' => "Número", 'value' => "364"],
                ['label' => "Calle", 'value' => "Bembeta"],
                ['label' => "entre", 'value' => "Cielo"],
                ['label' => "y", 'value' => "20 de Mayo"],
            ],
            [
                ['label' => "Localidad", 'value' => "Centro"],
                ['label' => "Número", 'value' => "568"],
                ['label' => "Calle", 'value' => "Bembeta"],
                ['label' => "entre", 'value' => "Cielo"],
                ['label' => "y", 'value' => "20 de Mayo"],
            ]
        ];


        $this->dates = [
            ['type_id' => '1', 'value' => '2000-05-16'],
            ['type_id' => '2', 'value' => '2011-04-25'],
        ];
        $this->publish_us = [
            ['type_id' => '1', 'value' => 'albertosblog.com', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '3', 'value' => 'tut12app.com', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => '2', 'value' => 'albertolicea00.com', 'meta' => "{\"is_valid\":true}"],
        ];

    }

}
