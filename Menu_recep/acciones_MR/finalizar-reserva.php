<?php
require '../Conexión_BD/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idhospedaje = $_POST['idhospedaje'];
    $idhabitacion = $_POST['idhabitacion'];

    // 1. Actualizar el estado de la reserva
    $update = $conn->prepare("UPDATE hospedaje SET estado = 'Finalizado' WHERE idhospedaje = ?");
    $update->bind_param("i", $idhospedaje);
    $update->execute();

    // 2. Sumar 1 habitación disponible
    $sumar = $conn->prepare("UPDATE habitacion SET hab_dispo = hab_dispo + 1 WHERE idhabitacion = ?");
    $sumar->bind_param("i", $idhabitacion);
    $sumar->execute();

    echo json_encode(["success" => true]);
}
