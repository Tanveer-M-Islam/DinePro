#!/usr/bin/env bash
set -e

echo "Deploying to Render..."

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Installing Node dependencies..."
npm install && npm run build

echo "Caching configuration..."
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations and seeds..."
# WARNING: This will wipe the database on every deploy. 
# Ideal for a demo site, but NOT for production.
php artisan migrate:fresh --seed --force

echo "Deployment finished!"
