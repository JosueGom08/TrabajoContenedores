<?php
session_start();

// Validación estricta: Si no hay sesión iniciada, acceso denegado.
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Acceso Denegado: Por favor inicie sesión para ver esta página.";
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <p>Bienvenido al sistema, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?> <?php echo htmlspecialchars($_SESSION['rol']); ?></strong>. Tu conexión a la base de datos y validación de sesión han sido exitosas.</p>
    </div>

    <table class="table table-striped table-hover table-sm caption-top">
        <caption>LISTA DE USUARIOS</caption>
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>USUARIO</th>
                <th>ROL</th>
            </tr>
        </thead>
        <tbody class="table-group-divider"></tbody>
    </table>

    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
</div>

</body>
    <script src="../js/list_usuarios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>