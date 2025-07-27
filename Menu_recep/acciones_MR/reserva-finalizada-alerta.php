<?php
require_once('../../Conexión_BD/conexion.php');
header('Content-Type: application/json');

if (!isset($_POST['idhospedaje'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID de hospedaje no proporcionado.']);
    exit;
}

$idhospedaje = intval($_POST['idhospedaje']);

$sql = "UPDATE hospedaje SET estado = 'Finalizado' WHERE idhospedaje = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idhospedaje);

if ($stmt->execute()) {
    echo json_encode(['status' => 'ok', 'message' => 'Reserva finalizada correctamente.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar la reserva.']);
}

$conn->close();
?>
