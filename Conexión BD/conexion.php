<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "hotel";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
die("Conexión fallida: " . $conn->connect_error);
}
?>
