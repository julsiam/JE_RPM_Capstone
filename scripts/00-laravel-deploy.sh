#!/usr/bin/env bash
echo "Running composer"

composer global require hirak/prestissimo

composer install --no-dev --working-dir=/var/www/html

composer update

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

# Running migrations
# echo "Running migrations..."
php artisan migrate --force
php artisan db:seed
# php artisan migrate --force

# Build your assets using npm and Laravel Mix
# Laravel Mix for asset compilation
echo "Building assets..."
npm install
npm run production



# Storage link (if needed)
echo "Creating storage link..."
php artisan storage:link
