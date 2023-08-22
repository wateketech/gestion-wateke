<?php

namespace App\Http\Livewire\Contacts\Contacts;

use App\Models\Contact;
use App\Models\ContactId as Ids;
use App\Models\ContactEmail as Emails;
use App\Models\ContactPhone as Phones;
use App\Models\ContactInstantmessage as Instantmessages;
use App\Models\ContactRrss as Rrsss;
use App\Models\ContactWeb as Webs;
use App\Models\ContactDate as Dates;
use App\Models\ContactPublishUs as PublishUss;
use App\Models\ContactAddress as Addresss;
use App\Models\ContactAddressLine as AddressLines;

use App\Models\ContactEmailType as EmailTypes;
use App\Models\ContactPhoneType as PhoneTypes;
use App\Models\ContactInstantMessageType as InstantMessageTypes;
use App\Models\ContactRrssType as RrssTypes;
use App\Models\ContactWebType as WebTypes;
use App\Models\ContactCountrie as Countries;
use App\Models\ContactDateType as DateTypes;
use App\Models\ContactPublishUsType as PublishUsTypes;
use App\Models\ContactIdType as IdTypes;

class ContactClass {
    public $alias;
    public $name;
    public $middle_name;
    public $first_lastname;
    public $second_lastname;
    public $prefix_id;
    public $gender_id;
    public $about;
    public $meta;
    public $enable;
    public $locked;
    public $is_editing;
    public $edited_by;
    public $created_by;
    public $busy;
    public $busy_by;

    public $ids = [];
    public $emails = [];
    public $phones = [];
    public $instant_messages = [];
    public $webs = [];
    public $rrss = [];
    public $dates = [];
    public $publish_us = [];

    public function __construct() {
        // $this->genders = Genders::all()->where('enable', true);
        // $this->gender = $this->genders->first()->id;
        // $this->email_types = EmailTypes::all()->where('enable', true);
        // $this->phone_types = PhoneTypes::all()->where('enable', true);
        // $this->instant_message_types = InstantMessageTypes::all()->where('enable', true);
        // $this->rrss_types = RrssTypes::all()->where('enable', true);
        // $this->web_types = WebTypes::all()->where('enable', true);
        // $this->countries = Countries::all()->where('enable', true);
        // $this->date_types = DateTypes::all()->where('enable', true);
        // $this->publish_us_types = PublishUsTypes::all()->where('enable', true);
        // $this->id_types = IdTypes::all()->where('enable', true);
    }

    public function addEmail($value=null, $type_id=null, $label=null, $meta="{\"is_valid\":null}", $is_primary=false, $about=''){
        try {
            $email = $value;
            [$username, $domain] = explode('@', $email);
            $provider = explode('.', $domain)[0];

            $type = EmailTypes::all()->where('enable', true)->firstWhere('value', $provider);
            if ($type) {
                $type_id = $type->id;
            } else {
                $type_id = null;
            }
        }catch (\Exception $e) {
        }

        $this->emails[] = ['type_id' => $type_id, 'label' => $label, 'value' => $value, 'is_primary' => $is_primary, 'about' => $about, 'meta' => $meta];
    }

    public function addMeta($value){
        $this->meta = json_encode(array_merge((array)json_decode($this->meta, true), $value));
    }


    public function addPhone($value=null, $type_id=null, $label=null, $meta="{\"is_valid\":null}", $is_primary=false, $about=''){

    }
    public function addInstantMessage($value=null, $type_id=null, $label=null, $meta="{\"is_valid\":null}", $is_primary=false, $about=''){

    }

}
