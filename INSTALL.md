# DinePro - Installation Guide

## Requirements
- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Node.js & NPM (for asset compilation, optional if using pre-compiled assets)

## Installation Steps

1. **Unzip the Project**
   Extract the downloaded zip file to your server's root directory or desired folder.

2. **Install Dependencies**
   Open your terminal/command prompt in the project directory and run:
   ```bash
   composer install
   ```

3. **Environment Setup**
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Open `.env` and configure your database settings:
     ```
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```
   - Update your `APP_URL` to match your domain:
     ```
     APP_URL=http://yourdomain.com
     ```

4. **Generate App Key**
   Run the following command to generate a unique application key:
   ```bash
   php artisan key:generate
   ```

5. **Database Migration & Seeding**
   Run the migrations and seed the database with default data (User: admin@example.com / password):
   ```bash
   php artisan migrate --seed
   ```

6. **Link Storage**
   Link the public storage directory to serve images:
   ```bash
   php artisan storage:link
   ```

7. **Compile Assets (Optional)**
   If you need to make changes to CSS/JS:
   ```bash
   npm install
   npm run build
   ```

## Shared Hosting Setup

1. Upload all files to your server.
2. Put the contents of the `public` folder into your `public_html` (or subdomain folder).
3. Put the rest of the files in a folder named `dinepro` outside `public_html`.
4. Edit `index.php` in `public_html` to point to the correct paths:
   ```php
   require __DIR__.'/../dinepro/vendor/autoload.php';
   $app = require __DIR__.'/../dinepro/bootstrap/app.php';
   ```
5. Configure `.env` as above.

## Troubleshooting

- **500 Error**: Check `storage/logs/laravel.log` for details. Ensure `storage` and `bootstrap/cache` directories have write permissions (775).
- **Images not showing**: Verify `php artisan storage:link` was run successfully. On shared hosting, you might need to manually create a symlink.
