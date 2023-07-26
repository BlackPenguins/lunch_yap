FROM php:fpm-alpine3.15

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql