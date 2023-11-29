#!/usr/bin/env bash
echo "Running composer"

composer global require hirak/prestissimo

composer install --no-dev --working-dir=/var/www/html/

# echo "Generating app key..."
# php artisan key:generate --show

echo "Caching config..."
php artisan config:cache
# php artisan cache:clear

echo "Caching routes..."
php artisan route:cache

# Running migrations
echo "Running migrations..."
php artisan migrate:fresh --seed --force
# php artisan migrate
# php artisan db:seed

#build asset...
echo "Building assets"
npm install
npm run production

#for pictures
echo "Creating storage link..."
php artisan storage:link

# php artisan send:send-due-emails
# php artisan sms:send-due-date-notifications
