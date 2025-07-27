<?php
require_once("../../Conexión_BD/conexion.php");
header("Content-Type: application/json");

if (!isset($_GET['idhospedaje'])) {
    echo json_encode(["error" => "ID de hospedaje no proporcionado"]);
    exit;
}

$idhospedaje = intval($_GET['idhospedaje']);

$sql = "
SELECT 
    c.prim_nom_client,
    c.seg_nom_client,
    c.prim_apelli_client,
    c.seg_apelli_client,
    c.edad_client,
    c.identificacion,
    c.telefono_client,
    c.correo_client,
    h.fecha_lleg,
    h.fecha_sal,
    h.cantidad_personas,
    h.habitacion_idhabitacion,
    h.estado_hab_idestado_hab
FROM hospedaje h
JOIN hospedaje_has_cliente hc 
    ON h.idhospedaje = hc.hospedaje_idhospedaje
    AND h.habitacion_idhabitacion = hc.hospedaje_habitacion_idhabitacion
    AND h.medio_pag_idmedio_pag = hc.hospedaje_medio_pag_idmedio_pag
JOIN cliente c ON hc.cliente_idcliente = c.idcliente
WHERE h.idhospedaje = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idhospedaje);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["error" => "Reserva no encontrada"]);
}

$stmt->close();
$conn->close();
?>
