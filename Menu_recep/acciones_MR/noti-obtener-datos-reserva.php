<?php
require_once("../../Conexión_BD/conexion.php");
header("Content-Type: application/json");

// ✅ Validar ID recibido
if (!isset($_GET['idhospedaje']) || empty($_GET['idhospedaje'])) {
    echo json_encode(["error" => "ID de hospedaje no proporcionado o vacío"]);
    exit;
}

$idhospedaje = intval($_GET['idhospedaje']);

// ✅ Consulta SQL con alias consistentes
$sql = "
SELECT 
    c.prim_nom_client,
    c.seg_nom_client,
    c.prim_apelli_client,
    c.seg_apelli_client,
    c.edad_client,
    c.iden_client AS identificacion,
    c.tel_client AS telefono,
    c.email_client AS correo,
    h.fecha_entra AS fecha_llegada,
    h.fecha_sal AS fecha_salida,
    h.cant_person AS cantidad_personas,
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

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $idhospedaje);

if (!$stmt->execute()) {
    echo json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]);
    exit;
}

$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["error" => "Reserva no encontrada", "idhospedaje" => $idhospedaje]);
}

$stmt->close();
$conn->close();
?>
