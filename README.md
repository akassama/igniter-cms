<p align="center">
  <img src="https://i.ibb.co/Pv4XWmxv/Igniter-CMS.jpg" alt="Igniter CMS Logo" width="500">
</p>

# Igniter CMS - A CodeIgniter 4 CMS

Igniter CMS is a light but powerful, versatile Content Management System built on the robust CodeIgniter 4 framework. It offers a comprehensive solution for website management, content creation, and digital presence optimization.

## Features

- User Authentication System

  - Registration and Login
  - Password Recovery
  - Updating Account Details and Password Change

- Admin Panel

  - User and Role Management
  - Activity Logging
  - Backend Module Search
  - Configurations Settings

- Media & File Management

  - File uploads, handling, and media management

- General Enhancements

  - Activity Logging
  - Global Exception Handling
  - Easily Customizable Settings
  - Emailing Service Integration

- **Comprehensive CMS:** Manage various website content, including blogs, pages, categories, navigations etc.
- **File Manager:** Upload and manage files for use in the application.
- **User Management:** Admin panel for managing users and permissions.
- **Settings:** Configure application settings, including account details and password.
- **API:** Fetch-only RESTful API for retrieving CMS data.
- **Themes:** Support for managing and switching between website themes.
- **Customizable:** Easily customize app messages, activity types, and more.
- **AI Powered Content Generation:** Automate and enhance various content-related tasks, includes content creation, content optimization, and content management
- **SEO Tools:** Integrated SEO tools for optimizing your website's search engine visibility, including sitemap generation, meta tag management, and analytics integration.
- **AI Powered Reporting & Analytics:** Detailed insights into website performance, user behavior and metrics through integrated reporting tools.

## Example Sites

Here are some websites built with Igniter CMS:

<table>
  <tr>
    <td align="center">
      <strong>AK Tools</strong><br>
      <a href="https://aktools.net/" target="_blank">
        <img src="https://i.ibb.co/XHjZ5X7/ak-tools-home.png" alt="AK Tools Preview" width="250">
      </a><br>
      A suite of web utilities built on the Igniter CMS framework.
    </td>
    <td align="center">
      <strong>GamsecureTech</strong><br>
      <a href="https://gamsecuretech.com/" target="_blank">
        <img src="https://i.ibb.co/zhFQXnsq/gamsecuretech-home.png" alt="GamsecureTech Preview" width="250">
      </a><br>
       GamSecureTech - IT consultancy website
    </td>
    <td align="center">
      <strong>AK Portfolio Site</strong><br>
      <a href="https://abdouliekassama.com/" target="_blank">
        <img src="https://i.ibb.co/93rdpSZL/akassama-home.png" alt="Portfolio Site Preview" width="250">
      </a><br>
      A creative portfolio showcasing projects and resume.
    </td>
  </tr>
</table>

## Getting Started

1. **Requirements:**

   - PHP 8.0 or higher
   - Composer
   - MySQL (or other supported database)
   - Web server (Apache, Nginx, etc.)
   - Enable `zip` and `gd` extension in php ini

2. **Steps:**

   - Clone the repository: `git clone https://github.com/akassama/igniter-cms` (Replace with your actual repo URL)
   - Navigate to the project folder: `cd igniter-cms`
   - Install dependencies: `composer install`
   - Configure Database Connection:
     - The database configuration is managed via a `.env` file. If you don't have one, create a `.env` file in the root directory of your project.
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
     - Also edit the database configuration in `app/Config/Database.php`:
     ```
     public array $default = [
         'DSN'     => '',
         'hostname' => ENVIRONMENT === 'production' ? 'prod_hostname' : 'localhost',
         'username' => ENVIRONMENT === 'production' ? 'prod_db_username' : 'root',
         'password' => ENVIRONMENT === 'production' ? 'prod_db_password' : '',
         'database' => ENVIRONMENT === 'production' ? 'prod_db' : 'igniter_db',
         'DBDriver' => 'MySQLi',
         // other settings
     ];
     ```
     Make sure to update the `hostname`, `username`, `password`, and `database` fields with your database connection details.
   - Create the Database: Using your database management system (e.g., PhpMyAdmin), create a new database with the same name specified in `Database.php`.
   - Set Up Base URL: Edit the configuration file located in `app/Config/App.php`:
   - Run migrations: `php spark migrate`. This command will execute all available migrations, creating the necessary database tables.
   - Delete Tables: if you want to clear all tables from the database, run the command `php spark delete:tables` and type `yes`.
   - Start the Application
     Ensure that your local server (e.g., Apache, Nginx) is running, then navigate to the base URL you set earlier:

   ```
   https://localhost/igniter-cms
   ```

   - Default Admin Login

     You can log in using the default Admin credentials:

     - Email: admin@example.com
     - Password: Admin@1

     To modify the default Admin login, go to the migration file located at `app/Database/Migrations/2024-08-27-210112_Users.php` and update the `$data[]` array accordingly.

3. **Permissions:** Ensure `writable` and `public/uploads` directories are writable by the web server.

4. **Email Configuration:** To enable email functionality, you need to configure your `EmailConfigType` in configurations (`account/admin/configurations`):

**[🔗 Live Demo](https://demo.ignitercms.com/)** | [Documentation](https://docs.ignitercms.com/)

## Sponsor

If you find this project helpful, consider buying me a coffee:

<a href="https://www.buymeacoffee.com/akassama">
  <img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" width="160">
</a>

### License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

### Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request.
