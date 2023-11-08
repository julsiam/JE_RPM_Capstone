#!/usr/bin/env bash
echo "Running composer"

composer global require hirak/prestissimo

composer install --no-dev --working-dir=/var/www/html

composer update

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

# Run migrations (if you need to)
# echo "Running migrations..."
# php artisan migrate:fresh --seed --force
# php artisan migrate --force

# Build your assets using npm and Laravel Mix
# This assumes you are using Laravel Mix for asset compilation
echo "Building assets..."
npm install
npm run production



# echo "Running database seeding..."
# # php artisan db:seed --class=UserSeeder

# Storage link (if needed)
echo "Creating storage link..."
php artisan storage:link
