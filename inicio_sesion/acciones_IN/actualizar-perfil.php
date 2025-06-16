<?php
session_start();
require_once("../../Conexión_BD/conexion.php");

// Asegurarse de que el usuario esté logueado
if (!isset($_SESSION['nom_cecep'])) {
    header("Location: ../inicio_sesion/page-login.php");
    exit();
}

// Validar si llegaron los datos por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idemple_recep = intval($_POST['idemple_recep']);
    $nom_cecep     = trim($_POST['nom_cecep']);
    $apelli_cecep  = trim($_POST['apellido']);
    $edad_recep    = intval($_POST['edad_recep']);
    $tel_recep     = trim($_POST['tel_recep']);
    $ident_recep   = trim($_POST['ident_recep']);
    $correo_recep  = trim($_POST['email_recep']);

    // Prepara la consulta
    $sql = "UPDATE emple_recep 
            SET nom_cecep = ?, 
                apellido = ?, 
                edad_recep = ?, 
                tel_recep = ?, 
                ident_recep = ?, 
                email_recep = ?
            WHERE idemple_recep = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssisssi", $nom_cecep, $apelli_cecep, $edad_recep, $tel_recep, $ident_recep, $correo_recep, $idemple_recep);

        if ($stmt->execute()) {
            // ✅ Actualización exitosa
            header("Location: ../app-profile.php?exito=1");
            exit();
        } else {
            echo "❌ Error al actualizar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "❌ No se recibieron datos válidos por POST.";
}

$conn->close();
?>
