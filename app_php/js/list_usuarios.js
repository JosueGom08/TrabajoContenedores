document.addEventListener("DOMContentLoaded", () => {
    fetch('/php/list_usuarios.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        const wTBody = document.querySelector("table tbody");
        wTBody.innerHTML = "";
        data.forEach(user => {
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
                <tr>
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

function actualizarUsuario (idUsr){
    if(confirmar('actualizar')) return
    

}

function confirmar(operacion) {
    return confirm(`¿Seguro que deseas ${operacion} este usuario?`);
}