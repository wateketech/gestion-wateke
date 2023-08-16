<?php

namespace App\Http\Livewire\Contacts;

use App\Http\Livewire\Account\Management\User\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Contact;

class ImportExport extends Component
{
    use WithFileUploads;

    public $fistRowHeader = true;
    public $overwrite = false;

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
                $header = array_key_exists('header', $result) ? $result['header'] : null;
                $data = $result['data'];
                $header = str_getcsv($header, $this->getSeparator($header) , '"');

                foreach ($data as $data) {
                    $contact = new Contact();
                    $values = explode($this->getSeparator($data), $data);

                    switch ($this->platform) {
                        // arreglar los valores que tienen muchas "
                        // foreach ($values as $value) {
                        //     $values[] = trim($value, '"');
                        // }

                        case 'brevo':
                            $contact = $this->get_brevo_data($data, $header, $contact);
                            break;

                        case 'microsoft':
                            $contact = $this->get_microsoft_data($data, $header, $contact);
                            break;

                        case 'vcard':
                            $contact = $this->get_vcard_data($data, $header, $contact);
                            break;

                        default:
                            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning',
                                'text' => 'Esta operación no soporta la plataforma del archivo cargado']);
                            return;
                        }

                        if ($this->checkMatch($contact)){
                            $this->contacts_bad[] = $contact;
                        }else{
                            $this->contacts_good[] = $contact;
                        }


                }
            // } catch (\Throwable $th) {
            //     $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'danger', 'text' => 'Ha ocurrido un error al importar los contactos']);
            //     return;
            // }
        }
        $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'success', 'text' => 'x Contactos importados exitosamente']);
    }






    private function get_brevo_data($data, $header, $contact){
        foreach ($header as $label) {
            switch (strtoupper(trim($label))) {
                case "CONTACT ID":

                    break;
                case "EMAIL":

                    break;
                case "NOMBRE":

                    break;
                case "SURNAME":

                    break;
                case "SMS":

                    break;
                case "WHATSAPP":

                    break;
                case "DOUBLE_OPT":

                    break;
                case "MONOPARENTAL":

                    break;
                case "ZONA_SPAIN":

                    break;
                case "PAIS":

                    break;
                case "OPT_IN":

                    break;
                case "ACEPTACION_PRIVACIDAD":

                    break;
                case "ORIGEN":

                    break;
                case "PROVINCIA":

                    break;
                case "MONOPARENTALES":

                    break;
                case "NOMBRE_SURNAME":

                    break;
                case "NOMBRE_DEL_CONTACTO":

                    break;
                case "ADDED_TIME":

                    break;
                case "MODIFIED_TIME":

                    break;
                case 'value':
                    # code...
                    break;

                default:
                    # code...
                    break;
            }
        }
        return $contact;
    }
    private function get_microsoft_data($data, $header, $contact){
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
    private function get_vcard_data($data, $header, $contact){
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




}
