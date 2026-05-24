<?php
if (!isset($_POST['ppm'])) {
    http_response_code(400);
    exit("No llegó ppm");
}

$ppm = floatval($_POST['ppm']);

$conexion = mysqli_connect(
    "127.0.0.1",
    "appuser",
    "1234",
    "monitor_gases"
);

if (!$conexion) {
    http_response_code(500);
    exit("Error DB: " . mysqli_connect_error());
}

$sql = "INSERT INTO lecturas (valor_gas, fecha_hora) VALUES ($ppm, NOW())";

if (mysqli_query($conexion, $sql)) {
    echo "INSERT OK. PPM recibido: $ppm";
} else {
    http_response_code(500);
    echo "Error INSERT: " . mysqli_error($conexion);
}
?>