<?php

namespace App\Http\Livewire\Contacts;

use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Account\Management\User\User;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Http\Livewire\Contacts\Contacts\ContactClass as ContactClass;

class ImportExport extends Component
{
    use WithFileUploads;

    public $fistRowHeader = true;
    public $overwrite = false;

    public $temp_contact = [];
    public $contacts_good = [];
    public $contacts_bad = [];
    private $match_name_percentage = 0.9;
    private $match_email_percentage = 0.05;

    public $contact_id;
    public $contact_ids;
    public $multiple;
    public $platform;
    public $extension;
    public $file;

    protected $listeners = [
        'importContactsQ', 'importContacts',
        'exportContactsQ', 'exportContact','exportContacts',
        'importEntitysQ',  'importEntitys',
        'exportEntitysQ',  'exportEntity','exportEntitys',
        'loadFile'
    ];
    public function render()
    {
        return view('livewire.contacts.import-export');
    }





    // contact section
    public function importContactsQ(){
        $this->dispatchBrowserEvent('import-contacts', [
            'action' => 'importContacts',
            'id_component' => $this->id
        ]);
    }
    public function exportContactsQ($args){
        $this->multiple = $args['multiple'];

        if($this->multiple) {
            $this->contact_ids = $args['id'];
            $this->dispatchBrowserEvent('export-contacts', [
                'multiple' => 'true',
                'action' => 'exportContacts',
                'title' => '<i class="fas fa-download"></i> &nbsp; Exportar ' . count($args['id']) . ' Contactos</p>'
            ]);
        }else{
            $this->contact_id = $args['id'];
            $this->dispatchBrowserEvent('export-contacts', [
                'multiple' => 'false',
                'action' => 'exportContact',
                'title' => '<i class="fas fa-download"></i> &nbsp; Exportar 1 Contacto</p>'
            ]);
        }

    }

    public function loadFile($data){
    }



    private function checkMatch($contact = null){
        if ($contact === null) return null;

        // ver el grado de coincidencia


        return true;
    }



