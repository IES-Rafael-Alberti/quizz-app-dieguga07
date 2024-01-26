# Utiliza una imagen de PHP
FROM php:7.4-apache

# Instala las extensiones necesarias de PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copia los archivos de tu aplicación al contenedor
COPY . /var/www/html/
