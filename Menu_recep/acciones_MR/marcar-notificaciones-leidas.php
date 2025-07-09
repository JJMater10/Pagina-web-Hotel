<?php
// es archivo que se encarga de marcar todas las notificaciones como leídas en la base de datos.
// Se utiliza cuando el usuario hace clic en el botón de "Marcar todas como leídas en el menú de recepción. 
include('../../Conexión_BD/conexion.php');
$conn->query("UPDATE notificaciones SET leida = 1");
$conn->close();
?>
