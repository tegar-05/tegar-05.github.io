FROM serversideup/php:8.2-fpm-nginx

ENV PHP_EXTENSIONS="intl pdo_mysql zip gd"

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN php artisan key:generate || true
RUN php artisan storage:link || true
