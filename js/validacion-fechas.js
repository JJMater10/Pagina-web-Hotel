// En este documento se valida que la fecha de entrada no sea anterior a la fecha actual
// y que la fecha de salida no sea anterior a la fecha de entrada.
// También se utiliza SweetAlert2 para mostrar mensajes de error.

document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];

    // ✅ FORMULARIO PRINCIPAL (reservacion.php)
    const fechaEntrada = document.getElementById('fecha_entrada');
    const fechaSalida = document.getElementById('fecha_salida');

    if (fechaEntrada && fechaSalida) {
        fechaEntrada.setAttribute('min', today);

        fechaEntrada.addEventListener('change', function () {
            fechaSalida.setAttribute('min', fechaEntrada.value || today);
        });

        const formulario = document.querySelector('form');
        formulario?.addEventListener('submit', function (e) {
            if (fechaEntrada.value && fechaSalida.value && fechaSalida.value < fechaEntrada.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fechas inválidas',
                    text: 'La fecha de salida no puede ser anterior a la llegada.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            if (fechaEntrada.value < today) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha inválida',
                    text: 'La fecha de llegada no puede ser anterior a hoy.',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }

    // ✅ CAMPOS DEL MODAL (index.php)
    const modalEntrada = document.getElementById('edit-fecha-entrada');
    const modalSalida = document.getElementById('edit-fecha-salida');

    if (modalEntrada && modalSalida) {
        modalEntrada.setAttribute('min', today);

        // Función para ajustar mínimo de salida
        const actualizarMinSalida = () => {
            const fechaEntradaModal = modalEntrada.value || today;
            const minSalida = fechaEntradaModal > today ? fechaEntradaModal : today;
            modalSalida.setAttribute('min', minSalida);

            // 🔹 Si la fecha actual en el campo es menor que el mínimo, la reemplazamos
            if (!modalSalida.value || modalSalida.value < minSalida) {
                modalSalida.value = minSalida;
            }
        };

        // Reajusta el mínimo después de que se carguen datos por AJAX
        const observer = new MutationObserver(() => {
            actualizarMinSalida();
        });
        observer.observe(modalSalida, { attributes: true, attributeFilter: ['value'] });

        modalEntrada.addEventListener('change', actualizarMinSalida);

        // Validación al guardar
        const guardarBtn = document.getElementById('guardarCambios');
        guardarBtn?.addEventListener('click', function (e) {
            const entrada = modalEntrada.value;
            const salida = modalSalida.value;

            if (entrada && salida && salida < entrada) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fechas inválidas',
                    text: 'La fecha de salida no puede ser anterior a la de llegada.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            if (entrada < today) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha inválida',
                    text: 'La fecha de llegada no puede ser anterior a hoy.',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }
});
