<?php
session_start();
require_once __DIR__ . '/../Conexión_BD/conexion.php'; // Asegúrate de la ruta correcta

// Verificar si hay una reserva exitosa
$reservaExitosa = false;
if (isset($_SESSION['reserva_exitosa']) && $_SESSION['reserva_exitosa']) {
    $reservaExitosa = true;
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Reserva Exitosa!',
            text: 'Su reservación ha sido registrada con éxito.',
            icon: 'success'
        });
    });
    </script>";
    unset($_SESSION['reserva_exitosa']);
}

// Obtener habitaciones disponibles
$sql_habitaciones = "SELECT idhabitacion, nom_hab FROM habitacion WHERE hab_dispo > 0";
$result_habitaciones = $conn->query($sql_habitaciones);
$hayHabitaciones = ($result_habitaciones->num_rows > 0);

// Obtener medios de pago
$sql_medios_pago = "SELECT idmedio_pag, tipo_pag FROM medio_pag";
$result_medios_pago = $conn->query($sql_medios_pago);

// Si NO hay habitaciones y NO acabas de reservar, mostrar alerta y redirigir
if (!$hayHabitaciones && !$reservaExitosa) {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'warning',
            title: 'Sin disponibilidad',
            text: 'No hay habitaciones disponibles en este momento. Por favor, intente más tarde.',
            confirmButtonText: 'Cerrar'
        }).then(() => {
            window.location.href = 'index.html'; // Cambia si quieres otra ruta
        });
    });
    </script>";
}
?>
