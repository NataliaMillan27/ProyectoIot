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


if ($ppm > 400) { 
    $telefono = "573227170232"; 
    $apikey = "5478237";
    
    $texto_alerta = "⚠️ Alerta: nivel de CO₂ peligroso ($ppm ppm). Verifica la zona.";
    $mensaje = urlencode($texto_alerta); 

    $url = "https://api.callmebot.com/whatsapp.php?phone={$telefono}&text={$mensaje}&apikey={$apikey}"; 

    // 3. Configurar un timeout de 5 segundos para que no se congele el script si CallMeBot falla
    $opciones = stream_context_create([
        'http' => ['timeout' => 5]
    ]);

    // 4. Silenciamos posibles warnings con @ por si la API falla, pero ejecutamos la petición
    @file_get_contents($url, false, $opciones); 
}
?>