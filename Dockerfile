FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

# Aktifkan extension yang dibutuhkan (TERMASUK intl)
ENV PHP_EXTENSIONS="intl pdo_mysql zip gd"

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN php artisan key:generate || true
RUN php artisan storage:link || true
