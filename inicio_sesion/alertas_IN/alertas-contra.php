<?php
if (isset($_GET['estado'])) {
    if ($_GET['estado'] == "ok") {
        echo "<script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Contraseña actualizada exitosamente',
                showConfirmButton: false,
                timer: 1500,
                scrollbarPadding: false,
                heightAuto: false
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>";
    } elseif ($_GET['estado'] == "no_encontrado") {
        echo "<script>
            Swal.fire({
                title: 'Usuario no encontrado',
                text: 'Verifica tu cédula, por favor.',
                icon: 'warning',
                scrollbarPadding: false,
                heightAuto: false
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>";
    } elseif ($_GET['estado'] == "error_actualizar") {
        echo "<script>
            Swal.fire({
                title: 'Error al actualizar',
                text: 'Ocurrió un problema al guardar la nueva contraseña.',
                icon: 'error',
                scrollbarPadding: false,
                heightAuto: false
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>";
    } elseif ($_GET['estado'] == "campos_vacios") {
        echo "<script>
            Swal.fire({
                title: 'Campos vacíos',
                text: 'Por favor completa todos los campos.',
                icon: 'warning',
                scrollbarPadding: false,
                heightAuto: false
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>";
    }
}
?>
