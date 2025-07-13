<?php
session_start();
include '../Conexión_BD/conexion.php';

header('Content-Type: application/json'); // Indicamos que se devuelve JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function limpiarDato($dato) {
        return htmlspecialchars(strip_tags(trim($dato)));
    }

    $prim_nom_client = limpiarDato($_POST['prim_nom_client']);
    $seg_nom_client = limpiarDato($_POST['seg_nom_client']);
    $prim_apelli_client = limpiarDato($_POST['prim_apelli_client']);
    $seg_apelli_client = limpiarDato($_POST['seg_apelli_client']);
    $edad_client = filter_var($_POST['edad_client'], FILTER_VALIDATE_INT);
    $iden_client = limpiarDato($_POST['iden_client']);
    $tel_client = limpiarDato($_POST['tel_client']);
    $email_client = filter_var($_POST['email_client'], FILTER_VALIDATE_EMAIL);

    $fecha_entrada = limpiarDato($_POST['fecha_entrada']);
    $fecha_salida = limpiarDato($_POST['fecha_salida']);
    $cant_person = filter_var($_POST['cant_person'], FILTER_VALIDATE_INT);
    $habitacion_id = filter_var($_POST['habitacion_id'], FILTER_VALIDATE_INT);
    $medio_pago = filter_var($_POST['medio_pago'], FILTER_VALIDATE_INT);

    if (!$prim_nom_client || !$prim_apelli_client || !$edad_client || !$iden_client || !$tel_client || !$email_client ||
        !$fecha_entrada || !$fecha_salida || !$cant_person || !$habitacion_id || !$medio_pago) {
        echo json_encode([
            "status" => "error",
            "message" => "Todos los campos obligatorios deben estar completos."
        ]);
        exit();
    }

    // Verificar disponibilidad
    $sql_disponibilidad = "SELECT hab_dispo FROM habitacion WHERE idhabitacion = ?";
    $stmt = $conn->prepare($sql_disponibilidad);
    $stmt->bind_param("i", $habitacion_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();
    $stmt->close();

    if (!$fila || $fila['hab_dispo'] <= 0) {
        echo json_encode([
            "status" => "error",
            "message" => "No hay disponibilidad para la habitación seleccionada."
        ]);
        exit();
    }

    // Insertar cliente
    $sql_cliente = "INSERT INTO cliente 
        (prim_nom_client, seg_nom_client, prim_apelli_client, seg_apelli_client, edad_client, iden_client, tel_client, email_client) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_cliente);
    $stmt->bind_param("ssssiiss", $prim_nom_client, $seg_nom_client, $prim_apelli_client, $seg_apelli_client, 
                                 $edad_client, $iden_client, $tel_client, $email_client);

    if (!$stmt->execute()) {
        echo json_encode([
            "status" => "error",
            "message" => "Error al insertar cliente: " . $stmt->error
        ]);
        exit();
    }
    $id_cliente = $stmt->insert_id;
    $stmt->close();

    // Insertar hospedaje
    $sql_hospedaje = "INSERT INTO hospedaje 
        (fecha_entra, fecha_sal, cant_person, habitacion_idhabitacion, medio_pag_idmedio_pag) 
        VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_hospedaje);
    $stmt->bind_param("ssiii", $fecha_entrada, $fecha_salida, $cant_person, $habitacion_id, $medio_pago);

    if (!$stmt->execute()) {
        echo json_encode([
            "status" => "error",
            "message" => "Error al insertar hospedaje: " . $stmt->error
        ]);
        exit();
    }
    $id_hospedaje = $stmt->insert_id;
    $stmt->close();

    // Insertar relación
    $sql_relacion = "INSERT INTO hospedaje_has_cliente 
        (hospedaje_idhospedaje, cliente_idcliente, hospedaje_habitacion_idhabitacion, hospedaje_medio_pag_idmedio_pag) 
        VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_relacion);
    $stmt->bind_param("iiii", $id_hospedaje, $id_cliente, $habitacion_id, $medio_pago);
    $stmt->execute();
    $stmt->close();

    // Insertar notificación
    $mensaje = "Nueva reserva realizada por: $prim_nom_client $prim_apelli_client";
    $conn->query("INSERT INTO notificaciones (mensaje) VALUES ('$mensaje')");

    // Descontar disponibilidad
    $sql_update = "UPDATE habitacion SET hab_dispo = hab_dispo - 1 WHERE idhabitacion = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("i", $habitacion_id);
    $stmt->execute();
    $stmt->close();

    // Consultar cuántas habitaciones quedan disponibles en total
    $sql_total = "SELECT COUNT(*) as total FROM habitacion WHERE hab_dispo > 0";
    $res = $conn->query($sql_total);
    $row = $res->fetch_assoc();
    $totalDisponibles = $row['total'];

    $conn->close();

    echo json_encode([
        "status" => "ok",
        "habitaciones_disponibles" => $totalDisponibles
    ]);
    exit();
}
?>
