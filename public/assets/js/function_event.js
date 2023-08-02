import * as consts from './const.js';

window.addEventListener('show-in-progress', function($event){
  consts.swalWithBootstrapButtons.fire({
    position: 'center' ,
    title: '<p class="h3"><i class="fas fa-tools"></i> &nbsp; En construcción</p>',
    html: 'vuelva pronto para ver esta acción en funcionamiento',
    icon: 'warning',
    timer: 5000,
})
});

window.addEventListener('coocking-time', function($event){
    let timerInterval
    Swal.fire({
      // imageUrl: '../assets/img/logos/notification_plane_30.gif',
      // imageWidth: 400,
      // imageHeight: 200,
        //   title: 'Lo estamos cocinando',
        //   html: 'Esto tomará unos segundos <img class="w-25 m-auto mt-4 mb-2" src="../assets/img/logos/loading.gif">',
      //   title: 'Lo estamos cocinando',
        html: '\
          <img src="../assets/img/logos/notification_plane_30.gif" alt="Cargando..." width="400" height="200" \
            style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 2em;border-radius: 20px;margin-top: 1em;">\
          <p style="text-align: center !important;font-family: Comfortaa;">\Esto solo tomará unos segundos</p><p style="margin-bottom: 0em !important; margin-top: 1em !important;">\
          <img src="../assets/img/logos/loading.gif" alt="Cargando..." width="75" height="75" \
            style="display: block; margin-left: auto; margin-right: auto;">\
          </p>',
        timer: $event.detail.time,
        timerProgressBar: true,
        allowOutsideClick: false,
        backdropOpacity: 0.2,
        showConfirmButton: false,
        showCancelButton: false,
        // allowEscapeKey: false,
        didOpen: () => {
            console.log();
            // Swal.showLoading()
            // const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                // b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    })
});





window.addEventListener('export-contacts', function($event){
  let action = $event.detail.action;
  let tittle = $event.detail.title;


  consts.actionsModals.fire({
      position: 'center' ,
      title: tittle ,
      html: '\
      <p class="form-title text-center my-0 pb-3">¿ Para que plataforma desea exportar ?</p>\
      <div class="w-65 m-auto my-4">\
          <div class="row justify-content-between">\
              <a class="col-12 btn btn-primary disabled text-white opacity-8"> SUITE Microsoft</a>\
                <a class="col mx-1 btn btn-outline-primary"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'microsoft\', extension: \'csv\' });">\
                  CSV</a>\
                <a class="col mx-1 btn btn-outline-primary"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'microsoft\', extension: \'xlsx\' });">\
                  XLSX</a>\
               <a class="col mx-1 btn btn-outline-primary"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'microsoft\', extension: \'txt\' });">\
                  TXT</a>\
\
          </div>\
          <div class="row justify-content-between mt-4">\
              <a class="col-12 btn btn-primary disabled text-white opacity-8"> Contactos Brevo</a>\
                <a class="col mx-1 btn btn-outline-primary"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'brevo\', extension: \'csv\' });">\
                  CSV</a>\
                <a class="col mx-1 btn btn-outline-primary"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'brevo\', extension: \'xlsx\' });">\
                  XLSX</a>\
               <a class="col mx-1 btn btn-outline-primary"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'brevo\', extension: \'txt\' });">\
                  TXT</a>\
\
          </div>\
      </div>\
      ',
      showConfirmButton: false,
  })
});


window.addEventListener('import-contacts', function($event){
  let action = $event.detail.action;
  let tittle = '<i class="fas fa-cloud-upload-alt"></i> &nbsp; Importar Contactos</p>';


  consts.actionsModals.fire({
      position: 'center' ,
      title: tittle ,
      html: '\
      <p class="form-title text-center my-0 pb-3">¿ Desde que plataforma desea importar ?</p>\
      <div class="w-65 m-auto my-4">\
          <div class="row justify-content-between">\
              <a class="col-12 btn btn-outline-primary opacity-8"\
              onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'microsoft\' });">\
              SUITE Microsoft</a>\
              <a class="col-12 btn btn-outline-primary opacity-8"\
                  onclick="Livewire.emit(\'' + $event.detail.action + '\', { platform: \'brevo\' });">\
                  Contactos Brevo</a>\
          </div>\
      </div>\
      ',
      showConfirmButton: false,
  })
});


