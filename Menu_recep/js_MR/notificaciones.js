console.log("✔️ notificaciones.js cargado");

$(document).ready(function () {
    let idsMostrados = new Set(JSON.parse(sessionStorage.getItem('idsMostrados')) || []);

    function tiempoTranscurrido(fechaISO) {
        const fecha = new Date(fechaISO);
        const ahora = new Date();
        const diffMs = ahora - fecha;

        const segundos = Math.floor(diffMs / 1000);
        const minutos = Math.floor(segundos / 60);
        const horas = Math.floor(minutos / 60);
        const dias = Math.floor(horas / 24);

        if (dias > 0) return `hace ${dias} día${dias > 1 ? "s" : ""}`;
        if (horas > 0) return `hace ${horas} h`;
        if (minutos > 0) return `hace ${minutos} min`;
        return `hace unos segundos`;
    }

    function cargarNotificaciones() {
        $.ajax({
            url: "acciones_MR/obtener-notificaciones.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                const badge = $("#cantidad-notificaciones");
                const contenedor = $("#lista-notificaciones");

                const noLeidas = data.filter(n => n.leida == 0);
                badge.text(noLeidas.length);
                contenedor.empty();

                if (data.length > 0) {
                    data.forEach(notif => {
                        const li = `
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mr-3 avatar-icon ${notif.leida == 0 ? 'bg-info-lighten-2' : 'bg-secondary'}">
                                        <i class="mdi mdi-bell-ring"></i>
                                    </span>
                                    <div class="notification-content">
                                        <h6 class="notification-heading">${notif.mensaje}</h6>
                                        <span class="notification-text">${tiempoTranscurrido(notif.fecha)}</span>
                                    </div>
                                </a>
                            </li>
                        `;
                        contenedor.append(li);

                        if (!idsMostrados.has(notif.id) && notif.leida == 0) {
                            toastr.info(notif.mensaje, 'Nueva Reservación');
                            idsMostrados.add(notif.id);
                        }
                    });
                } else {
                    contenedor.append('<li><span class="notification-text">No hay notificaciones.</span></li>');
                }

                sessionStorage.setItem('idsMostrados', JSON.stringify(Array.from(idsMostrados)));
            },
            error: function (err) {
                console.error("Error cargando notificaciones:", err);
            }
        });
    }

    function cargarNotificacionesFinalizadas() {
        $.ajax({
            url: "acciones_MR/obtener-reservas-expiradas.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                const badge = $("#cantidad-notificaciones-finalizadas");
                const contenedor = $("#lista-notificaciones-finalizadas");

                badge.text(data.length);
                contenedor.empty();

                if (data.length > 0) {
                    data.forEach(noti => {
                        const li = $(`
                            <li>
                                <a href="javascript:void(0)" class="noti-finalizada" data-id="${noti.idhospedaje}" data-nombre="${noti.nombre}">
                                    <span class="mr-3 avatar-icon bg-warning">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <div class="notification-content">
                                        <h6 class="notification-heading">Huésped ${noti.nombre} ha finalizado su estadía</h6>
                                        <span class="notification-text">${tiempoTranscurrido(noti.fecha_salida)}</span>
                                    </div>
                                </a>
                            </li>
                        `);

                        contenedor.append(li);

                        if (!idsMostrados.has("fin-" + noti.idhospedaje)) {
                            toastr.warning(`Huésped ${noti.nombre} ha finalizado su estadía`, 'Reserva Finalizada');
                            idsMostrados.add("fin-" + noti.idhospedaje);
                        }
                    });
                } else {
                    contenedor.append('<li><span class="notification-text">No hay reservas finalizadas.</span></li>');
                }

                sessionStorage.setItem('idsMostrados', JSON.stringify(Array.from(idsMostrados)));
            },
            error: function (err) {
                console.error("Error cargando notificaciones finalizadas:", err);
            }
        });
    }

    function finalizarReserva(idhospedaje) {
        $.post("acciones_MR/reserva-finalizada-alerta.php", { idhospedaje }, function (resp) {
            Swal.fire('Finalizado', 'La reserva ha sido marcada como finalizada.', 'success');
            cargarNotificacionesFinalizadas();
        }).fail(function () {
            Swal.fire('Error', 'No se pudo finalizar la reserva.', 'error');
        });
    }

