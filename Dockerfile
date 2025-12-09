FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libicu-dev \
    && docker-php-ext-install intl zip pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy all files
COPY . .

# Install composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Laravel permissions
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
