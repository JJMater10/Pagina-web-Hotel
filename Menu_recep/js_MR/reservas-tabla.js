$(document).ready(function () {
    cargarReservas(); // Se llama al inicio

    // Guardar cambios del modal
    $('#guardarCambios').on('click', function () {
        const datos = {
            identificacion: $('#edit-ident').val(),
            telefono: $('#edit-tel').val(),
            fecha_entra: $('#edit-entrada').val(),
            fecha_sal: $('#edit-salida').val(),
            habitacion: $('#edit-habitacion').val(),
            estado: $('#edit-estado').val()
        };

        $.ajax({
            url: "acciones_MR/guardar-edicion.php",
            method: "POST",
            data: datos,
            success: function (resp) {
                if (resp.trim() === "ok") {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Reservación actualizada correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#modalEditarReserva').modal('hide');

                    // ✅ Actualizar datos en pantalla sin recargar
                    setTimeout(() => {
                    // 🔄 Recargar ambas secciones sin recargar toda la página
                    cargarReservas(); // ya definida
                    actualizarHabitacionesResumen(); // ✅ nueva función
                }, 1600);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error al actualizar",
                        text: resp
                    });
                }
            },
            error: function (err) {
                console.error("Error al enviar datos:", err);
                Swal.fire({
                    icon: "error",
                    title: "Error inesperado",
                    text: "No se pudo contactar con el servidor"
                });
            }
        });
    });
});

function cargarReservas() {
    $.ajax({
        url: "acciones_MR/reservas-datos.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const cuerpoTabla = $("table.table tbody");
            cuerpoTabla.empty();

            data.forEach(function (reserva) {
                const fila = `
<tr>
    <td>${reserva.nombre}</td>
    <td>${reserva.identificacion}</td>
    <td>${reserva.telefono}</td>
    <td>${reserva.fecha_entra}</td>
    <td>${reserva.fecha_sal}</td>
    <td>${reserva.habitacion}</td>
    <td>${reserva.estado || 'Sin estado'}</td>
    <td>
        <span>
            <a href="#" class="editar-reserva"
                data-nombre="${reserva.nombre}"
                data-identificacion="${reserva.identificacion}"
                data-telefono="${reserva.telefono}"
                data-entrada="${reserva.fecha_entra}"
                data-salida="${reserva.fecha_sal}"
                data-habitacion="${reserva.habitacion}"
                data-idhabitacion="${reserva.idhabitacion}"
                data-idestado="${reserva.idestado}" 
                data-toggle="modal"
                data-target="#modalEditarReserva"
                title="Editar">
                <i class="fa fa-pencil color-muted m-r-5"></i>
            </a>

            <a href="#" class="eliminar-reserva"
                data-identificacion="${reserva.identificacion}"
                title="Eliminar">
                <i class="fa fa-trash color-danger"></i>
            </a>
        </span>
    </td>
</tr>
                `;
                cuerpoTabla.append(fila);
            });

            $('#buscador-reservas').on('keyup', function () {
                const valor = $(this).val().toLowerCase();
                cuerpoTabla.find('tr').each(function () {
                    $(this).toggle($(this).text().toLowerCase().includes(valor));
                });
            });
        },
        error: function (err) {
            console.error("Error al cargar reservaciones:", err);
        }
    });
}

$(document).on('click', '.editar-reserva', function () {
    $('#edit-nombre').val($(this).data('nombre'));
    $('#edit-ident').val($(this).data('identificacion'));
    $('#edit-tel').val($(this).data('telefono'));
    $('#edit-entrada').val($(this).data('entrada'));
    $('#edit-salida').val($(this).data('salida'));

    const idHabitacion = $(this).data('idhabitacion');
    const idEstado = $(this).data('idestado');

    cargarHabitaciones(idHabitacion);
    cargarEstados(idEstado);
});

