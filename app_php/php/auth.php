<?php
session_start();

// Requerimos el archivo de conexión que ya tienes listo
require_once 'Connection.php';

// Verificamos que el formulario se haya enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtenemos y limpiamos los datos enviados
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        // Utilizamos la variable $pdo definida en tu archivo conexion.php
        // Preparamos la consulta para prevenir inyección SQL
        $sql = "SELECT usr.id, usr.user_name,usr.nombre, usr.upassword, usr.id_rol, rl.descripcion
                FROM usuario usr
                INNER JOIN rol rl ON usr.id_rol = rl.id_rol
                WHERE user_name = :username LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch();
        // Validamos si el usuario existe y si la contraseña coincide.
        // NOTA: Se asume que las contraseñas en BD están encriptadas con password_hash().
        // Si en tu BD están en texto plano (no recomendado), cambia esto a: if ($user && $password === $user['password'])
        if ($user && $password === $user['upassword']) {
            
            // Credenciales correctas: Creamos las variables de sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['id_rol'] = $user['id_rol'];
            $_SESSION['rol'] = $user['descripcion'];

            $sql = "INSERT INTO sesiones (usuario) values (:user_id);";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $_SESSION['user_id']
            ]);
            
            // Redirigimos a la página protegida
            header("Location: dashboard.php");
            exit;

        } else {
            // Acceso denegado: Mensaje claro como pide el entregable
            $_SESSION['error'] = "Acceso Denegado: Credenciales incorrectas.";
            header("Location: ../index.php");
            exit;
        }

    } catch (PDOException $e) {
        // Error de base de datos
        $_SESSION['error'] = "Error en el sistema. Intente más tarde.";
        error_log("Error en auth.php: " . $e->getMessage());
        header("Location: ../index.php");
        exit;
    }
} else {
    // Si acceden directamente al archivo sin POST
    header("Location: ../index.php");
    exit;
}
?>