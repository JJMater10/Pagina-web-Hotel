<?php
include('../../Conexión_BD/conexion.php');
// este codigo muestra las reservas finalizadas y se visualizan en la pagina de historial de reservas
$sql = "
    SELECT 
        c.prim_nom_client,
        c.seg_nom_client,
        c.prim_apelli_client,
        c.seg_apelli_client,
        c.edad_client,
        c.iden_client,
        c.tel_client,
        c.email_client,
        h.fecha_entra,
        h.fecha_sal,
        h.cant_person,
        hab.nom_hab AS habitacion,
        mp.tipo_pag AS medio_pago,
        eh.tipo_estado
    FROM hospedaje h
    INNER JOIN hospedaje_has_cliente hc 
        ON h.idhospedaje = hc.hospedaje_idhospedaje 
        AND h.habitacion_idhabitacion = hc.hospedaje_habitacion_idhabitacion 
        AND h.medio_pag_idmedio_pag = hc.hospedaje_medio_pag_idmedio_pag
    INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    INNER JOIN habitacion hab ON h.habitacion_idhabitacion = hab.idhabitacion
    INNER JOIN medio_pag mp ON h.medio_pag_idmedio_pag = mp.idmedio_pag
    INNER JOIN estado_hab eh ON h.estado_hab_idestado_hab = eh.idestado_hab
    WHERE eh.tipo_estado = 'Finalizado'
    ORDER BY h.fecha_entra DESC
";

$result = $conn->query($sql);

$reservas = [];
while ($row = $result->fetch_assoc()) {
    $reservas[] = $row;
}

echo json_encode($reservas, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
