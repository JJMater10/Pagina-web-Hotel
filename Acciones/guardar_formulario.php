<?php
session_start();
include '../Conexión_BD/conexion.php';

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
        die("Error: Todos los campos obligatorios deben estar completos.");
    }

    // ✅ Verificar disponibilidad de la habitación
    $sql_disponibilidad = "SELECT hab_dispo FROM habitacion WHERE idhabitacion = ?";
    $stmt = $conn->prepare($sql_disponibilidad);
    $stmt->bind_param("i", $habitacion_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    if (!$fila || $fila['hab_dispo'] <= 0) {
        // No hay habitaciones disponibles
        $stmt->close();
        $conn->close();
        echo "<script>
            alert('No hay disponibilidad para la habitación seleccionada.');
            window.location.href = '../reservacion.php';
        </script>";
        exit();
    }
    $stmt->close();

    // ✅ Insertar cliente
    $sql_cliente = "INSERT INTO cliente (prim_nom_client, seg_nom_client, prim_apelli_client, seg_apelli_client, edad_client, iden_client, tel_client, email_client) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_cliente);
    $stmt->bind_param("ssssiiss", $prim_nom_client, $seg_nom_client, $prim_apelli_client, $seg_apelli_client, 
                                 $edad_client, $iden_client, $tel_client, $email_client);
    
    if ($stmt->execute()) {
        $id_cliente = $stmt->insert_id;
    } else {
        die("Error al insertar cliente: " . $stmt->error);
    }
    $stmt->close();

    // ✅ Insertar hospedaje
    $sql_hospedaje = "INSERT INTO hospedaje (fecha_entra, fecha_sal, cant_person, habitacion_idhabitacion, medio_pag_idmedio_pag) 
                      VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_hospedaje);
    $stmt->bind_param("ssiii", $fecha_entrada, $fecha_salida, $cant_person, $habitacion_id, $medio_pago);
    
    if ($stmt->execute()) {
        $id_hospedaje = $stmt->insert_id;
    } else {
        die("Error al insertar hospedaje: " . $stmt->error);
    }
    $stmt->close();

    // ✅ Insertar relación hospedaje-cliente
    $sql_relacion = "INSERT INTO hospedaje_has_cliente (hospedaje_idhospedaje, cliente_idcliente, hospedaje_habitacion_idhabitacion, hospedaje_medio_pag_idmedio_pag) 
                     VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_relacion);
    $stmt->bind_param("iiii", $id_hospedaje, $id_cliente, $habitacion_id, $medio_pago);
    
    if ($stmt->execute()) {
        $_SESSION['reserva_exitosa'] = true;  // Mostrar alerta en la siguiente página
    }
    $stmt->close();

    // ✅ Insertar notificación
$mensaje = "Nueva reserva realizada por: $prim_nom_client";
$conn->query("INSERT INTO notificaciones (mensaje) VALUES ('$mensaje')");

    // ✅ Descontar 1 unidad de habitación disponible
    $sql_update = "UPDATE habitacion SET hab_dispo = hab_dispo - 1 WHERE idhabitacion = ? AND hab_dispo > 0";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("i", $habitacion_id);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    // Redirigir al formulario
    header("Location: ../reservacion.php");
    exit();
}
?>
