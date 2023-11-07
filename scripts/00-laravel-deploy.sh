#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo

composer install --no-dev --working-dir=/var/www/html

# echo "generating application key..."
# php artisan key:generate --show

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

# Run migrations (if you need to)
echo "Running migrations..."
php artisan migrate --force

# # Build your assets using npm and Laravel Mix
# # This assumes you are using Laravel Mix for asset compilation
# echo "Building assets..."
# npm install
# npm run production

# # Optionally, you can run other Laravel commands here as needed for your application.


# echo "Running database seeding..."
# php artisan db:seed --class=UserSeeder

# # Storage link (if needed)
echo "Creating storage link..."
php artisan storage:link
