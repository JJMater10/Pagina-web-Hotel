<!-- En este archivo se obtiene las notificaciones no leídas de la base de datos y se devuelven en formato JSON.
Se utiliza para mostrar las notificaciones en el menú de recepción. -->
<?php
include('../Conexión_BD/conexion.php');

$sql = "SELECT id, mensaje, fecha FROM notificaciones WHERE leida = 0 ORDER BY fecha DESC LIMIT 5";
$res = $conn->query($sql);

$notificaciones = [];
while ($row = $res->fetch_assoc()) {
    $notificaciones[] = $row;
}

echo json_encode($notificaciones, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
