export const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
      container: 'swal-wide-container',
      popup: 'swal-wide-popup',
      confirmButton: 'btn btn-primary border-2 mx-2',
      denyButton: 'btn btn-danger border-2 mx-1',
      cancelButton: 'btn btn-outline-secondary border-2 mx-2',
  },
  buttonsStyling: false
})
export const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4500,
    showCloseButton: true // Agregamos esta opción
})


export const questionModals = Swal.mixin({
  container: 'swal-wide-container',
  popup: 'swal-wide-popup',
  confirmButton: 'btn btn-success mx-3',
  cancelButton: 'btn btn-danger mx-3',
  position: 'center' ,
  icon: 'question',
  timer: 0,
})

export const actionsModals = Swal.mixin({
  customClass: {
    container: 'swal-wide-container',
    popup: 'swal-wide-popup',
    confirmButton: 'btn btn-primary border-2 mx-2',
    cancelButton: 'btn btn-outline-secondary border-2 mx-2',
  },
  cancelButtonText: 'Cancelar',
  buttonsStyling: false,
  timer: 0,
})















