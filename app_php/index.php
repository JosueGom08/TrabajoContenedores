<?php
// Iniciamos la sesión para poder acceder a los mensajes de error o éxito
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Autenticación</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f2f5; margin: 0; }
        .login-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-card h2 { text-align: center; color: #333; margin-top: 0; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; color: #666; }
        .form-group input { width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        .btn-submit { width: 100%; padding: 0.75rem; background-color: #0d6efd; color: white; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer; transition: background-color 0.3s; }
        .btn-submit:hover { background-color: #0b5ed7; }
        
        /* Estilos para los mensajes requeridos en el entregable */
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 4px; text-align: center; }
        .alert-danger { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .alert-success { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Iniciar Sesión</h2>

    <!-- Mostrar mensajes de acceso denegado o sesión cerrada -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']); // Limpiamos el mensaje
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']); 
            ?>
        </div>
    <?php endif; ?>

    <form action="auth.php" method="POST">
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-submit">Ingresar</button>
    </form>
</div>

</body>
</html>