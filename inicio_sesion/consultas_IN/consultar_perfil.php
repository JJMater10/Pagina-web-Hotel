<?php
include('../Conexión_BD/conexion.php'); // Ajusta la ruta si es diferente
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nom_cecep'])) {
    header('Location: page-login.php');
    exit();
}

// Consultar la información del usuario logueado
$nombreUsuario = $_SESSION['nom_cecep'];

$sql = "SELECT e.idemple_recep, e.nom_cecep, e.apellido, e.edad_recep, e.tel_recep, e.ident_recep, e.email_recep, c.clave
        FROM emple_recep e
        JOIN cuenta_recep c ON e.idemple_recep = c.emple_recep_idemple_recep
        WHERE e.nom_cecep = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombreUsuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
} else {
    echo "No se encontraron datos del usuario.";
    exit();
}
?>