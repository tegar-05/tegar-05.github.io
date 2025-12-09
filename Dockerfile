FROM serversideup/php:8.2-fpm-nginx

# Enable PHP extensions
RUN enable-php-extension intl zip

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

CMD ["php-fpm"]
