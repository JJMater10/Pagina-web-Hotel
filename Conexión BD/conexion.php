<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión BD</title>
</head>
<body>
    <?php
        $servidor = "localhost";
        $usuario = "root";
        $contrasena = "";
        $bd = "hotel";

        $conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

        if($conexion->connect_error){
            die("Conexión fallida: " . $conexion->connect_error);
        }

        echo "Conexión exitosa";
    ?>
    
</body>
</html>