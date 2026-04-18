CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(10),
    nombre VARCHAR(50)
);

CREATE TABLE rol (
    rol INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(30)
);

CREATE TABLE usuario_rol (
    usuario INT,
    rol INT,
    FOREIGN KEY (usuario) REFERENCES usuario(id),
    FOREIGN KEY (rol) REFERENCES rol(rol)
);
