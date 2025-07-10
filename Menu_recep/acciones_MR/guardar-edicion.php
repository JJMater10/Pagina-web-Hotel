<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../Conexión_BD/conexion.php');

// Capturar datos del formulario
$ident = $_POST['identificacion'];
$prim_nom = $_POST['prim_nom'];
$seg_nom = $_POST['seg_nom'];
$prim_ape = $_POST['prim_ape'];
$seg_ape = $_POST['seg_ape'];
$edad = $_POST['edad'];
$tel = $_POST['telefono'];
$correo = $_POST['correo'];
$cantidad = $_POST['cantidad'];
$entrada = $_POST['fecha_entra'];
$salida = $_POST['fecha_sal'];
$idhab_nueva = $_POST['habitacion'];
$estado_nuevo = $_POST['estado'];

// Paso 1: Obtener hospedaje actual, estado y habitación anterior
$sqlHospedaje = "
    SELECT h.idhospedaje, h.medio_pag_idmedio_pag, h.estado_hab_idestado_hab,
           h.habitacion_idhabitacion, c.idcliente
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

$idhospedaje     = $hosp['idhospedaje'];
$medio_pago      = $hosp['medio_pag_idmedio_pag'];
$estado_anterior = $hosp['estado_hab_idestado_hab'];
$idhab_anterior  = $hosp['habitacion_idhabitacion'];

/* 🚦 1. CAMBIO DE ESTADO */
if ($estado_anterior != $estado_nuevo) {
    // Finalizado ➡️ En uso → restar disponibilidad
    if ($estado_anterior == 3 && $estado_nuevo != 3) {
        $conn->query("UPDATE habitacion SET hab_dispo = hab_dispo - 1 WHERE idhabitacion = $idhab_anterior");
    }

    // En uso ➡️ Finalizado → sumar disponibilidad
    if ($estado_anterior != 3 && $estado_nuevo == 3) {
        $conn->query("UPDATE habitacion SET hab_dispo = hab_dispo + 1 WHERE idhabitacion = $idhab_anterior");
    }
}

/* 🛏️ 2. CAMBIO DE HABITACIÓN (mientras no sea Finalizado) */
if ($idhab_anterior != $idhab_nueva && $estado_nuevo != 3) {
    // Liberar anterior
    $conn->query("UPDATE habitacion SET hab_dispo = hab_dispo + 1 WHERE idhabitacion = $idhab_anterior");

    // Ocupar nueva
    $conn->query("UPDATE habitacion SET hab_dispo = hab_dispo - 1 WHERE idhabitacion = $idhab_nueva");
}

/* ✅ 3. ACTUALIZAR DATOS */
$sqlUpdate = "
    UPDATE hospedaje h
    JOIN hospedaje_has_cliente hc ON h.idhospedaje = hc.hospedaje_idhospedaje
    JOIN cliente c ON hc.cliente_idcliente = c.idcliente
    SET 
        h.fecha_entra = ?, 
        h.fecha_sal = ?, 
        h.habitacion_idhabitacion = ?, 
        h.estado_hab_idestado_hab = ?,
        h.cant_person = ?,
        c.prim_nom_client = ?,
        c.seg_nom_client = ?,
        c.prim_apelli_client = ?,
        c.seg_apelli_client = ?,
        c.edad_client = ?,
        c.tel_client = ?,
        c.email_client = ?
    WHERE h.idhospedaje = ?
      AND h.medio_pag_idmedio_pag = ?
";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param(
    "ssiiissssissii",
    $entrada,
    $salida,
    $idhab_nueva,
    $estado_nuevo,
    $cantidad,
    $prim_nom,
    $seg_nom,
    $prim_ape,
    $seg_ape,
    $edad,
    $tel,
    $correo,
    $idhospedaje,
    $medio_pago
);

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
