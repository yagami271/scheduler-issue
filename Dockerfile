FROM php:8.3.0-fpm-alpine


RUN apk --no-cache add \
    curl wget git mysql-client bash nginx supervisor openssl htop \
    icu-dev zlib-dev libpng-dev oniguruma-dev libzip-dev
RUN docker-php-ext-install opcache gd exif pcntl pdo_mysql intl zip
RUN docker-php-ext-enable opcache


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app/symfony
