// En este documento se valida que la fecha de entrada no sea anterior a la fecha actual
// y que la fecha de salida no sea anterior a la fecha de entrada.
// También se utiliza SweetAlert2 para mostrar mensajes de error.

document.addEventListener('DOMContentLoaded', function() {
    const fechaEntrada = document.getElementById('fecha_entrada');
    const fechaSalida = document.getElementById('fecha_salida');

    // Fecha mínima hoy
    const today = new Date().toISOString().split('T')[0];
    fechaEntrada.setAttribute('min', today);

    // Cuando cambie la fecha de entrada
    fechaEntrada.addEventListener('change', function() {
        if (fechaEntrada.value) {
            fechaSalida.setAttribute('min', fechaEntrada.value);
        } else {
            fechaSalida.removeAttribute('min');
        }
    });

    // Validar al enviar el formulario
    const formulario = document.querySelector('form');
    formulario.addEventListener('submit', function(e) {
        if (fechaEntrada.value && fechaSalida.value) {
            if (fechaSalida.value < fechaEntrada.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fechas inválidas',
                    text: 'La fecha de salida no puede ser anterior a la fecha de llegada.',
                    confirmButtonText: 'Aceptar'
                });
                return; // Evitar seguir
            }
        }
        if (fechaEntrada.value) {
            const fechaHoy = new Date(today);
            const fechaSeleccionada = new Date(fechaEntrada.value);
            if (fechaSeleccionada < fechaHoy) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha inválida',
                    text: 'La fecha de llegada no puede ser anterior al día de hoy.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
        }
    });
});
