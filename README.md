# DinePro - Modern Restaurant Management System

> **Easy Deployment:** This project includes a `Dockerfile` for easy deployment on **Railway**, **Render**, or any Docker-supported platform.

## 🚀 Quick Deploy (The Easy Way)
1. **Push to GitHub.**
2. **Deploy on Railway/Render:** Select "Docker" as the build method (or let it auto-detect the Dockerfile).
3. **Set Environment Variables:**
   - `APP_KEY`: (Generate locally with `php artisan key:generate --show`)
   - `DB_CONNECTION`: `sqlite` (For demo) or `mysql` (For production)

DinePro is a comprehensive and modern restaurant management solution designed to streamline your restaurant's operations. From managing menus and orders to handling reservations and customer reviews, DinePro offers a robust set of features wrapped in a stunning, responsive design.

## Key Features

- **Dashboard**: Real-time overview of orders, revenue, and daily stats.
- **Menu Management**: Create categories and menu items with images, prices, and descriptions.
- **Order Management**: Handle customer orders, update statuses, and print PDF invoices.
- **Manual Orders (POS)**: Create orders manually for walk-in customers or phone orders.
- **Reservations**: Accept and manage table bookings.
- **Website Settings**: Customize your restaurant's branding, hero section, about us, and contact info directly from the admin panel.
- **Theme Customization**: Choose from multiple pre-built themes or create your own.
- **SEO Optimization**: Integrated SEO settings for better search engine visibility.
- **Announcement System**: Post important updates directly on your website.
- **Opening Hours**: Display your operating hours prominently.
- **Customer Reviews**: Collect and showcase testimonials.
- **Responsive Design**: Looks great on desktop, tablet, and mobile.

## Project Structure

- `app`: core application logic (Controllers, Models, etc.)
- `config`: configuration files (Theme settings in `config/themes.php`)
- `resources/views`: frontend blade templates
    - `layouts`: main layout files (`public.blade.php`, `admin.blade.php`)
    - `public`: customer-facing pages
    - `admin`: administrative interface pages
- `routes`: route definitions (`web.php`, `api.php`)
- `public`: web root directory (assets, storage link)

## Admin Config
- **User**: `admin@example.com`
- **Password**: `password` (Default from seeder)

## Installation

Please refer to [INSTALL.md](INSTALL.md) for detailed installation instructions.

### Quick Start
1.  Copy `.env.example` to `.env` and configure database credentials.
2.  Run `composer install`.
3.  Run `php artisan key:generate`.
4.  Run `php artisan migrate --seed`.
5.  Run `php artisan storage:link`.
6.  Serve the application: `php artisan serve`.

## Customization

### Themes
DinePro comes with a powerful theming engine. You can configure themes in `config/themes.php`.
- **Pre-built Themes**: Elegant Midnight, Luxury Gold, Modern Gradient, Warm Rustic, Fresh Basil, Classic Crimson, Ocean Breeze, Sunset Glow, Industrial Chic.
- **Creating a Theme**: Simply duplicate an existing theme array in `config/themes.php` and modify the colors and fonts.

### Colors & Fonts
Colors and fonts are defined within the theme configuration.
- **Colors**: Primary, Secondary, Background, Surface, Text, Muted Text, Accent.
- **Fonts**: Heading and Body fonts (Google Fonts supported).

### Branding
Go to **Admin Panel > Website Settings** to upload your logo, set the restaurant name, and configure SEO settings.

## Support
For support, please email support@dinepro.com.
