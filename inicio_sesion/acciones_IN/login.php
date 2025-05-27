<?php
session_start();
include('../../Conexión_BD/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['usuario_login'];   
    $contraseña = $_POST['password_login']; 

    if (!empty($cedula) && !empty($contraseña)) {
        $sql = "SELECT e.idemple_recep, e.nom_cecep, c.clave 
                FROM emple_recep e 
                JOIN cuenta_recep c ON e.idemple_recep = c.emple_recep_idemple_recep 
                WHERE e.ident_recep = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($contraseña, $user['clave'])) {
                $_SESSION['nom_cecep'] = $user['nom_cecep'];
                header("Location: ../app-profile.php"); // Redirigir a la página de perfil
                exit();
            } else {
                // Contraseña incorrecta
                header("Location: ../page-login.php?error=1"); // puedes mostrar "Contraseña incorrecta"
                exit();
            }
        } else {
            // Usuario no encontrado
            header("Location: ../page-login.php?error=2"); // puedes mostrar "Usuario no encontrado"
            exit();
        }

        $stmt->close();
    } else {
        header("Location: ../page-login.php?error=3"); // puedes mostrar "Campos vacíos"
        exit();
    }
}

$conn->close();
?>
