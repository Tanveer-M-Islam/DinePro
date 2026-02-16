#!/bin/bash
set -e

echo "🚀 Starting DinePro..."

# 1. Force SQLite Configuration
# We export these to override any .env file that might have been copied
export DB_CONNECTION=sqlite
export DB_DATABASE=/var/www/html/database/database.sqlite

echo "🔧 Configuring Database..."
# Ensure database directory is writable
if [ ! -d "/var/www/html/database" ]; then
    mkdir -p /var/www/html/database
fi

# Create SQLite file if it doesn't exist
if [ ! -f "$DB_DATABASE" ]; then
    touch "$DB_DATABASE"
fi

# Fix permissions
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/database

echo "🧹 Clearing Config Cache..."
rm -f .env
php artisan config:clear

echo "🗄️ Running Migrations & Seeding..."
# Force migration and seed
php artisan migrate:fresh --seed --force

echo "✨ Optimizing Application..."
php artisan cache:clear
php artisan view:cache
php artisan route:cache

echo "✅ Deployment Ready."
echo "🔌 Starting Apache..."

# Execute the main container command
exec "$@"
