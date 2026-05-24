<?php 

$conexion = mysqli_connect(
    "127.0.0.1",
    "appuser",
    "1234",
    "monitor_gases"
);

$resultado = mysqli_query($conexion, "SELECT * FROM lecturas ORDER BY fecha_hora DESC LIMIT 10"); 

 

echo "<table border='1'><tr><th>PPM</th><th>Fecha</th></tr>"; 

while ($fila = mysqli_fetch_assoc($resultado)) { 

echo "<tr><td>{$fila['valor_gas']}</td><td>{$fila['fecha_hora']}</td></tr>"; 

} 

echo "</table>"; 

?> 

 

<script> 

setInterval(() => { 

location.reload(); 

}, 10000); 

</script> 