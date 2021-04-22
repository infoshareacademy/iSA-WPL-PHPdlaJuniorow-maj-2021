FROM php:7.4-fpm

RUN apt-get update

RUN pecl install xdebug-2.8.1
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
RUN docker-php-ext-enable xdebug

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY . /apps

VOLUME ["/apps"]
