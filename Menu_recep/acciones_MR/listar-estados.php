<?php
include('../../Conexión_BD/conexion.php');

$sql = "SELECT idestado_hab, tipo_estado FROM estado_hab";
$result = $conn->query($sql);

$estados = [];
while ($row = $result->fetch_assoc()) {
    $estados[] = $row;
}

echo json_encode($estados, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
