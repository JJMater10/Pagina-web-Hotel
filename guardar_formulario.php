<?php
include 'Conexión BD\conexion.php'; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del cliente
    $prim_nom_client = $_POST['prim_nom_client'];
    $seg_nom_client = $_POST['seg_nom_client'];
    $prim_apelli_client = $_POST['prim_apelli_client'];
    $seg_apelli_client = $_POST['seg_apelli_client'];
    $edad_client = $_POST['edad_client'];
    $iden_client = $_POST['iden_client'];
    $tel_client = $_POST['tel_client'];
    $email_client = $_POST['email_client'];

    // Datos del hospedaje
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $cant_person = $_POST['cant_person'];
    $habitacion_id = $_POST['habitacion_id'];
    $medio_pago = $_POST['medio_pago'];

    // 1️⃣ Insertar en la tabla CLIENTE
    $sql_cliente = "INSERT INTO cliente (prim_nom_client, seg_nom_client, prim_apelli_client, seg_apelli_client, edad_client, iden_client, tel_client, email_client) 
                    VALUES ('$prim_nom_client', '$seg_nom_client', '$prim_apelli_client', '$seg_apelli_client', '$edad_client', '$iden_client', '$tel_client', '$email_client')";

    if ($conn->query($sql_cliente) === TRUE) {
        $id_cliente = $conn->insert_id; // Obtener el ID generado
    } else {
        die("Error al insertar cliente: " . $conn->error);
    }

    // 2️⃣ Insertar en la tabla HOSPEDAJE
    $sql_hospedaje = "INSERT INTO hospedaje (fecha_entra, fecha_sal, cant_person, habitacion_idhabitacion, medio_pag_idmedio_pag) 
                      VALUES ('$fecha_entrada', '$fecha_salida', '$cant_person', '$habitacion_id', '$medio_pago')";

    if ($conn->query($sql_hospedaje) === TRUE) {
        $id_hospedaje = $conn->insert_id; // Obtener el ID generado
    } else {
        die("Error al insertar hospedaje: " . $conn->error);
    }

    // 3️⃣ Insertar en la tabla HOSPEDAJE_HAS_CLIENTE (relación entre cliente y hospedaje)
    $sql_relacion = "INSERT INTO hospedaje_has_cliente (hospedaje_idhospedaje, cliente_idcliente, hospedaje_habitacion_idhabitacion, hospedaje_medio_pag_idmedio_pag) 
                     VALUES ('$id_hospedaje', '$id_cliente', '$habitacion_id', '$medio_pago')";

    if ($conn->query($sql_relacion) === TRUE) {
        echo "Reserva realizada con éxito";

        // Redirigir a la página de reservación
        header("Location: reservacion.php");
        exit();
    } else {
        die("Error al insertar relación: " . $conn->error);
    }

    $conn->close();
}
?>
