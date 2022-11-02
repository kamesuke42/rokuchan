FROM php:8.1-apache
RUN apt-get update \
    && docker-php-ext-install pdo_mysql