    private function getHeaderData($lines, $compare = null){
        $result = [];

        // if (true == $compare) {
        if ($this->fistRowHeader){
            $result['header'] = str_replace('"', '', array_shift($lines));
            $result['data'] = $lines;
        }else{
            $result['data'] = $lines;
        }

        // comprueba si tiene cabecera
        if (!isset($result['header'])){
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning',
                'text' => 'Esta operación no soporta archivo cargado, sin cabecera']);
            return;
        }
        return $result;
    }
    private function getSeparator($header){
        $separator = null;

        if (strpos($header, ',') !== false) $separator = ',' ;
        elseif (strpos($header, ';') !== false) $separator = ';' ;
        else {
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning',
                'text' => 'Esta operación no soporta el tipo de archivo cargado']);
            return;
        }

        return $separator;
    }
    private function cleanDataHeader($separator, $data, $header){
        $values = [];
        $data = explode($separator, $data);
        for ($i=0; $i < count($data); $i++) {
            $value = trim($data[$i], '"');
            $values[$header[$i]] = strpos($value, 'b') === 0 ? substr($value, 1) : $value;

        }
        return $values;
    }

    public function importContacts($args){
        // leer el fichero, su header e insertar en la base de datos
        //code to read and insert in database (each one is a error (indices no coinciden))...
        if (array_key_exists('platform', $args)) $platform = $args['platform'];
        if (array_key_exists('extension', $args)) $extension = $args['extension'];

        if(!$this->platform && !$this->extension){
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha especificado una plataforma y/o extensión por la cual importar']);
            return;
        }
        else if (!$this->file){
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha cargado un archivo para importar']);
            return;
        }else{

            switch ($this->extension) {
                case 'xlsx':
                    break;

                case 'csv':
                    break;

                case 'vcf':
                    break;

                default:
                    $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning',
                        'text' => 'Esta operación no soporta el tipo de archivo cargado']);
                    return;
            }

            // try {
                // carga el archivo
                $lines = file($this->file->getRealPath(), FILE_IGNORE_NEW_LINES);
                $result = $this->getHeaderData($lines);

                if ($this->fistRowHeader){
                    $header = array_key_exists('header', $result) ? $result['header'] : null;
                    $separator = $this->getSeparator($header);
                    $data = $result['data'];
                    $header = str_getcsv($header, $separator , '"');
                }else{
                    $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning',
                        'text' => 'Esta operación aun no soporta archivos sin cabecera']);
                    return;
                }

                foreach ($data as $data) {
                    $contact = new ContactClass();

                    if ($this->fistRowHeader) $values = $this->cleanDataHeader($separator, $data, $header);

                    switch ($this->platform) {
                        case 'brevo':
                            if (!$this->fistRowHeader) $values = $this->cleanDataHeader($separator, $data, array_keys($this->brevoHeader()));
                            $contact = $this->get_brevo_data($values, $header, $contact);
                            break;

                        case 'microsoft':
                            if (!$this->fistRowHeader) $values = $this->cleanDataHeader($separator, $data, array_keys($this->microsoftHeader()));
                            $contact = $this->get_microsoft_data($values, $header, $contact);
                            break;

                        case 'vcard':
                            if (!$this->fistRowHeader) $values = $this->cleanDataHeader($separator, $data, array_keys($this->vcardHeader()));
                            $contact = $this->get_vcard_data($values, $header, $contact);
                            break;

                        default:
                            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning',
                                'text' => 'Esta operación no soporta la plataforma del archivo cargado']);
                            return;
                        }

                        if ($this->checkMatch($contact)) {
                            $this->contacts_bad[] = $contact;
                        }else{
                            $this->contacts_good[] = $contact;
                        }


        // !! HASTA AQUÍ FUNCIONA, SIN MULTIPLES EMAILS , ..
                        dd($contact);
                        DB::beginTransaction();
                        // ($contact['contact'])->save();
                        // $contact->emails()->create(['value' => 'hola@email.com']);
                        DB::commit();

                        // DB::rollBack();
                }
            // } catch (\Throwable $th) {
            //     $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'danger', 'text' => 'Ha ocurrido un error al importar los contactos']);
            //     return;
            // }
        }
        $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'success', 'text' => 'x Contactos importados exitosamente']);
    }



    private function get_brevo_data($values, $header, $contact){
        foreach ($header as $label) {
            // $label = strtoupper(trim($label));
            if (isset($this->brevoHeader()[$label])) {
                $this->brevoHeader()[$label]($values, $contact);
            } else {
                $contact->about .= "\n" . $label . $values[$label];
            }
        }
        return $contact;
    }
    private function get_microsoft_data($values, $header, $contact){
        foreach ($header as $label) {
            switch ($label) {
                case "CONTACT ID":
                    break;
                default:
                    break;
            }
        }
        return $contact;
    }
    private function get_vcard_data($values, $header, $contact){
        foreach ($header as $label) {
            switch (strtoupper(trim($label))) {
                case "CONTACT ID":
                    break;
                default:
                    break;
            }
        }
        return $contact;
    }




    public function exportContact($args){
        if (array_key_exists('platform', $args)) $this->platform = $args['platform'];
        if (array_key_exists('extension', $args)) $this->extension = $args['extension'];
        if ($this->platform && $this->extension){













        }else{
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha especificado una plataforma y/o extensión para la cual exportar']);
            return;
        }
    }
    public function exportContacts($args){
        if (array_key_exists('platform', $args)) $this->platform = $args['platform'];
        if (array_key_exists('extension', $args)) $this->extension = $args['extension'];
        if ($this->platform && $this->extension){














        }else{
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha especificado una plataforma y/o extensión para la cual exportar']);
        }
    }















    // entity section
    public function importEntitysQ(){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportEntitysQ($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function importEntitys(){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportEntity($id){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportEntitys($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }









    private function createContact(){

    }























    public function brevoHeader(){
        return [
            "CONTACT ID" => function($values, $contact){
                    $contact->addMeta(value : ['brevo_id' => $values['CONTACT ID']]);
            }
            ,"EMAIL" => function($values, $contact){
                    $contact->addEmail(value:$values['EMAIL'], is_primary: true);
            }
            ,"NOMBRE" => function($values, $contact){
                    $names = explode(' ', $values['NOMBRE']);
                    $contact->name = $names[0] ?? '';
                    $contact->middle_name = isset($names[1]) ? $names[1] : '';
            }
            ,"SURNAME" => function($values, $contact){
                    $lastNames = explode(' ', $values['SURNAME']);
                    $contact->first_lastname = $lastNames[0] ?? '';
                    $contact->second_lastname = isset($lastNames[1]) ? $lastNames[1] : '';
            }
            ,"SMS" => function($values, $contact){
                    $contact->addPhone(value : $values['SMS']);
            }
            ,"WHATSAPP" => function($values, $contact) {
                    $contact->addInstantMessage(value : $values['WHATSAPP'], type_id : 1);
            }
            ,"DOUBLE_OPT-IN" => function($values, $contact) {
                    $contact->addMeta(value : ['brevo_DOUBLE_OPT-IN' => $values['DOUBLE_OPT-IN']]);
            }
            ,"MONOPARENTAL" => function($values, $contact) {
                    $contact->addMeta(value : ['brevo_MONOPARENTAL' => $values['MONOPARENTAL']]);
            }
            ,"ZONA_SPAIN" => function($values, $contact) {}
            ,"PAIS" => function($values, $contact) {}
            ,"OPT_IN" => function($values, $contact) {
                $contact->addMeta(value : ['brevo_OPT_IN' => $values['OPT_IN']]);
            }
            ,"ACEPTACION_PRIVACIDAD"=> function($values, $contact) {
                $contact->addMeta(value : ['brevo_ACEPTACION_PRIVACIDAD' => $values['ACEPTACION_PRIVACIDAD']]);
            }
            ,"ORIGEN" => function($values, $contact) {
                $contact->addMeta(value : ['brevo_ORIGEN' => $values['ORIGEN']]);
            }
            ,"PROVINCIA" => function($values, $contact) {}
            ,"MONOPARENTALES" => function($values, $contact){
                    $contact->addMeta(value : ['brevo_MONOPARENTALES' => $values['MONOPARENTALES']]);
            }
            ,"NOMBRE_SURNAME" => function($values, $contact){
                    $contact->addMeta(value : ['brevo_NOMBRE_SURNAME' => $values['NOMBRE_SURNAME']]);
            }
            ,"NOMBRE_DEL_CONTACTO" => function($values, $contact){
                    $contact->alias = $values['NOMBRE_DEL_CONTACTO'];
            }
            ,"ADDED_TIME" => function($values, $contact){
                    $contact->addMeta(value : ['brevo_ADDED_TIME' => $values['ADDED_TIME']]);
            }
            ,"MODIFIED_TIME" => function($values, $contact){
                    $contact->addMeta(value : ['brevo_MODIFIED_TIME' => $values['MODIFIED_TIME']]);
            }
        ];
    }

    public function microsoftHeader(){
        return [

        ];
    }
    public function vcardHeader(){
        return [

        ];
    }

}
