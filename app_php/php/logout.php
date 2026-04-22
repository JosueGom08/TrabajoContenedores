<?php
// Iniciamos la sesión actual para poder destruirla
session_start();

// Vaciamos todas las variables de sesión
$_SESSION = array();

// Destruimos la sesión en el servidor
session_destroy();

// Iniciamos una nueva sesión limpia solo para enviar el mensaje de éxito al login
session_start();
$_SESSION['success'] = "Sesión cerrada correctamente.";

// Redirigimos al formulario de login
header("Location: ../index.php");
exit;
?>