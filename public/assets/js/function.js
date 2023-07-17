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








function copyToClipboard(text) {
    // Crea un elemento temporal para copiar el texto
    var tempElement = document.createElement("textarea");
    tempElement.value = text;
    tempElement.setAttribute("readonly", "");
    tempElement.style.position = "absolute";
    tempElement.style.left = "-9999px";
    document.body.appendChild(tempElement);

    // Selecciona y copia el texto
    tempElement.select();
    document.execCommand("copy");

    // Elimina el elemento temporal
    document.body.removeChild(tempElement);

    // Muestra una Notificacion
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500
      })

      Toast.fire({
        icon: 'success',
        title: 'Copiado al portapapeles'
      })
  }











