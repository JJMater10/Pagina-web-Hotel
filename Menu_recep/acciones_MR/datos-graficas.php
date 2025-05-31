<?php
include('../../Conexión_BD/conexion.php');

$reservasPorTipo = [
    "estandar" => array_fill(0, 12, 0),
    "junior" => array_fill(0, 12, 0),
    "presidencial" => array_fill(0, 12, 0)
];

$gananciasPorMes = array_fill(0, 12, 0);

$sql = "SELECT 
            h.fecha_entra,
            hab.nom_hab,
            hab.precio_hab
        FROM hospedaje h
        INNER JOIN habitacion hab ON h.habitacion_idhabitacion = hab.idhabitacion";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $mes = (int)date('n', strtotime($row['fecha_entra'])) - 1;
    $tipo = strtolower($row['nom_hab']);

    if (strpos($tipo, 'estándar') !== false || strpos($tipo, 'estandar') !== false) {
        $reservasPorTipo["estandar"][$mes]++;
    } elseif (strpos($tipo, 'junior') !== false) {
        $reservasPorTipo["junior"][$mes]++;
    } elseif (strpos($tipo, 'presidencial') !== false) {
        $reservasPorTipo["presidencial"][$mes]++;
    }

    $gananciasPorMes[$mes] += $row['precio_hab'];
}

echo json_encode([
    "reservas" => $reservasPorTipo,
    "ganancias" => $gananciasPorMes
]);
