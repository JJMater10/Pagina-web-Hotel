function cargarResumenHabitaciones() {
    $.ajax({
        url: 'acciones_MR/habitaciones-dashboard.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#total-habitaciones').text(data.total);

            const contenedor = $('#habitaciones-tipo');
            contenedor.empty();

            // Asignar colores fijos por tipo
            const colores = {
                'Habitación Estándar': 'bg-primary',
                'Suit Junior': 'bg-success',
                'Suit Presidencial': 'bg-warning'
            };

            data.habitaciones.forEach(hab => {
                const nombre = hab.nombre;
                const disponibles = hab.disponibles;
                const porcentaje = hab.porcentaje.toFixed(0);
                const claseColor = colores[nombre] || 'bg-secondary'; // fallback

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
            console.error('Error al cargar resumen de habitaciones:', err);
        }
    });
}

// ⚠️ Llama esta función al cargar el dashboard inicialmente
cargarResumenHabitaciones();
