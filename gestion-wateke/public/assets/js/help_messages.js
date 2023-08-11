// import { questionModals } from './const.js';
import { help_contact_form_general } from './documentation/contacts/form/general.js';
import { help_contact_form_address_lines } from './documentation/contacts/form/address_line.js';










window.addEventListener('help-contact-form-general', function($event){
  help_contact_form_general.start();
});
window.addEventListener('help-contact-form-address-lines', function($event){
  help_contact_form_address_lines.start();
});



