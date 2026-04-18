# Usamos la imagen oficial de PHP con Apache incluido
FROM php:8.2-apache

# Instalamos las extensiones necesarias para conectarnos a MySQL usando PDO
RUN docker-php-ext-install pdo pdo_mysql

# Habilitamos el módulo mod_rewrite de Apache (útil para URLs limpias si las necesitas a futuro)
RUN a2enmod rewrite

# Copiamos todos los archivos de tu proyecto (index.php, auth.php, etc.) 
# al directorio público de Apache dentro del contenedor
COPY . /var/www/html/

# Le damos los permisos adecuados a la carpeta
RUN chown -R www-data:www-data /var/www/html/

# Exponemos el puerto 80 para que podamos acceder desde el navegador
EXPOSE 80
