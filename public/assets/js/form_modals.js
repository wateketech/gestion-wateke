import * as consts from './const.js';


window.addEventListener('create-contact-group-form', function($event){
    consts.swalWithBootstrapButtons.fire({
        position: 'center' ,
        title: 'Crear grupo de ' + $event.detail.ccontactos + ' contactos',
        html: "\
        <div class='form-group'>\
            <label for='group_name' class='form-control-label'\
                style='width: 99%;text-align: start;'>\
                Nombre *\
            </label>\
            <div class='input-group mb-0'>\
                <span class='input-group-text'>\
                    <input value=" + $event.detail.color + " type='color' name='group_color' id='group_color'\
                        style='-webkit-appearance: none;padding: 0;border:none;border-radius: 5%;width: 20px;height: 20px'/>\
                </span>\
                <input value='" + $event.detail.name + "' class='form-control'\
                    type='text' name='group_name' id='group_name'\
                    style='padding-left: 50px !important;'>\
                </div>\
            </div>\
            \
        </div>\
        ",
        confirmButtonText: 'Crear',
        showCancelButton: true,
        reverseButtons: true,
        footer: $event.detail.error
        }).then((result) => {
        if (result.isConfirmed) {
            let name = document.getElementById('group_name').value;
            let color = document.getElementById('group_color').value;
            // let icon = document.getElementById('group_icon');
            Livewire.emit('create_contact_group', name, color);
        }
    });
});

