# Housing_4_Raajje

Property management web app for Housing_4_Raajje (branches in Malé, Hulhumalé and Villingili).
Built with Laravel 12 and MySQL.

## What you need

- [Laragon](https://laragon.org) with PHP 8.2 or newer (it includes MySQL and Composer)
- In Laragon: **Menu → PHP → Extensions → tick `zip`** (Composer needs it)

## Setup

Start Laragon (**Start All**), open **Laragon → Terminal**, then run:

```bash
git clone https://github.com/LegionX10/Housing-for-Raaje.git
cd Housing-for-Raaje
composer install
copy .env.example .env
php artisan key:generate
mysql -u root -e "CREATE DATABASE housing_4_raajje"
php artisan migrate --seed
```

## Run

```bash
php artisan serve
```

Open http://localhost:8000

## Test logins

Every password is `password`.

| Role | Email |
|---|---|
| System Administrator | admin@example.com |
| Branch Manager | manager@example.com |
| Property Specialist | specialist@example.com |
| Receptionist | receptionist@example.com |
| Property Owner | owner@example.com |
| Client | client@example.com |

## Useful commands

| Command | What it does |
|---|---|
| `php artisan migrate:fresh --seed` | Wipes the database and rebuilds it with the test data |
| `php artisan route:list --except-vendor` | Lists every page address in the app |
| `php artisan test` | Runs the tests |

## Where things are

| Folder / file | What is in it |
|---|---|
| `routes/web.php` | Every page address and which controller handles it |
| `app/Http/Controllers` | The code that runs when a page is opened or a form is sent |
| `app/Http/Middleware/CheckRole.php` | Blocks users from pages that are not for their role |
| `app/Models` | One class per database table |
| `database/migrations` | The database tables |
| `database/seeders` | The test data (branches and test logins) |
| `resources/views` | The HTML pages (Blade templates) |
| `public/css/app.css` | The styles, taken from the approved prototype |
