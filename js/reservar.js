$(document).ready(function () {
    // Capturar envío del formulario
    $('#form-reserva').on('submit', function (e) {
        e.preventDefault();

        let valido = true;

        // Validar campos requeridos manualmente
        $('#form-reserva input[required], #form-reserva select[required]').each(function () {
            const input = $(this);
            let errorMensaje = input.next('.mensaje-error');

            if (errorMensaje.length === 0) {
                errorMensaje = $('<p class="mensaje-error"></p>');
                input.after(errorMensaje);
            }

            if (input.val().trim() === '') {
                input.addClass('input-error');
                errorMensaje.text('Este campo es obligatorio.').show();
                valido = false;
            } else {
                input.removeClass('input-error');
                errorMensaje.hide();
            }
        });

        if (!valido) {
            return; // No continúa si hay errores
        }

        const datos = $(this).serialize();

        $.ajax({
            url: 'Acciones/guardar_formulario.php',
            method: 'POST',
            data: datos,
            dataType: 'json',
            success: function (resp) {
                if (resp.status === 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Reserva Exitosa!',
                        text: 'Su reservación ha sido registrada con éxito.'
                    }).then(() => {
                        if (resp.habitaciones_disponibles === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Sin disponibilidad',
                                text: 'No hay más habitaciones disponibles en este momento.',
                                confirmButtonText: 'Cerrar'
                            }).then(() => {
                                window.location.href = 'index.html';
                            });
                        } else {
                            actualizarHabitacionesDisponibles();
                            $('#form-reserva')[0].reset();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: resp.message
                    });
                }
            },
            error: function (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error inesperado',
                    text: 'No se pudo contactar con el servidor.'
                });
            }
        });
    });
});

// Función para actualizar dinámicamente las habitaciones
function actualizarHabitacionesDisponibles() {
    $.ajax({
        url: 'Acciones/listar-habitaciones-disponibles.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            const select = $('select[name="habitacion_id"]');
            select.empty();
            if (data.length === 0) {
                select.append('<option value="">No hay habitaciones disponibles</option>');
            } else {
                select.append('<option value="">Seleccione una habitación</option>');
                data.forEach(hab => {
                    select.append(`<option value="${hab.idhabitacion}">${hab.nom_hab}</option>`);
                });
            }
        },
        error: function (err) {
            console.error('Error al cargar habitaciones disponibles:', err);
        }
    });
}