function cargarHabitaciones(habitacionSeleccionada = null) {
    $.ajax({
        url: "acciones_MR/listar-habitaciones.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const select = $('#edit-habitacion');
            select.empty();

            data.forEach(function (hab) {
                const selected = (habitacionSeleccionada == hab.idhabitacion) ? 'selected' : '';
                select.append(`<option value="${hab.idhabitacion}" ${selected}>${hab.nom_hab}</option>`);
            });
        },
        error: function (err) {
            console.error("Error al cargar habitaciones:", err);
        }
    });
}

function cargarEstados(estadoSeleccionado = null) {
    $.ajax({
        url: "acciones_MR/listar-estados.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const select = $('#edit-estado');
            select.empty();

            data.forEach(function (estado) {
                const selected = (estadoSeleccionado == estado.idestado_hab) ? 'selected' : '';
                select.append(`<option value="${estado.idestado_hab}" ${selected}>${estado.tipo_estado}</option>`);
            });
        },
        error: function (err) {
            console.error("Error al cargar estados:", err);
        }
    });
}

$(document).on('click', '.eliminar-reserva', function (e) {
    e.preventDefault();

    const identificacion = $(this).data('identificacion');

    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡Esta acción no se puede deshacer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "acciones_MR/eliminar-reservacion.php",
                method: "POST",
                data: { identificacion: identificacion },
                success: function (resp) {
                    if (resp.trim() === "ok") {
                        Swal.fire({
                            title: "¡Eliminado!",
                            text: "La reservación ha sido eliminada.",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => {
                            cargarReservas();
                            actualizarResumen();
                            actualizarHabitaciones();
                        }, 1600);
                    } else {
                        Swal.fire("Error", resp, "error");
                    }
                },
                error: function (err) {
                    console.error("Error al eliminar:", err);
                    Swal.fire("Error", "No se pudo contactar con el servidor", "error");
                }
            });
        }
    });
});

// Función para actualizar resumen de métricas
function actualizarResumen() {
    $.ajax({
        url: "acciones_MR/metricas-resumen.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            $(".total-reservas").text(data.totalReservas);
            $(".total-recaudado").text("$ " + data.totalRecaudo);
        },
        error: function (err) {
            console.error("Error al actualizar resumen:", err);
        }
    });
}

// Función para actualizar habitaciones por tipo
function actualizarHabitaciones() {
    $.ajax({
        url: "acciones_MR/metricas-habitaciones.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            $("#total-habitaciones").text(data.total);
            const contenedor = $("#habitaciones-tipo");
            contenedor.empty();
            data.tipos.forEach(function (tipo) {
                contenedor.append(`<p>${tipo.nom_hab} - Disponibles: ${tipo.hab_dispo}</p>`);
            });
        },
        error: function (err) {
            console.error("Error al actualizar habitaciones:", err);
        }
    });
}

function actualizarHabitacionesResumen() {
    $.ajax({
        url: 'acciones_MR/habitaciones-dashboard.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#total-habitaciones').text(data.total);

            const contenedor = $('#habitaciones-tipo');
            contenedor.empty();

            const colores = {
                'Habitación Estándar': 'bg-primary',
                'Suit Junior': 'bg-success',
                'Suit Presidencial': 'bg-warning'
            };

            data.habitaciones.forEach(hab => {
                const nombre = hab.nombre;
                const disponibles = hab.disponibles;
                const porcentaje = hab.porcentaje.toFixed(0);
                const claseColor = colores[nombre] || 'bg-secondary';

                const bloque = `
                    <div class="mt-4">
                        <h4>${disponibles}</h4>
                        <h6 class="m-t-10 text-muted">${nombre} <span class="pull-right">${porcentaje}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar ${claseColor}" style="width: ${porcentaje}%;" role="progressbar">
                                <span class="sr-only">${porcentaje}% ocupado</span>
                            </div>
                        </div>
                    </div>
                `;
                contenedor.append(bloque);
            });
        },
        error: function (err) {
            console.error('Error al actualizar resumen de habitaciones:', err);
        }
    });
}
