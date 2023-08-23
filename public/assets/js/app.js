import file_pond_es from './lang/file-pond-es.js';
import * as consts from './const.js';
import * as app from './function.js';
import './function_event.js';
import './form_modals_messages.js';
import './form_modals.js';
import './help_messages.js';





// Register the plugins
FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.setOptions(file_pond_es);


// global functions
window.copyToClipboard = app.copyToClipboard;
