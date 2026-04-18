<?php
$host = "db"; // nombre del servicio
$user = "appsa";
$password = "appsa123";
$database = "usuariosdb";

do {
    $conn = @new mysqli($host, $user, $password, $database);

    if (!$conn->connect_error) {
        break;
    }

    sleep(2);
    $retry++;

} while ($retry < $max_retries);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conectado correctamente a MySQL";
?>
