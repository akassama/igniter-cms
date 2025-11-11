# Igniter CMS

![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)

Igniter CMS is a light but powerful open source Content Management System built on the robust [CodeIgniter 4](http://codeigniter.com/) framework. It offers a comprehensive solution for website management, content creation, and digital presence optimization.

![Screen](https://assets.aktools.net/image-stocks/igniter-cms/dashboard.png "Dashboard")

## Documentation

Visit [Documentation](https://docs.ignitercms.com/) section in the website

## System Requirements & Installation

1. **Requirements:**

   - PHP 8.0 or higher
   - Composer
   - MySQL (or other supported database)
   - Web server (Apache, Nginx, etc.)
   - Enable `zip`, `intl` and `gd` extension in php ini

2. **Steps:**

   - Clone the repository: `git clone https://github.com/akassama/igniter-cms`
   - Navigate to the project folder: `cd igniter-cms`
   - Install dependencies: `composer install`
   - Configure Database Connection:

     - The database configuration is managed via a `.env` file. If you don't have one, make a copy of the `env` file in the root directory of your project and rename it `.env`.
     - Add the following database configuration settings to your `.env` file, replacing the placeholder values with your actual database credentials:

     ```
     database.default.hostname = localhost
     database.default.database = igniter_db
     database.default.username = root
     database.default.password =
     database.default.DBDriver = MySQLi
     database.default.DBPrefix =
     database.default.port = 3306
     ```

     Make sure to update the `hostname`, `username`, `password`, and `database` fields with your database connection details.

   - Create the Database: Using your database management system (e.g., PhpMyAdmin), create a new database with the same name specified in `.env`.
   - Set Up Base URL: Set your base URL in the `.env` file. `app_baseURL = 'http://localhost/apps/igniter-cms/'`
   - Run migrations: `php spark recreate:tables` and type `yes`.. This command will execute all available migrations, creating the necessary database tables.
   - Start the Application
     Ensure that your local server (e.g., Apache, Nginx) is running, then navigate to the base URL you set earlier, E.g. `https://localhost/igniter-cms`

   - Default Admin Login

     You can log in using the default Admin credentials:

     - Email: admin@example.com
     - Password: Admin@1

     To modify the default Admin login, go to the migration file located at `app/Database/Migrations/2024-08-27-210112_Users.php` and update the `$data[]` array accordingly.

3. **Permissions:** Ensure `writable` and `public/uploads` directories are writable by the web server.

4. **Email Configuration:** To enable email functionality, you need to configure your SMTP in `.env`

## Demo

Content Management System [https://demo.ignitercms.com](https://demo.ignitercms.com)

Themes [https://themes.ignitercms.com](https://themes.ignitercms.com)

## Support

If you find this project helpful, consider buying me a coffee:

<a href="https://www.buymeacoffee.com/akassama">
  <img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" width="160">
</a>

## License

The Lavalite CMS is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
