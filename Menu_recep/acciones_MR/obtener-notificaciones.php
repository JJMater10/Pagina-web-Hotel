<?php
// En este archivo se obtiene las últimas 10 notificaciones de la base de datos y se devuelven en formato JSON.
// Se utiliza para mostrar las notificaciones en el menú de recepción. 
include('../../Conexión_BD/conexion.php');

$sql = "SELECT 
            id, 
            mensaje, 
            leida,
            DATE_FORMAT(fecha, '%Y-%m-%d %H:%i:%s') as fecha
        FROM notificaciones
        ORDER BY fecha DESC
        LIMIT 10";

$res = $conn->query($sql);

$notificaciones = [];
while ($row = $res->fetch_assoc()) {
    $notificaciones[] = $row;
}

header('Content-Type: application/json');
echo json_encode($notificaciones, JSON_UNESCAPED_UNICODE);
$conn->close();
?>




