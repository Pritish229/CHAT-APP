# Laravel 10 + Botman Project

## Requirements
- PHP 8.1 or higher
- Composer
- Laravel 10
- MySQL or compatible database

## Installation Steps

1. **Clone the Repository**
   ```sh
   git clone <repository_url>
   cd <project_directory>
   ```

2. **Install Dependencies**
   ```sh
   composer install
   ```

3. **Set Up Environment**
   - Copy `.env.example` to `.env`
   ```sh
   cp .env.example .env
   ```
   - Update database credentials in the `.env` file:
     ```env
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

4. **Generate Application Key**
   ```sh
   php artisan key:generate
   ```

5. **Run Migrations**
   ```sh
   php artisan migrate
   ```

6. **Import Additional SQL File**
   ```sh
   mysql -u your_database_user -p your_database_name < database/seeders/SQL/statesistrict.sql
   ```

7. **Run Seeders**
   ```sh
   php artisan db:seed --class=AdminSeeder
   ```

8. **Serve the Application**
   ```sh
   php artisan serve
   ```
   - The application will be accessible at `http://127.0.0.1:8000`

## Additional Notes
- Ensure your database is running before running migrations and seeders.
- Botman should be correctly configured as per the project requirements.
- If needed, configure the queue system for background processing.

---
Your Laravel 10 project with Botman should now be running successfully! 🎉

