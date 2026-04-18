<?php
session_start();

// Validación estricta: Si no hay sesión iniciada, acceso denegado.
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Acceso Denegado: Por favor inicie sesión para ver esta página.";
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; margin: 0; padding: 2rem; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .msg-success { background-color: #d1e7dd; color: #0f5132; padding: 1.5rem; border-radius: 8px; border-left: 6px solid #198754; margin-bottom: 2rem; }
        .btn-logout { display: inline-block; padding: 0.5rem 1rem; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s; }
        .btn-logout:hover { background-color: #bb2d3b; }
    </style>
</head>
<body>

<div class="container">
    <div class="msg-success">
        <h1 style="margin-top:0;">¡Acceso Permitido!</h1>
        <p>Bienvenido al sistema protegido, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>. Tu conexión a la base de datos y validación de sesión han sido exitosas.</p>
    </div>

    <p>Este es el contenido confidencial de tu aplicación PHP.</p>

    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
</div>

</body>
</html>