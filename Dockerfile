# Gunakan PHP 8.2 FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
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

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port 9000
EXPOSE 9000

# Jalankan entrypoint script saat container start
ENTRYPOINT ["docker-entrypoint.sh"]
