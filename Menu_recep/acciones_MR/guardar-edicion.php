<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../Conexión_BD/conexion.php');

$ident = $_POST['identificacion'];
$tel = $_POST['telefono'];
$entrada = $_POST['fecha_entra'];
$salida = $_POST['fecha_sal'];
$idhab = $_POST['habitacion'];

// Paso 1: Obtener hospedaje relacionado
$sqlHospedaje = "
    SELECT h.idhospedaje, h.medio_pag_idmedio_pag 
    FROM hospedaje h
    INNER JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
    INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    WHERE c.iden_client = ?
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

// ✅ PRIMERO: actualizamos hospedaje (el padre)
$sqlUpdateHospedaje = "
    UPDATE hospedaje h
    INNER JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
    INNER JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    SET 
        h.fecha_entra = ?, 
        h.fecha_sal = ?, 
        h.habitacion_idhabitacion = ?, 
        c.tel_client = ?
    WHERE c.iden_client = ?
";

$stmtUpdate = $conn->prepare($sqlUpdateHospedaje);
$stmtUpdate->bind_param("ssisi", $entrada, $salida, $idhab, $tel, $ident);

if (!$stmtUpdate->execute()) {
    echo "error al actualizar hospedaje/cliente: " . $stmtUpdate->error;
    $stmtUpdate->close();
    $conn->close();
    exit;
}
$stmtUpdate->close();

// ✅ LUEGO: actualizamos hospedaje_has_cliente (el hijo)
$sqlRelacion = "
    UPDATE hospedaje_has_cliente
    SET hospedaje_habitacion_idhabitacion = ?
    WHERE hospedaje_idhospedaje = ? 
      AND hospedaje_medio_pag_idmedio_pag = ?
";
$stmtRelacion = $conn->prepare($sqlRelacion);
$stmtRelacion->bind_param("iii", $idhab, $idhospedaje, $medio_pago);

if (!$stmtRelacion->execute()) {
    echo "error al actualizar relación: " . $stmtRelacion->error;
} else {
    echo "ok";
}

$stmtRelacion->close();
$conn->close();
?>
