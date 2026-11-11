FROM php:8.5.12-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_pgsql redis memcached zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY zz-socket.conf /usr/local/etc/php-fpm.d/zz-socket.conf