<?php
// Mostrar errores si los hay
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a BD
include('../../Conexión_BD/conexion.php');

// Verificar si se pasa el id de la habitación actual (para edición)
$idActual = isset($_GET['idactual']) ? intval($_GET['idactual']) : 0;

// Consulta con filtro
$sql = "
    SELECT idhabitacion, nom_hab, hab_dispo 
    FROM habitacion
    WHERE hab_dispo > 0
";

if ($idActual > 0) {
    // Si viene el idactual, se agrega para incluir la habitación actual aunque tenga 0 disponibles
    $sql .= " OR idhabitacion = $idActual";
}

$result = $conn->query($sql);

// Almacena habitaciones en array
$habitaciones = [];
while ($row = $result->fetch_assoc()) {
    $habitaciones[] = $row;
}

// Devuelve datos como JSON
echo json_encode($habitaciones, JSON_UNESCAPED_UNICODE);

// Cierra conexión
$conn->close();
?>
