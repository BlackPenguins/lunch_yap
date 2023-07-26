FROM composer:latest

WORKDIR /var/www/html

ENTRYPOINT ["composer", "require", "vlucas/phpdotenv"]