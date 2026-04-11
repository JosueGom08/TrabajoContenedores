create table usuario (
    id          int AUTO_INCREMENT PRIMARY KEY,
    user_name   varchar(10),
    nombre      varchar(50)
)

create table rol (
    rol             int AUTO_INCREMENT PRIMARY KEY,
    descripcion     varchar(30)
)

create table log(
    idLog       int AUTO_INCREMENT PRIMARY KEY,
    idUser      int,
    accion      char(1),
    datosAnt    varchar(150),
    datosDes    varchar(150)
)

create table usaurio_rol(
    usuario int,
    rol     int
)