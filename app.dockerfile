FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    default-mysql-client --no-install-recommends \
    zip unzip git \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo_mysql mysqli bcmath \
    && docker-php-ext-install pcntl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer