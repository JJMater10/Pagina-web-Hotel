<?php
include('../../Conexión_BD/conexion.php');

// Total habitaciones (suma de hab_dispo)
$sqlTotal = "SELECT SUM(hab_dispo) AS total FROM habitacion";
$resTotal = $conn->query($sqlTotal);
$total = $resTotal->fetch_assoc()['total'];

// Habitaciones por tipo
$sqlTipos = "SELECT nom_hab, hab_dispo FROM habitacion";
$resTipos = $conn->query($sqlTipos);

$habitaciones = [];

while ($row = $resTipos->fetch_assoc()) {
    $nombre = $row['nom_hab'];
    $disponibles = $row['hab_dispo'];
    $max = 10; // si todas tienen 10 habitaciones
    $ocupadas = $max - $disponibles;
    $porcentaje = ($ocupadas / $max) * 100;

    $habitaciones[] = [
        'nombre' => $nombre,
        'disponibles' => $disponibles,
        'porcentaje' => $porcentaje
    ];
}

echo json_encode([
    'total' => $total,
    'habitaciones' => $habitaciones
]);

$conn->close();
?>
