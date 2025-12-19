FROM serversideup/php:8.2-fpm-nginx

ENV WEB_DOCUMENT_ROOT=/var/www/html/public

WORKDIR /var/www/html
COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN php artisan key:generate || true
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear
