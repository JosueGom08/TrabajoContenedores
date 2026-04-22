# 📦 Proyecto PHP + MySQL + Docker

Este proyecto consiste en una aplicación web desarrollada en PHP con base de datos MySQL, ejecutándose en contenedores Docker.

---

# 🚀 Requisitos

* Docker
* Docker Compose
* Git

---

# 🐳 Comandos Docker

## 🔧 Construir y levantar contenedores

```bash
docker-compose up --build
```

## ▶️ Levantar contenedores en segundo plano

```bash
docker-compose up -d
```

## ⛔ Detener contenedores

```bash
docker-compose down
```

## 🧹 Eliminar contenedores, redes y volúmenes

```bash
docker-compose down -v
```

## 🔄 Reconstruir contenedores

```bash
docker-compose up --build --force-recreate
```

## 📋 Ver contenedores activos

```bash
docker ps
```

## 📜 Ver logs

```bash
docker-compose logs
```

---

# 🛢️ Conexión a MySQL (desde CMD)

## 🔗 Acceder al contenedor

```bash
docker exec -it nombre_contenedor_mysql bash
```

## 🧑‍💻 Conectarse a MySQL dentro del contenedor

```bash
mysql -u root -p
```

## 🔗 Conectarse directamente desde host

```bash
mysql -h 127.0.0.1 -P 3306 -u root -p
```

> Nota: El puerto puede variar según tu configuración en `docker-compose.yml`

---

# 🐘 Comandos útiles dentro de MySQL

```sql
SHOW DATABASES;
USE nombre_db;
SHOW TABLES;
DESCRIBE usuario;
```

---

# 🌿 Git - Comandos básicos

## 🔁 Clonar repositorio

```bash
git clone <url_repo>
```

## 📦 Inicializar repositorio

```bash
git init
```

## 📄 Ver estado

```bash
git status
```

## ➕ Agregar cambios

```bash
git add .
```

## 💾 Crear commit

```bash
git commit -m "mensaje del commit"
```

## 🚀 Subir cambios

```bash
git push origin main
```

## 🔄 Obtener cambios

```bash
git pull origin main
```

---

# 🌱 Manejo de ramas

## 🔹 main

* Rama principal del proyecto
* Contiene código estable y listo para producción
* No se debe trabajar directamente aquí

## 🔹 develop / feature

### feature/

* Se crean para desarrollar nuevas funcionalidades
* Ejemplo:

```bash
git checkout -b feature/login
```

### develop

* Rama de integración
* Aquí se combinan todas las features antes de pasar a main

---

## 🔀 Flujo recomendado

1. Crear rama feature
2. Trabajar cambios
3. Hacer commit
4. Merge a develop
5. Probar
6. Merge a main

---

# 🧪 Comandos útiles adicionales

## 🐳 Entrar a contenedor PHP

```bash
docker exec -it nombre_contenedor_php bash
```

## 🔄 Reiniciar contenedor

```bash
docker restart nombre_contenedor
```

## 🧹 Limpiar sistema Docker

```bash
docker system prune -a
```

⚠️ Elimina todo lo no utilizado

---

# ⚠️ Buenas prácticas

* No subir credenciales al repositorio
* Usar variables de entorno
* Validar entradas en backend
* No exponer contraseñas en APIs

---

# 📌 Notas

* Asegúrate de que los puertos no estén en uso
* Verifica conexión entre contenedores
* Usa logs para depuración

---

# 👨‍💻 Autor

Proyecto desarrollado como práctica de integración:

* PHP
* MySQL
* Docker
* JavaScript (fetch API)