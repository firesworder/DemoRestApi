FROM php:7.4-fpm
COPY php.ini /usr/local/etc/php/php.ini
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
	&& docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/public
COPY composer.json composer.lock ./
RUN composer install
ENV PROJECT_DIR=/var/www/public
COPY public .
CMD ["php-fpm"]
