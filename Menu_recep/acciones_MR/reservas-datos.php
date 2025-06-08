<?php
include('../../Conexión_BD/conexion.php');

$sql = "SELECT 
            c.prim_nom_client AS nombre,
            c.iden_client AS identificacion,
            c.tel_client AS telefono,
            h.fecha_entra,
            h.fecha_sal,
            ha.nom_hab AS habitacion,
            eh.tipo_estado AS estado,
            eh.idestado_hab AS idestado, -- ← IMPORTANTE: incluir idestado
            ha.idhabitacion
        FROM hospedaje h
        INNER JOIN hospedaje_has_cliente hc ON 
            h.idhospedaje = hc.hospedaje_idhospedaje 
            AND h.habitacion_idhabitacion = hc.hospedaje_habitacion_idhabitacion
            AND h.medio_pag_idmedio_pag = hc.hospedaje_medio_pag_idmedio_pag
        INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
        INNER JOIN habitacion ha ON h.habitacion_idhabitacion = ha.idhabitacion
        LEFT JOIN estado_hab eh ON h.estado_hab_idestado_hab = eh.idestado_hab
        ORDER BY h.idhospedaje DESC";

$result = $conn->query($sql);

$reservas = [];
while ($row = $result->fetch_assoc()) {
    $reservas[] = $row;
}

echo json_encode($reservas, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
