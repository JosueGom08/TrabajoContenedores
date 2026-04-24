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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Panel de Control</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; margin: 0; padding: 2rem; }
        .msg-success { background-color: #d1e7dd; color: #0f5132; padding: 1.5rem; border-radius: 8px; border-left: 6px solid #198754; margin-bottom: 2rem; }
        .btn-logout { display: inline-block; padding: 0.5rem 1rem; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s; }
        .btn-logout:hover { background-color: #bb2d3b; }
    </style>
</head>
<body>
<script>
    const ID_ROL = <? echo htmlspecialchars($_SESSION['id_rol'])?>
</script>
<div class="container-fluid">
    <div class="msg-success">
        <h1 style="margin-top:0;">¡Acceso Permitido!</h1>
        <p>Bienvenido al sistema, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?> <?php echo htmlspecialchars($_SESSION['rol']); ?></strong>. Tu conexión a la base de datos y validación de sesión han sido exitosas.</p>
    </div>
    <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != 3): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" id="btnTransmitir" value="0">Transmitir</button>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="spnNombre">Nombre</span>
                        <input type="text" class="form-control" aria-describedby="spnNombre" id="inpNombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="spnUsuario">Usuario</span>
                        <input type="text" class="form-control"  aria-describedby="spnUsuario" id="inpUsuario">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="spnPassword">Contraseña</span>
                        <input type="password" class="form-control"  aria-describedby="spnPassword" id="inpPassword">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inpRol">Rol</label>
                            <select class="form-select" id="inpRol">
                                <option selected>-- Rol --</option>
                                <option value="1">Administrador</option>
                                <option value="2">Lectura</option>
                                <option value="3">Login</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <table class="table table-striped table-hover table-sm caption-top">
            <caption>LISTA DE USUARIOS</caption>
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>USUARIO</th>
                    <th>ROL</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider" id="tbData"></tbody>
        </table>
    <?php endif; ?>
    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
</div>



</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../js/list_usuarios.js"></script>

    <script>
        $("#btnTransmitir").on('click', (event) =>{
            const id = parseInt($("#btnTransmitir").val());
            if (id > 0){// ES ACTUALIZACION
                $("#btnTransmitir").val(0);
                fetch('/php/usuario.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        metodo: "ACTUALIZAR",
                        id_user: id,
                        nombre: $('#inpNombre').val(),
                        usuario: $('#inpUsuario').val(),
                        contrasenia: $('#inpPassword').val(),
                        rol: $('#inpRol').val()
                    })
                })
                .then(res => res.json())
                .then(data => {
                    fnLoadPage()
                    fnLimpiar()
                })
            }else if (id == 0){
                fetch('/php/usuario.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        metodo: "INSERTAR",
                        nombre: $('#inpNombre').val(),
                        usuario: $('#inpUsuario').val(),
                        contrasenia: $('#inpPassword').val(),
                        rol: $('#inpRol').val()
                    })
                })
                .then(res => res.json())
                .then(data => {
                    fnLoadPage()
                    fnLimpiar()
                })
            }
        })

        function fnLimpiar(){
            $('#inpNombre').val(''),
            $('#inpUsuario').val(''),
            $('#inpPassword').val(''),
            $('#inpRol').val(0)
            $("#btnTransmitir").val(0)
        }
        function fnLoadPage ()  {
            if(ID_ROL === 3) return;
            fetch('/php/list_usuarios.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                const wTBody = document.querySelector("table tbody");
                wTBody.innerHTML = "";
                data.forEach(user => {
                    let accion = ""
                    if (ID_ROL === 1){
                        accion = `
                        <td>
                            <button type="button" onclick="eliminarUsuario(${user.id})" class"btn-sm">
                                Eliminar
                            </button>
                        </td>
                        <td>
                            <button type="button" onclick="actualizarUsuario(${user.id})" class"btn-sm">
                                Actualizar
                            </button>
                        </td>
                        `
                    }
                    wTBody.innerHTML +=`
                        <tr id="${user.id}">
                            <td>${user.id}</td>
                            <td>${user.nombre}</td>
                            <td>${user.user_name}</td>
                            <td>${user.descripcion}</td>
                            ${accion}
                        </tr>
                    `;
                });
            }).catch(err => console.log("Error: ", err))
        }
    </script>
</html>