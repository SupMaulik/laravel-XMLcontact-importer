## ✅ Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/SupMaulik/laravel-XMLcontact-importer.git
cd laravel-XMLcontact-importer
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
php artisan queue:work
