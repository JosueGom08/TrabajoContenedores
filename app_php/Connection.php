<?php
/**
 * Archivo de conexión a la base de datos MySQL usando PDO.
 * Esta versión incluye constantes para facilitar la edición y 
 * una mejor gestión de seguridad.
 */

// 1. Configuración de parámetros
// Edita estos valores según los datos de tu contenedor MySQL
define('DB_HOST', 'db');     // Nombre del servicio en docker-compose o IP
define('DB_NAME', 'suariosdb');     // Nombre de tu base de datos
define('DB_USER', 'appsa');   // Usuario con privilegios
define('DB_PASS', 'appsa123');   // Contraseña del usuario
define('DB_CHARSET', 'utf8mb4');    // Codificación para soporte de tildes y ñ

/**
 * Función para obtener la conexión
 * Encapsular la conexión ayuda a reutilizarla y a cerrar la conexión fácilmente.
 */
function conectarDB() {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
        // En producción, evita mostrar el error detallado al usuario. 
        // Es mejor registrarlo en un log interno.
        error_log("Error de conexión: " . $e->getMessage());
        die("Error: No se pudo establecer la comunicación con el servidor de datos.");
    }
}

// Inicializamos la variable global que usará auth.php
$pdo = conectarDB();
?>