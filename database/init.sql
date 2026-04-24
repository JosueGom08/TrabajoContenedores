CREATE TABLE rol (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(30) NOT NULL
);

CREATE TABLE usuario (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_name   VARCHAR(50)     NOT NULL UNIQUE,
    nombre      VARCHAR(100)    NOT NULL,
    id_rol      INT             NOT NULL,
    upassword   VARCHAR(255)    NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE logs (
    id_log          INT AUTO_INCREMENT PRIMARY KEY,
    usuario         INT         NOT NULL,
    operacion       VARCHAR(20) NOT NULL,
    tabla           VARCHAR(50) NOT NULL,
    registro_ant    TEXT        NULL,
    registro_upd    TEXT        NULL,
    fecha_registro  DATETIME    DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sesiones(
    id_sesiones         INT AUTO_INCREMENT PRIMARY KEY,
    usuario             INT         NOT NULL,
    fecha_ini_sesion    DATETIME    DEFAULT CURRENT_TIMESTAMP,
    fecha_fin_sesion    DATETIME    NULL
);

-- Inserts
INSERT INTO rol (descripcion) VALUES ('Administrador');
INSERT INTO rol (descripcion) VALUES ('Lectura');
INSERT INTO rol (descripcion) VALUES ('Login');

INSERT INTO usuario (user_name, nombre, id_rol, upassword) 
VALUES ('camm', 'Cesar Mazariegos', 1, '$Pizza');
