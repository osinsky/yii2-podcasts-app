FROM php:8.1-fpm-alpine

RUN apk add icu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-install pdo_mysql
