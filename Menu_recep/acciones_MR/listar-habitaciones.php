<?php
// Mostrar errores si los hay
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a BD
include('../../Conexión_BD/conexion.php');

// Consulta para obtener habitaciones
$sql = "SELECT idhabitacion, nom_hab FROM habitacion";
$result = $conn->query($sql);

// Almacena habitaciones en array
$habitaciones = [];
while ($row = $result->fetch_assoc()) {
    $habitaciones[] = $row;
}

// Devuelve datos como JSON
echo json_encode($habitaciones);

// Cierra conexión
$conn->close();
?>
