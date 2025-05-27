<?php
include('../../Conexión_BD/conexion.php');

$ident = $_POST['identificacion'] ?? null;

if (!$ident) {
    echo "Identificación no proporcionada";
    exit;
}

// 1. Obtener el hospedaje asociado a ese cliente
$sql = "SELECT h.idhospedaje, h.habitacion_idhabitacion, h.medio_pag_idmedio_pag, c.idcliente
        FROM hospedaje h
        INNER JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
        INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
        WHERE c.iden_client = ?
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ident);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "Reservación no encontrada";
    exit;
}

// 2. Eliminar la relación en hospedaje_has_cliente
$sqlDel1 = "DELETE FROM hospedaje_has_cliente 
            WHERE hospedaje_idhospedaje = ? 
              AND hospedaje_habitacion_idhabitacion = ? 
              AND hospedaje_medio_pag_idmedio_pag = ? 
              AND cliente_idcliente = ?";

$stmt1 = $conn->prepare($sqlDel1);
$stmt1->bind_param("iiii", $data['idhospedaje'], $data['habitacion_idhabitacion'], $data['medio_pag_idmedio_pag'], $data['idcliente']);
$stmt1->execute();
$stmt1->close();

// 3. Eliminar de hospedaje
$sqlDel2 = "DELETE FROM hospedaje 
            WHERE idhospedaje = ? 
              AND habitacion_idhabitacion = ? 
              AND medio_pag_idmedio_pag = ?";

$stmt2 = $conn->prepare($sqlDel2);
$stmt2->bind_param("iii", $data['idhospedaje'], $data['habitacion_idhabitacion'], $data['medio_pag_idmedio_pag']);
$stmt2->execute();
$stmt2->close();

echo "ok";
$conn->close();
?>
