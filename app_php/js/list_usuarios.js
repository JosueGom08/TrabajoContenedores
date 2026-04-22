document.addEventListener("DOMContentLoaded", () => {
    fetch('/list_usuarios.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        const wTBody = document.querySelector("table tbody");
        wTBody.innerHTML = "";
        console.log(data)
        data.forEach(user => {
            wTBody.innerHTML +=`
                <tr>
                    <td>${user.id}</td>
                    <td>${user.nombre}</td>
                    <td>${user.user_name}</td>
                    <td>${user.descripcion}</td>
                </tr>
            `;
        });
    })
    .catch(err => console.log("Error: ", err))
})