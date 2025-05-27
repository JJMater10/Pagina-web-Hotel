<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ruta corregida al archivo de conexión
include('../../Conexión_BD/conexion.php');

// TOTAL RECAUDADO
$sqlRecaudo = "
    SELECT SUM(h.precio_hab) AS total_recaudado
    FROM hospedaje hos
    INNER JOIN habitacion h ON hos.habitacion_idhabitacion = h.idhabitacion
";
$resultRecaudo = $conn->query($sqlRecaudo);
$recaudado = $resultRecaudo->fetch_assoc()['total_recaudado'] ?? 0;

// TOTAL RESERVAS
$sqlReservas = "SELECT COUNT(*) AS total_reservas FROM hospedaje";
$resultReservas = $conn->query($sqlReservas);
$totalReservas = $resultReservas->fetch_assoc()['total_reservas'] ?? 0;

echo json_encode([
    'recaudado' => $recaudado,
    'reservas' => $totalReservas
]);

$conn->close();
?>
