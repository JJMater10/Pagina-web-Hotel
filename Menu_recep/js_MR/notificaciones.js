console.log("✔️ notificaciones.js cargado");

$(document).ready(function () {
    let idsMostrados = JSON.parse(sessionStorage.getItem('idsMostrados')) || [];

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

                // Contar solo no leídas
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

                        // Mostrar Toastr solo para no leídas nuevas
                        if (!idsMostrados.includes(notif.id) && notif.leida == 0) {
                            toastr.info(notif.mensaje, 'Nueva Reservación');
                            idsMostrados.push(notif.id);
                        }
                    });

                    // Actualizar sessionStorage
                    sessionStorage.setItem('idsMostrados', JSON.stringify(idsMostrados));
                } else {
                    contenedor.append('<li><span class="notification-text">No hay notificaciones.</span></li>');
                }
            },
            error: function (err) {
                console.error("Error cargando notificaciones:", err);
            }
        });
    }

    cargarNotificaciones();
    setInterval(cargarNotificaciones, 10000);

    // Marcar como leídas cuando clic en campana
    $(".icons.dropdown").on('click', function() {
        $.ajax({
            url: 'acciones_MR/marcar-notificaciones-leidas.php',
            method: 'POST',
            success: function() {
                $("#cantidad-notificaciones").text('0');
            }
        });
    });
});
