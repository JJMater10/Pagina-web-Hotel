$(document).ready(function () {
    cargarReservas(); // Se llama al inicio

    // Guardar cambios del modal
    $('#guardarCambios').on('click', function () {
        const datos = {
                identificacion: $('#edit-identificacion').val(),
                telefono: $('#edit-telefono').val(),
                fecha_entra: $('#edit-fecha-entrada').val(),
                fecha_sal: $('#edit-fecha-salida').val(),
                habitacion: $('#edit-habitacion').val(),
                estado: $('#edit-estado').val(),
                cantidad: $('#edit-cantidad').val(),
                prim_nom: $('#edit-prim-nombre').val(),
                seg_nom: $('#edit-seg-nombre').val(),
                prim_ape: $('#edit-prim-apellido').val(),
                seg_ape: $('#edit-seg-apellido').val(),
                edad: $('#edit-edad').val(),
                correo: $('#edit-correo').val()
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
            const tabla = $('#tablaReservas');
            const cuerpoTabla = tabla.find("tbody");

            // Si ya existe el DataTable, destruirlo
            if ($.fn.DataTable.isDataTable(tabla)) {
                tabla.DataTable().clear().destroy();
            }

            // Vaciar cuerpo
            cuerpoTabla.empty();

            // Rellenar filas
            data.forEach(function (reserva) {
         const fila = `
                <tr>
                    <td>${reserva.prim_nom}</td>
                    <td>${reserva.prim_ape}</td>
                    <td>${reserva.identificacion}</td>
                    <td>${reserva.telefono}</td>
                    <td>${reserva.fecha_entra}</td>
                    <td>${reserva.fecha_sal}</td>
                    <td>${reserva.habitacion}</td>
                    <td>${reserva.estado || 'Sin estado'}</td>
                    <td>
                        <span>
                            <a href="#" class="editar-reserva"
                                data-prim-nombre="${reserva.prim_nom}"
                                data-seg-nombre="${reserva.seg_nom}"
                                data-prim-apellido="${reserva.prim_ape}"
                                data-seg-apellido="${reserva.seg_ape}"
                                data-edad="${reserva.edad}"
                                data-identificacion="${reserva.identificacion}"
                                data-telefono="${reserva.telefono}"
                                data-correo="${reserva.correo}"
                                data-entrada="${reserva.fecha_entra}"
                                data-salida="${reserva.fecha_sal}"
                                data-cantidad="${reserva.cantidad}"
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

            // Inicializar DataTable
            tabla.DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                order: [[4, "desc"]],
                language: {
                    processing: "Procesando...",
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    },
                    aria: {
                        sortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        },
        error: function (err) {
            console.error("Error al cargar reservaciones:", err);
        }
    });
}


$(document).on('click', '.editar-reserva', function () {
    $('#edit-prim-nombre').val($(this).data('prim-nombre'));
    $('#edit-seg-nombre').val($(this).data('seg-nombre'));
    $('#edit-prim-apellido').val($(this).data('prim-apellido'));
    $('#edit-seg-apellido').val($(this).data('seg-apellido'));
    $('#edit-edad').val($(this).data('edad'));
    $('#edit-identificacion').val($(this).data('identificacion'));
    $('#edit-telefono').val($(this).data('telefono'));
    $('#edit-correo').val($(this).data('correo'));
    $('#edit-fecha-entrada').val($(this).data('entrada'));
    $('#edit-fecha-salida').val($(this).data('salida'));
    $('#edit-cantidad').val($(this).data('cantidad'));

    cargarHabitaciones($(this).data('idhabitacion'));
    cargarEstados($(this).data('idestado'));
});

function cargarHabitaciones(habitacionSeleccionada = null) {
    $.ajax({
        url: "acciones_MR/listar-habitaciones.php",
        method: "GET",
        data: { idactual: habitacionSeleccionada },
        dataType: "json",
        success: function (data) {
            const select = $('#edit-habitacion');
            select.empty();

            data.forEach(function (hab) {
                const selected = (habitacionSeleccionada == hab.idhabitacion) ? 'selected' : '';
                select.append(`<option value="${hab.idhabitacion}" ${selected}>${hab.nom_hab} (Disponibles: ${hab.hab_dispo})</option>`);
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


$('#btnActualizarReservas').on('click', function() {
    cargarReservas();
});