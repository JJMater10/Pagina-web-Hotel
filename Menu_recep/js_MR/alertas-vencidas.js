$(document).ready(function () {
    function verificarReservasExpiradas() {
        $.ajax({
            url: 'acciones_MR/obtener-reservas-expiradas.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (reserva) {
                    const clave = 'reserva_' + reserva.idhospedaje;

                    if (!sessionStorage.getItem(clave)) {
                        toastr.warning(
                            `La estadía del huésped ${reserva.nombre} ha finalizado.`,
                            'Reserva Finalizada',
                            {
                                onclick: function () {
                                    Swal.fire({
                                        title: `¿Qué deseas hacer con la reserva de ${reserva.nombre}?`,
                                        icon: 'question',
                                        showCancelButton: true,
                                        showDenyButton: true,
                                        confirmButtonText: 'Finalizar',
                                        denyButtonText: 'Actualizar',
                                        cancelButtonText: 'Cancelar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Acción para finalizar reserva
                                            finalizarReserva(reserva.idhospedaje);
                                        } else if (result.isDenied) {
                                            // Mostrar modal para actualizar
                                            abrirModalActualizarReserva(reserva.idhospedaje);
                                        }
                                    });
                                }
                            }
                        );

                        sessionStorage.setItem(clave, true);
                    }
                });
            },
            error: function (error) {
                console.error('❌ Error obteniendo reservas expiradas:', error);
            }
        });
    }

    function finalizarReserva(idhospedaje) {
        $.post("acciones_MR/finalizar-reserva.php", { idhospedaje }, function (resp) {
            Swal.fire('Finalizado', 'La reserva ha sido marcada como finalizada.', 'success');
        }).fail(function () {
            Swal.fire('Error', 'No se pudo finalizar la reserva.', 'error');
        });
    }

    function abrirModalActualizarReserva(idhospedaje) {
        // Aquí puedes cargar datos en el modal según tu implementación
        console.log("Abrir modal de actualización para ID:", idhospedaje);
        $('#modalEditarReserva').modal('show');

        // Puedes usar AJAX aquí si necesitas traer info detallada
    }

    verificarReservasExpiradas();
    setInterval(verificarReservasExpiradas, 15000); // Cada 15 segundos
});


