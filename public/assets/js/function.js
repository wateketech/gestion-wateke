export function copyToClipboard(text) {
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




