function abrirModalActualizarReserva(idhospedaje) {
    $('#modalEditarReserva').modal('show');

    $.ajax({
        url: 'acciones_MR/noti-obtener-datos-reserva.php',
        method: 'GET',
        data: { idhospedaje },
        dataType: 'json',
        success: function (data) {
            const hoy = new Date().toISOString().split('T')[0];

            // Datos del huésped
            $('#edit-prim-nombre').val(data.prim_nom_client);
            $('#edit-seg-nombre').val(data.seg_nom_client);
            $('#edit-prim-apellido').val(data.prim_apelli_client);
            $('#edit-seg-apellido').val(data.seg_apelli_client);
            $('#edit-edad').val(data.edad_client);
            $('#edit-identificacion').val(data.identificacion);
            $('#edit-telefono').val(data.telefono);
            $('#edit-correo').val(data.correo);
            $('#edit-cantidad').val(data.cantidad_personas);

            // Fechas
            $('#edit-fecha-entrada').val(data.fecha_llegada);

            // ✅ Establecer fecha mínima y valor de salida
            const fechaSalidaInput = $('#edit-fecha-salida');
            fechaSalidaInput.attr('min', hoy);

            if (data.fecha_salida >= hoy) {
                fechaSalidaInput.val(data.fecha_salida);
            } else {
                fechaSalidaInput.val(hoy); // Forzar fecha de hoy si la guardada es anterior
            }

            // 🔄 Cargar habitaciones
            $.getJSON('acciones_MR/listar-habitaciones.php', { idactual: data.habitacion_idhabitacion }, function (habitaciones) {
                let habSelect = $('#edit-habitacion');
                habSelect.empty();
                habitaciones.forEach(h => {
                    habSelect.append(`<option value="${h.idhabitacion}">${h.nom_hab} (${h.hab_dispo} disponibles)</option>`);
                });
                habSelect.val(data.habitacion_idhabitacion);
            });

            // 🔄 Cargar estados
            $.getJSON('acciones_MR/listar-estados.php', function (estados) {
                let estadoSelect = $('#edit-estado');
                estadoSelect.empty();
                estados.forEach(e => {
                    estadoSelect.append(`<option value="${e.idestado_hab}">${e.tipo_estado}</option>`);
                });
                estadoSelect.val(data.estado_hab_idestado_hab);
            });
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos.', 'error');
        }
    });
}




    // Iniciar carga de notificaciones
    cargarNotificaciones();
    cargarNotificacionesFinalizadas();

    // Refrescar ambas cada 10 segundos
    setInterval(() => {
        cargarNotificaciones();
        cargarNotificacionesFinalizadas();
    }, 10000);

    // Marcar notificaciones normales como leídas
    $('[data-toggle="dropdown"] .mdi-bell-outline').parent().on('click', function () {
        $.post('acciones_MR/marcar-notificaciones-leidas.php', function () {
            $("#cantidad-notificaciones").text('0');
        });
    });

    // Interacción con notificaciones finalizadas
    // 🔔 Click sobre notificación de reserva finalizada
$(document).on('click', '.noti-finalizada', function () {
    const idhospedaje = $(this).data('id');
    const nombre = $(this).data('nombre');

    Swal.fire({
        title: `¿Qué deseas hacer con la reserva de ${nombre}?`,
        icon: 'question',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: '✅ Finalizar reserva',
        denyButtonText: '🔄 Actualizar reserva',
        cancelButtonText: '❌ Cancelar',
        confirmButtonColor: '#28a728ff',
        denyButtonColor: '#0755ffff',
        cancelButtonColor: '#4b4741de'
    }).then((result) => {
        if (result.isConfirmed) {
            finalizarReserva(idhospedaje);
        } else if (result.isDenied) {
            abrirModalActualizarReserva(idhospedaje);
        }
    });
});


});

$('#guardarCambios').on('click', function () {
    const datos = {
        identificacion: $('#edit-identificacion').val(),
        prim_nom: $('#edit-prim-nombre').val(),
        seg_nom: $('#edit-seg-nombre').val(),
        prim_ape: $('#edit-prim-apellido').val(),
        seg_ape: $('#edit-seg-apellido').val(),
        edad: $('#edit-edad').val(),
        telefono: $('#edit-telefono').val(),
        correo: $('#edit-correo').val(),
        fecha_entra: $('#edit-fecha-entrada').val(),
        fecha_sal: $('#edit-fecha-salida').val(),
        cantidad: $('#edit-cantidad').val(),
        habitacion: $('#edit-habitacion').val(),
        estado: $('#edit-estado').val()
    };

    $.ajax({
        url: 'acciones_MR/guardar-edicion.php',  // ✅ Reutilizamos el archivo existente
        method: 'POST',
        data: datos,
        success: function (resp) {
            if (resp.trim() === 'ok') {
                Swal.fire('¡Actualizado!', 'La reserva se actualizó correctamente.', 'success');
                $('#modalEditarReserva').modal('hide');
                cargarNotificacionesFinalizadas(); // 🔄 Refresca notificaciones
            } else {
                Swal.fire('Error', resp, 'error');
            }
        },
        error: function () {
            Swal.fire('Error', 'No se pudo actualizar la reserva.', 'error');
        }
    });
});
