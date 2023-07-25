export const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
      container: 'swal-wide-container',
      popup: 'swal-wide-popup',
      confirmButton: 'btn btn-primary border-2 mx-3',
      cancelButton: 'btn btn-outline-danger border-2 mx-3'
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

















