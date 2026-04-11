<?php
$host = "mysql"; // nombre del servicio
$user = "appsa";
$password = "appsa123";
$database = "usuariosdb";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conectado correctamente a MySQL";
?>
