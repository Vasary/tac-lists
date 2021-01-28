FROM php:8.0.1-fpm-alpine

LABEL maintainer = <gievoi.v@gmail.com>
ENV TZ=UTC

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /application

RUN set -xe \
    && mkdir -m 775 -p /var/application \
    && chown -R www-data:www-data /var/application \
    && apk add --no-cache --no-progress --update postgresql-dev libpq \
    && docker-php-ext-install pdo_pgsql opcache

COPY docker/php-fpm/config/opcache.ini /usr/local/etc/php-fpm.d
