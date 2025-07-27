<?php
require_once("../../Conexión_BD/conexion.php");
header('Content-Type: application/json');

date_default_timezone_set('America/Bogota');
$hoy = date('Y-m-d');

$query = "
    SELECT 
        h.idhospedaje,
        h.habitacion_idhabitacion,
        h.medio_pag_idmedio_pag,
        CONCAT(c.prim_nom_client, ' ', c.prim_apelli_client) AS nombre,
        h.fecha_sal
    FROM hospedaje h
    JOIN hospedaje_has_cliente hc 
        ON h.idhospedaje = hc.hospedaje_idhospedaje
        AND h.habitacion_idhabitacion = hc.hospedaje_habitacion_idhabitacion
        AND h.medio_pag_idmedio_pag = hc.hospedaje_medio_pag_idmedio_pag
    JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    WHERE h.fecha_sal < ? 
      AND h.estado_hab_idestado_hab != 3
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $hoy);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $reservas = [];

    while ($row = $result->fetch_assoc()) {
        $reservas[] = [
            "idhospedaje" => $row["idhospedaje"],
            "habitacion_id" => $row["habitacion_idhabitacion"],
            "medio_pago_id" => $row["medio_pag_idmedio_pag"],
            "nombre" => $row["nombre"],
            "fecha_salida" => $row["fecha_sal"]
        ];
    }

    echo json_encode($reservas, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]);
}

$conn->close();
?>
