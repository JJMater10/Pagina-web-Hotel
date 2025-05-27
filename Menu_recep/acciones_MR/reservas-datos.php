<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../Conexión_BD/conexion.php');

$sql = "
    SELECT 
        c.prim_nom_client AS nombre,
        c.iden_client AS identificacion,
        c.tel_client AS telefono,
        h.fecha_entra,
        h.fecha_sal,
        h.habitacion_idhabitacion AS idhabitacion,
        hab.nom_hab AS habitacion
    FROM hospedaje h
    INNER JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
    INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    INNER JOIN habitacion hab ON h.habitacion_idhabitacion = hab.idhabitacion
    ORDER BY h.fecha_entra DESC
";


$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
