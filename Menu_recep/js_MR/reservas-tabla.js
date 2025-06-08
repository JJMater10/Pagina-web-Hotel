$(document).ready(function () {
    $.ajax({
        url: "acciones_MR/reservas-datos.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const cuerpoTabla = $("table.table tbody");
            cuerpoTabla.empty(); // limpia por si acaso

            data.forEach(function (reserva) {
              const fila = `
<tr>
    <td>${reserva.nombre}</td>
    <td>${reserva.identificacion}</td>
    <td>${reserva.telefono}</td>
    <td>${reserva.fecha_entra}</td>
    <td>${reserva.fecha_sal}</td>
    <td>${reserva.habitacion}</td>
    <td>${reserva.estado || 'Sin estado'}</td> <!-- Nueva columna -->
    <td>
        <span>
            <a href="#" 
            class="editar-reserva"
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

            <a href="#"
            class="eliminar-reserva"
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

            // ✅ Activar buscador después de llenar la tabla
            $('#buscador-reservas').on('keyup', function () {
                const valor = $(this).val().toLowerCase();
                cuerpoTabla.find('tr').each(function () {
                    const textoFila = $(this).text().toLowerCase();
                    $(this).toggle(textoFila.includes(valor));
                });
            });
        },
        error: function (err) {
            console.error("Error al cargar reservaciones:", err);
        }
    });
    $(document).on('click', '.editar-reserva', function () {
    $('#edit-nombre').val($(this).data('nombre'));
    $('#edit-ident').val($(this).data('identificacion'));
    $('#edit-tel').val($(this).data('telefono'));
    $('#edit-entrada').val($(this).data('entrada'));
    $('#edit-salida').val($(this).data('salida'));

   const idHabitacion = $(this).data('idhabitacion');
const idEstado = $(this).data('idestado');

// Carga las habitaciones y selecciona la correspondiente
cargarHabitaciones(idHabitacion);

// Carga los estados y selecciona el actual
cargarEstados(idEstado);


});
});



// Función para cargar las habitaciones en el select del modal de edición
// Esta función se llama al cargar la página y cada vez que se abre el modal de edición
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


// Llamamos la función una vez al cargar
cargarHabitaciones();


// Función para guardar los cambios de la reserva
// Esta función se llama al hacer clic en el botón "Guardar Cambios"
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

                // Esperamos a que termine la alerta y luego recargamos
                setTimeout(() => {
                    location.reload();
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

// Función para eliminar una reserva
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
            // Hacer la eliminación por AJAX
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

                        // Esperamos a que pase la alerta y recargamos
                        setTimeout(() => location.reload(), 1600);
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

//Función para cargar los estados en el select del modal de edición
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

