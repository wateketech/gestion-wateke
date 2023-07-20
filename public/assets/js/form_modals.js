import * as consts from './const.js';

window.addEventListener('ddbb-error', function($event){
    consts.swalWithBootstrapButtons.fire({
      icon: 'error',
      title: 'Oops...',
      timer: 5000,
      text: "Hubo un error al procesar sus datos!",
      footer: "<code> " + $event.detail.code + " : " + $event.detail.message + "</code>"
  }).then(() => {
      window.location.href = $event.detail.redirect;
  })
});

window.addEventListener('pics-error', function($event){
    consts.swalWithBootstrapButtons.fire({
      icon: 'warning',
      title: 'Oops...',
      timer: 4000,
      text: "Hubo un error al procesar la imagen!",
      footer: "Luego, podrás actualizarla."
      // confirmButtonText: 'Continuar igualmente',
      // cancelButtonText: 'No, cancelar',
  // }).then((result) => {
      //     if (result.isConfirmed) {
      //         consts.swalWithBootstrapButtons.fire(
      //         'Deleted!',
      //         'Your file has been deleted.',
      //         'success'
      //         )
      //     } else if ( result.dismiss === Swal.DismissReason.cancel){
      //         window.location.href = "/crear-contactos";
      //     }
  }).then((result) => {
      window.dispatchEvent(new CustomEvent('show-created-warning', {text : '¡Contacto creado exitosamente!', redirect : '/contactos'}));
  })
});

window.addEventListener('error-create-user-exist', function($event){
    consts.swalWithBootstrapButtons.fire({
        position: 'center' ,
        title: '¡Ya existen usuarios con los emails!',
        html: "Posteriormente puede crear un usuario y enlazarlo a este contacto de forma manualmente",
        icon: 'warning',
        timer: 10000
    })
});


window.addEventListener('show-created-success', function($event){
    consts.swalWithBootstrapButtons.fire({
      position: 'center' ,
      title: 'Creado',
      html: $event.detail.text,
      icon: 'success',
      timer: 5000
  }).then(() => {
      window.location.href = $event.detail.redirect;
  })
});
window.addEventListener('show-created-warning', function($event){
    consts.swalWithBootstrapButtons.fire({
      position: 'center' ,
      title: 'Creado',
      html: $event.detail.text,
      // footer: "Algunos datos no han sido procesados del todo, luego podrás actualizarlos",
      icon: 'warning',
      timer: 5000
  }).then(() => {
      window.location.href = $event.detail.redirect;
  })
});
window.addEventListener('show-updated-success', function($event){
    consts.swalWithBootstrapButtons.fire({
      position: 'center' ,
      title: 'Actualizado',
      html: $event.detail.text,
      icon: 'success',
      timer: 5000
  }).then(() => {
      window.location.href = $event.detail.redirect;
  })
});
window.addEventListener('show-updated-warning', function($event){
    consts.swalWithBootstrapButtons.fire({
      position: 'center' ,
      title: 'Actualizado',
      html: $event.detail.text,
      // footer: "Algunos datos no han sido procesados del todo, luego podrás actualizarlos",
      icon: 'warning',
      timer: 5000
  }).then(() => {
      window.location.href = $event.detail.redirect;
  })
});



















window.addEventListener('show-delete-contact', function(event){
    let deletedContactId = event.detail.contact_id;
    consts.swalWithBootstrapButtons.fire({
        position: 'center' ,
        title: '¿Estas seguro?',
        html: "\
        <p>¡Al eliminar el contacto NO habrá vuelta atrás!</p>\
        <p>Para confirmar teclee el ID del contacto (<strong class='text-danger'> ID:" + deletedContactId + " </strong>) :</p>\
        ",
        icon: 'warning',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Borralo',
        cancelButtonText: 'Cancelar',
        timer: 50000

    }).then(async (result) => {
        if (result.isConfirmed) {
            if (result.value === deletedContactId) {
                new Promise((resolve) => {
                    Livewire.emit('delete_contact', deletedContactId, result.value);
                    resolve();
                })
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: '¡Eliminado!',
                        text: 'El contacto ha sido eliminado de la base de datos.',
                        // html: "\
                        // <p>El contacto ha sido eliminado de la base de datos.</p>\
                        // <p class='btn btn-outline-secondary py-1 px-2'\
                        //     wire:click=\"enableContact(" + deletedContactId + ")\">Deshacer acción</p>\
                        // "
                    });

                });
            }else{
                Toast.fire(
                    '¡Error al eliminar!',
                    'Error en el id de confirmacion al eliminar el contacto :)',
                    'error'
                )
            }
        } else if
        ( result.dismiss === Swal.DismissReason.cancel){
            Toast.fire(
                'Cancelado',
                'El contacto esta a salvo :)',
                'warning'
            )
        }
    })
});

window.addEventListener('show-delete-contacts', function(event){
    let deletedContactIds = JSON.parse(event.detail.contacts_id);
    let formattedContactIds = deletedContactIds.join(' , ');

    consts.swalWithBootstrapButtons.fire({
        position: 'center' ,
        title: '¿Estas seguro?',
        html: "\
        <p>¡Al eliminar los contactos NO habrá vuelta atrás!</p>\
        <small>Confirme tecleando los IDs de los contacto seguido de una coma</small>\
        <p><strong class='text-danger'> IDs: " + formattedContactIds + " </strong> :</p>\
        ",
        icon: 'warning',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Borralos',
        cancelButtonText: 'Cancelar',
        timer: 50000

    }).then(async (result) => {
        if (result.isConfirmed) {
            if (result.value === deletedContactIds.join(', ')) {
                new Promise((resolve) => {
                    Livewire.emit('delete_contacts', deletedContactIds, result.value);
                    resolve();
                })
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: '¡Eliminado!',
                        text: 'Los contactos ha sido eliminados de la base de datos.',
                        // html: "\
                        // <p>Los contactos han sido eliminados de la base de datos.</p>\
                        // <p class='btn btn-outline-secondary py-1 px-2'\
                        //     wire:click=\"enableContact(" + deletedContactId + ")\">Deshacer acción</p>\
                        // "
                    });

                });
            }else{
                Toast.fire(
                    '¡Error al eliminar!',
                    'Error en los ids de confirmacion al eliminar los contactos :)',
                    'error'
                )
            }
        } else if
        ( result.dismiss === Swal.DismissReason.cancel){
            Toast.fire(
                'Cancelado',
                'Los contactos están a salvo :)',
                'warning'
            )
        }
    })
});

window.addEventListener('show-recovery-contact-success', function(event){
    let is_multiple = event.detail.is_multiple;

    Toast.fire({
        title: '¡Recuperado!',
        text: is_multiple ? 'Contacto recuperado exitosamente.' : 'Contactos recuperados exitosamente.',
        icon: 'success',
    });
});

window.addEventListener('show-recovery-contact-error', function(event){
    let is_multiple = event.detail.is_multiple;

    Toast.fire({
        title: '¡Error!',
        text: is_multiple ? 'No se ha podido recuper el contacto.' : 'No se han podido recuper los contactos.',
        icon: 'danger',
    });
});

