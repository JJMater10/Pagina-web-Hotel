<?php
session_start();
include('../../Conexión_BD/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['ident_recep'];
    $new_password = $_POST['new_password'];

    if (!empty($cedula) && !empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "SELECT idemple_recep FROM emple_recep WHERE ident_recep = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $idemple = $row['idemple_recep'];

            $update_sql = "UPDATE cuenta_recep SET clave = ? WHERE emple_recep_idemple_recep = ?";
            $stmt_update = $conn->prepare($update_sql);
            $stmt_update->bind_param("si", $hashed_password, $idemple);

            if ($stmt_update->execute()) {
                // ✅ Redirección con éxito
                header("Location: ../page-login.php?estado=ok");
                exit();
            } else {
                // ⚠ Error al actualizar
                header("Location: ../page-lock.php?estado=error_actualizar");
                exit();
            }

            $stmt_update->close();
        } else {
            // ⚠ Usuario no encontrado
            header("Location: ../page-lock.php?estado=no_encontrado");
            exit();
        }

        $stmt->close();
    } else {
        // ⚠ Campos vacíos
        header("Location: ../page-lock.php?estado=campos_vacios");
        exit();
    }

    $conn->close();
}
?>
