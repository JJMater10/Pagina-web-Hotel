<?php
session_start();
include('../../Conexión_BD/conexion.php'); // Asegúrate que esta ruta sea correcta

// Establecer codificación para caracteres especiales
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica si hay sesión activa
    if (!isset($_SESSION['idemple_recep'])) {
        echo "Error: No se ha iniciado sesión.";
        exit;
    }

    // Obtener los datos del formulario
    $idemple_recep = $_SESSION['idemple_recep'];
    $nom_cecep = trim($_POST['nom_cecep']);
    $edad_recep = trim($_POST['edad_recep']);
    $tel_recep = trim($_POST['tel_recep']);
    $email_recep = trim($_POST['email_recep']);

    // Validación básica
    if (empty($nom_cecep) || empty($edad_recep) || empty($tel_recep) || empty($email_recep)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validar edad como entero positivo
    if (!is_numeric($edad_recep) || (int)$edad_recep <= 0) {
        echo "Edad no válida.";
        exit;
    }

    // Validar formato de teléfono (solo números, entre 7 y 15 dígitos)
    if (!preg_match("/^[0-9]{7,15}$/", $tel_recep)) {
        echo "Número de teléfono no válido.";
        exit;
    }

    // Validar formato de email
    if (!filter_var($email_recep, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Preparar y ejecutar la actualización
    $sql = "UPDATE emple_recep SET nom_cecep = ?, edad_recep = ?, tel_recep = ?, email_recep = ? WHERE idemple_recep = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $nom_cecep, $edad_recep, $tel_recep, $email_recep, $idemple_recep);
        if ($stmt->execute()) {
            $_SESSION['mensaje_perfil'] = "Perfil actualizado correctamente.";
            header("Location: ../app-profile.php");
            exit;
        } else {
            echo "Error al actualizar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
