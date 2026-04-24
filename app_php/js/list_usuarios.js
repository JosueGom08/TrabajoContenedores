document.addEventListener("DOMContentLoaded", () => {
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
    })
    .catch(err => console.log("Error: ", err))
});


function eliminarUsuario (idUsr){
    if(!confirmar('eliminar')) return
    fetch('/php/usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            metodo: 'ELIMINAR',
            id_user: idUsr
        })
    })
    .then(res => res.json())
    .then(data => {
        if (!data.estatus){
            alert(data.mensaje)
            return;
        }
        alert("Usuario Eliminado Correctamente")
    })
}

function actualizarUsuario (id){
    fetch('/php/usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            metodo: 'OBTENER',
            id_user: id
        })
    }).then(res => res.json())
    .then(data => {
        document.getElementById('inpNombre').value = data.nombre
        document.getElementById('inpUsuario').value = data.user_name
        document.getElementById('inpRol').value = data.id_rol
        document.getElementById('btnTransmitir').value = id
    })
}

function confirmar(operacion) {
    return confirm(`¿Seguro que deseas ${operacion} este usuario?`);
}
