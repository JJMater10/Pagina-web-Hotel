<?php
include('../Conexión_BD/conexion.php');
$conn->query("UPDATE notificaciones SET leida = 1");
$conn->close();
?>
