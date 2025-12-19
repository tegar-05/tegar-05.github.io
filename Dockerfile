# Gunakan PHP 8.2 FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies sistem dan PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project Laravel
COPY . .

# Install Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Laravel setup
RUN php artisan key:generate || true
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Expose port 9000 (default PHP-FPM)
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
