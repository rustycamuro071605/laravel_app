# Laravel Laboratory Assignment

A complete Laravel application featuring authentication, database seeding, and a futuristic dashboard interface.

## Setup Instructions

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and npm
- SQLite (or MySQL/PostgreSQL)

### Installation Steps

1. **Clone or navigate to the project directory:**
   ```bash
   cd laravel_app
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Copy the environment file and configure:**
   ```bash
   cp .env.example .env
   ```
   
   Or verify the `.env` file has the correct database settings:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=C:\path\to\your\laravel_app\database\database.sqlite
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

6. **Build frontend assets:**
   ```bash
   npm run build
   ```

7. **Run database migrations and seed:**
   ```bash
   php artisan migrate --force
   php artisan db:seed
   ```

8. **Start the development server:**
   ```bash
   php artisan serve
   ```

9. **Open your browser and navigate to:**
   ```
   http://127.0.0.1:8000
   ```

## Sample Login Credentials

The application comes with 100 seeded users, including 5 users with known credentials:

### Primary Test Accounts:

| Username   | Password      | Email |
|------------|---------------|-------|
| testuser1  | password123   | testuser1@example.com |
| testuser2  | password123   | testuser2@example.com |
| testuser3  | password123   | testuser3@example.com |
| testuser4  | password123   | testuser4@example.com |
| testuser5  | password123   | testuser5@example.com |

## Features

- **Authentication System**: Complete login/register functionality
- **Database Seeding**: 100 users with realistic dummy data
- **Futuristic UI**: Dark theme with neon green accents
- **Responsive Design**: Works on desktop and mobile devices
- **Protected Dashboard**: Secure access after authentication
- **Profile Management**: Edit account information and security settings

## Application Structure

- **Welcome Page**: `/` - Public landing page with futuristic design
- **Login Page**: `/login` - Secure login with username/email support
- **Registration Page**: `/register` - User registration with validation
- **Dashboard**: `/dashboard` - Protected area after login
- **Profile**: `/profile` - Account management page

## Additional Commands

- **Clear caches**: `php artisan cache:clear` and `php artisan route:clear`
- **Re-seed database**: `php artisan db:seed --class=UserSeeder`
- **View all routes**: `php artisan route:list`

## Troubleshooting

- If you encounter issues with the database, try running `php artisan migrate:fresh --seed`
- For asset loading issues, run `npm run build` again
- Make sure the `storage` and `bootstrap/cache` directories are writable