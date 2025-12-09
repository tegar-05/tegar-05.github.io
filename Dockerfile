FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN php artisan key:generate || true
RUN php artisan storage:link || true

EXPOSE 80

CMD ["php-fpm"]
FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN php artisan key:generate || true
RUN php artisan storage:link || true

EXPOSE 80

CMD ["php-fpm"]
