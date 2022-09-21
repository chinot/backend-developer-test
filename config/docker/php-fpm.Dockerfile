FROM php:8.0.17-fpm-alpine

RUN apk update && apk add curl git wget

RUN apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS

RUN pecl update-channels

RUN docker-php-ext-install pdo pdo_mysql bcmath sockets opcache && docker-php-ext-enable opcache && pecl install apcu && docker-php-ext-enable apcu

RUN apk add rabbitmq-c-dev && pecl install amqp-1.11.0 && docker-php-ext-enable amqp

WORKDIR /usr/local/etc/php/conf.d/

COPY config/docker/config/php-fpm/php.ini .

WORKDIR /var/www/html

COPY . .

EXPOSE 9000
