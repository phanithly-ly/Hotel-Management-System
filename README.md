# Hotel Management System

A Laravel web application for managing hotel room types and rooms, with a live
dashboard, English/Khmer language switch and light/dark mode.

## Features

- **Room Types**: create, edit, delete, search, sort and filter by capacity
- **Rooms**: create, edit, delete, search, sort and filter by room type and status
- **Dashboard**: room statistics, occupancy rate, room map by floor, estimated revenue
- **Authentication**: register, login, logout, update profile, change password, delete account
- **Profile photo** upload
- **Languages**: English and Khmer (Kantumruy Pro font); room types are translated to Khmer automatically when saved
- **Light / dark mode** on every page

## Requirements

- PHP 8.3 or higher
- Composer
- Node.js and npm
- MySQL (Laragon is recommended on Windows)
- Internet connection (needed to auto-translate room types to Khmer)

## Installation

### 1. Download and install dependencies

```bash
git clone https://github.com/phanithly-ly/Hotel-Management-System.git
cd Hotel-Management-System
composer install
npm install
```

### 2. Create the environment file

```bash
copy .env.example .env
php artisan key:generate
```

On macOS or Linux, use `cp .env.example .env` instead of `copy`.

### 3. Create the database

Create an empty MySQL database named `hotel-management-system`.

In Laragon: click **Database** to open HeidiSQL, right-click the connection,
choose **Create new > Database**, and enter `hotel-management-system`.

Or run this SQL (the backticks are required because the name contains hyphens):

```sql
CREATE DATABASE `hotel-management-system`;
```

### 4. Configure `.env`

Open `.env` and make sure these lines are set (the defaults below work with a
standard Laragon installation):

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel-management-system
DB_USERNAME=root
DB_PASSWORD=
```

If your MySQL root user has a password, put it in `DB_PASSWORD`.

### 5. Run the application

```bash
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

Open http://localhost:8000 and register a new account.

## Usage

1. Register or log in.
2. Add at least one Room Type (name, price per night, capacity).
3. Add Rooms and assign each one to a Room Type, floor and status
   (Available, Occupied or Maintenance).
4. Open the Dashboard to see statistics and the room map.
5. Use the EN / ខ្មែរ switch and the sun/moon button in the navigation bar to change
   language and theme.

## Troubleshooting

| Problem | Solution |
|---|---|
| `Unknown database 'hotel-management-system'` | Create the database (step 3) and check `DB_DATABASE` in `.env` |
| `Access denied for user` | Check `DB_USERNAME` and `DB_PASSWORD` in `.env` |
| Page has no styling | Run `npm run build` |
| Profile photo not showing | Run `php artisan storage:link` |
| Old settings still used | Run `php artisan optimize:clear` |
| Room type has no Khmer translation | Check your internet connection, then edit and save the room type again |

## Tech Stack

Laravel, Blade, Tailwind CSS, Alpine.js, Vite, MySQL

## Author

GitHub: [phanithly-ly](https://github.com/phanithly-ly)