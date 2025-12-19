FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

# Install required PHP extensions
RUN install-php-extensions intl pdo_mysql zip gd

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN php artisan key:generate || true

RUN php artisan storage:link || true
