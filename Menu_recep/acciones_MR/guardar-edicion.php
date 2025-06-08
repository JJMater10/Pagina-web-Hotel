<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../Conexión_BD/conexion.php');

$ident = $_POST['identificacion'];
$tel = $_POST['telefono'];
$entrada = $_POST['fecha_entra'];
$salida = $_POST['fecha_sal'];
$idhab = $_POST['habitacion'];
$estado = $_POST['estado'];

// Paso 1: Obtener hospedaje específico (último registro del cliente)
$sqlHospedaje = "
    SELECT h.idhospedaje, h.medio_pag_idmedio_pag 
    FROM hospedaje h
    INNER JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
    INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    WHERE c.iden_client = ?
    ORDER BY h.idhospedaje DESC
    LIMIT 1
";
$stmtHosp = $conn->prepare($sqlHospedaje);
$stmtHosp->bind_param("s", $ident);
$stmtHosp->execute();
$resultHosp = $stmtHosp->get_result();
$hosp = $resultHosp->fetch_assoc();
$stmtHosp->close();

if (!$hosp) {
    echo "error: no se encontró el hospedaje del cliente.";
    $conn->close();
    exit;
}

$idhospedaje = $hosp['idhospedaje'];
$medio_pago = $hosp['medio_pag_idmedio_pag'];

// ✅ Actualizar hospedaje y cliente
$sqlUpdate = "
    UPDATE hospedaje h
    JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
    JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    SET 
        h.fecha_entra = ?, 
        h.fecha_sal = ?, 
        h.habitacion_idhabitacion = ?, 
        h.estado_hab_idestado_hab = ?,
        c.tel_client = ?
    WHERE h.idhospedaje = ?
      AND h.medio_pag_idmedio_pag = ?
";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("ssiiiii", $entrada, $salida, $idhab, $estado, $tel, $idhospedaje, $medio_pago);

if (!$stmtUpdate->execute()) {
    echo "error al actualizar: " . $stmtUpdate->error;
    $stmtUpdate->close();
    $conn->close();
    exit;
}

$stmtUpdate->close();
echo "ok";
$conn->close();
?>
