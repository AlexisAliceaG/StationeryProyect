const SuccessToast = Swal.mixin({
    toast: true,
    position: 'top-right',
    type: 'success',
    customClass: {
        popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500
});

const ErrorToast = Swal.mixin({
    toast: true,
    position: 'top-right',
    type: 'error',
    customClass: {
        popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500
});

const DeleteToast = Swal.mixin({
    title: '¿Borrar registro?',
    text: 'Esta acción ya no se puede revertir!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#5cb85c",
    confirmButtonText: "Sí, ¡Borrar!"
});

const DeleteConfirmToast = Swal.mixin({
    title: 'Borrado',
    text: 'El Registro se borro!',
    type: 'success',
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar"
});

window.addEventListener('EditSuccess', event => {
    Swal.fire({
        title: "Exito!!",
        text: "El registro se actualizo!",
        type: 'success',
      });
});

window.addEventListener('addSuccess', event => {
    Swal.fire({
        title: "Exito!!",
        text: "El registro se creo!",
        type: 'success',
      });
});

window.addEventListener('confirmSuccess', event => {
    Swal.fire({
        title: "Exito!!",
        text: "El registro la venta!",
        type: 'success',
      });
});

window.addEventListener('CancelSale', event => {
    Swal.fire({
        title: "Exito!!",
        text: "La venta se cancelo!",
        type: 'warning',
      });
});


window.addEventListener('deleteSuccess', event => {
    Swal.fire({
        title: '¡Registro borrado!',
        text: 'El registro ha sido borrado exitosamente.',
        type: 'success',
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar"
    });
});
window.addEventListener('addError', event => {
    Swal.mixin({
        title: '¡Ocurrió un error!',
        text: event.detail.message,
        type: event.detail.icon,
        confirmButtonColor: "#d33",
        confirmButtonText: "Aceptar"
    }).fire();
});
