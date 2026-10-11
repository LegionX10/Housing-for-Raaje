# Housing_4_Raajje

Property management web app for Housing_4_Raajje (branches in Malé, Hulhumalé and Villingili).
Built with Laravel 12 and MySQL.

## 1. Install these first

| Software | Version to use | Where to get it |
|---|---|---|
| **Laragon** | 8.x (built with 8.6.4) | https://laragon.org/download |
| **Git** | Any recent version | https://git-scm.com/downloads |

Laragon is the only big install. It already includes everything else the project needs:

| Included in Laragon | Version to use | Notes |
|---|---|---|
| **PHP** | **8.3** (built with 8.3.33) | Must be 8.2 or newer. Laravel 12 does not run on older PHP. |
| **MySQL** | **8.4** (built with 8.4.3) | 8.0 or newer is fine |
| **Composer** | 2.x (built with 2.10.2) | Installs the PHP packages |

Node.js is **not** needed.

## 2. Prepare Laragon (one time)

1. Install Laragon to the default folder `C:\laragon` and open it.
2. Check the PHP version: **Menu → PHP → Version**. It must say 8.2 or newer.
3. Turn on the zip extension: **Menu → PHP → Extensions → tick `zip`**. Composer cannot download packages without it.
4. Click **Start All**. MySQL must be running (Apache is not used).

## 3. Set up the project (one time)

Open **Laragon → Terminal**. Use this terminal for every command below, because a normal Windows terminal does not know where `php` and `composer` are.

```bash
git clone https://github.com/LegionX10/Housing-for-Raaje.git
cd Housing-for-Raaje
composer install
copy .env.example .env
php artisan key:generate
mysql -u root -e "CREATE DATABASE housing_4_raajje"
php artisan migrate --seed
```

What each command does:

| Command | What it does |
|---|---|
| `git clone ...` | Downloads the project |
| `composer install` | Downloads Laravel and the other PHP packages into `vendor/` |
| `copy .env.example .env` | Creates your local settings file (database name, user, password) |
| `php artisan key:generate` | Creates the secret key Laravel uses to protect logins |
| `mysql -u root -e "CREATE DATABASE ..."` | Creates the empty database |
| `php artisan migrate --seed` | Creates the tables and adds the test data |

The database settings in `.env` are already correct for a default Laragon install (user `root`, no password). Only change them if your MySQL is set up differently.

## 4. Run the app

Make sure Laragon is started, then in the Laragon Terminal, inside the project folder:

```bash
php artisan serve
```

Open http://localhost:8000 in your browser. Press `Ctrl + C` in the terminal to stop the app.

## 5. Test logins

Every password is `password`.

| Role | Email |
|---|---|
| System Administrator | admin@example.com |
| Branch Manager | manager@example.com |
| Property Specialist | specialist@example.com |
| Receptionist | receptionist@example.com |
| Property Owner | owner@example.com |
| Client | client@example.com |

## If something goes wrong

| Problem | Fix |
|---|---|
| `'php' is not recognized` or `'composer' is not recognized` | You are in a normal terminal. Use **Laragon → Terminal**. |
| `The zip extension and unzip/7z commands are both missing` | Tick `zip` in **Menu → PHP → Extensions** (step 2.3). |
| `curl error 60 ... unable to get local issuer certificate` | Your antivirus is scanning HTTPS traffic. In Avast: **Settings → Protection → Core Shields → Web Shield → untick "Enable HTTPS scanning"**, then run `composer install` again. |
| `SQLSTATE[HY000] [2002]` (connection refused) | MySQL is not running. Click **Start All** in Laragon. |
| `Unknown database 'housing_4_raajje'` | Run the `CREATE DATABASE` command from step 3. |
| Want a clean database again | `php artisan migrate:fresh --seed` wipes it and rebuilds it with the test data. |

## Getting the latest changes

```bash
git pull
composer install
php artisan migrate:fresh --seed
```

Note: `migrate:fresh` deletes everything in the database and rebuilds it.

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
