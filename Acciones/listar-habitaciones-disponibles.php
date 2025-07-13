<?php
include '../Conexión_BD/conexion.php';
header('Content-Type: application/json');

$sql = "SELECT idhabitacion, nom_hab FROM habitacion WHERE hab_dispo > 0";
$result = $conn->query($sql);

$habitaciones = [];
while ($row = $result->fetch_assoc()) {
    $habitaciones[] = $row;
}

echo json_encode($habitaciones);
$conn->close();
?>
