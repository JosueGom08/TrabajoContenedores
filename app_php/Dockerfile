FROM php:8.2-cli
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "./phpAplication.php" ]
