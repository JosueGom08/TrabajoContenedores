<?php
$host = "mysql"; // nombre del servicio
$user = "usuario";
$password = "password";
$database = "mi_base";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conectado correctamente a MySQL";
?>
