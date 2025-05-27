<?php
// ✅ Mostrar alerta de éxito si la contraseña fue actualizada correctamente desde page-lock.php
if (isset($_GET['estado']) && $_GET['estado'] == "ok") {
    echo "<script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Contraseña actualizada correctamente',
            showConfirmButton: false,
            timer: 1500,
            scrollbarPadding: false,
            heightAuto: false
        }).then(() => {
            window.history.replaceState(null, null, window.location.pathname);
        });
    </script>";
}

// ⚠️ Mostrar alertas por errores de login
if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) {
        echo "<script>
            Swal.fire({
                title: 'Contraseña incorrecta',
                text: 'Por favor, verifica tu clave e intenta nuevamente.',
                icon: 'error',
                scrollbarPadding: false,
                heightAuto: false
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>";
    } elseif ($_GET['error'] == 2) {
        echo "<script>
            Swal.fire({
                title: 'Usuario no encontrado',
                text: '¿Si eres miembro de este equipo?',
                icon: 'question',
                scrollbarPadding: false,
                heightAuto: false
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>";
    } elseif ($_GET['error'] == 3) {
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
