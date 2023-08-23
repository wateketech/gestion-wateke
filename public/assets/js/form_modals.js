import * as consts from './const.js';


window.addEventListener('contact-group-form', function($event){
    if ($event.detail.mode == 'enable'){
        var tittle ='Habilitar grupo con ' + $event.detail.ccontactos + ' contactos';
        var confirmButtonText = 'Recuperar';
        var livewireAction = 'enable_contact_group';
        var showDenyButton = "<i class='fas fa-trash-alt'> </i> Eliminar para siempre";
    }
    else if ($event.detail.mode == 'create'){
        var tittle ='Crear grupo de ' + $event.detail.ccontactos + ' contactos';
        var confirmButtonText = 'Crear';
        var livewireAction = 'create_contact_group';
        var showDenyButton = ''
    }
    else if($event.detail.mode == 'edit'){
        var tittle = 'Editar grupo de ' + $event.detail.ccontactos + ' contactos';
        var confirmButtonText = 'Actualizar';
        var livewireAction = 'update_contact_group';
        var showDenyButton =  "<i class='fas fa-trash-alt'> </i> Eliminar";
    }

    consts.swalWithBootstrapButtons.fire({
        position: 'center' ,
        title: tittle,
        html: "\
        <div class='form-group pt-2'>\
            <label for='group_name' class='form-control-label px-3'\
                style='width: 99%;text-align: start;'>\
                Nombre *\
            </label>\
            <div class='input-group mb-0 px-3'>\
                <span class='input-group-text'>\
                    <input value=" + $event.detail.color + " type='color' name='group_color' id='group_color'\
                        style='-webkit-appearance: none;padding: 0;border:none;border-radius: 5%;width: 20px;height: 20px'/>\
                </span>\
                <input value='" + $event.detail.name + "' class='form-control'\
                    type='text' name='group_name' id='group_name'\
                    style='padding-left: 50px !important;'>\
                </div>\
            </div>\
        </div>\
        ",
        showDenyButton: showDenyButton == '' ? false : true,
        denyButtonText: showDenyButton,
        confirmButtonText: confirmButtonText,
        showCancelButton: true,
        reverseButtons: true,
        footer: $event.detail.error
        }).then((result) => {
        if (result.isConfirmed) {
            let name = document.getElementById('group_name').value;
            let color = document.getElementById('group_color').value;
            // let icon = document.getElementById('group_icon');
            let icon = '<i class="fas fa-user-friends"></i>';

            Livewire.emit(livewireAction, name, color, icon, $event.detail.id);
        }
        else if (result.isDenied) {
            consts.swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas Seguro?',
                html: "\
                <p>¡Al eliminar el grupo: <strong class='text-danger'>" + $event.detail.name + "</strong>, NO habrá vuelta atrás!</p>\
                <p>Confirme tecleando el nombre del grupo a eliminar</p>\
                <small><strong>Nota: </strong> Los contactos asociados a este grupo no se eliminarán</small>\
                ",
                icon: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Borralo',
                cancelButtonText: 'Cancelar',
                timer: 50000

            }).then(async (result) => {
                if (result.isConfirmed) {
                    if (result.value === $event.detail.name) {
                        new Promise((resolve) => {
                            Livewire.emit('delete_contact_group', result.value, $event.detail.id);
                            resolve();
                        })
                        .then(() => {
                            consts.Toast.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El grupo ha sido eliminado de la base de datos.',
                            });

                        });
                    }else{
                        consts.Toast.fire(
                            '¡Error al eliminar!',
                            'Error en el nombre de confirmacion al eliminar el grupo :)',
                            'error'
                        )
                    }
                } else if
                ( result.dismiss === Swal.DismissReason.cancel){
                    consts.Toast.fire(
                        'Cancelado',
                        'El grupo está a salvo :)',
                        'warning'
                    )
                }
            });
        }
    });
});
