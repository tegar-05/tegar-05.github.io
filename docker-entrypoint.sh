#!/bin/sh
set -e

echo "Starting Laravel container..."

# Pastikan Laravel key ada
php artisan key:generate || true

# Clear cache dan config (setelah env MySQL tersedia)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Jalankan PHP-FPM
exec php-fpm
