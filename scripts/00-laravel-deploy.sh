#!/usr/bin/env bash
echo "Running composer"

composer global require hirak/prestissimo

composer install --no-dev


echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

# Running migrations
echo "Running migrations..."
php artisan migrate:fresh --seed --force
php artisan db:seed
# php artisan migrate --force

#asset
echo "Building assets..."
npm install
npm run production


echo "Creating storage link..."
php artisan storage:link
