// En este archivo se obtiene las notificaciones no leídas de la base de datos y se devuelven en formato JSON.
// Se utiliza para mostrar las notificaciones en el menú de recepción.
$(document).ready(function () {
    function cargarNotificaciones() {
        $.ajax({
            url: 'acciones_MR/obtener-notificaciones.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                const contenedor = $(".dropdown-content-body ul");
                const badge = $(".badge.badge-pill.gradient-2");

                if (data.length > 0) {
                    // Actualiza el número de la campana
                    badge.text(data.length);

                    // Vacía y vuelve a llenar el listado
                    contenedor.empty();
                    data.forEach(notif => {
                        const li = `
                            <li>
                                <a href="javascript:void()">
                                    <span class="mr-3 avatar-icon bg-info-lighten-2">
                                        <i class="mdi mdi-bell-ring"></i>
                                    </span>
                                    <div class="notification-content">
                                        <h6 class="notification-heading">${notif.mensaje}</h6>
                                        <span class="notification-text">${notif.fecha}</span>
                                    </div>
                                </a>
                            </li>
                        `;
                        contenedor.append(li);
                    });

                    // Mostrar toast de alerta
                    toastr.info(data[0].mensaje, 'Nueva Reservación');
                }
            },
            error: function (err) {
                console.error("Error cargando notificaciones:", err);
            }
        });
    }

    // Llamar inmediatamente al cargar
    cargarNotificaciones();

    // Volver a cargar cada 10 segundos
    setInterval(cargarNotificaciones, 10000);
});

// Al hacer clic en el icono de campana, marcar todas las notificaciones como leídas
// Esto actualiza la base de datos y resetea el contador en la interfaz.
$(".icons.dropdown").on('click', function() {
    $.ajax({
        url: 'acciones_MR/marcar-notificaciones-leidas.php',
        method: 'POST',
        success: function() {
            $(".badge.badge-pill.gradient-2").text('0');
        }
    });
});

