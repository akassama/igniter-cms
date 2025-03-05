<p align="center">
  <img src="https://i.ibb.co/Pv4XWmxv/Igniter-CMS.jpg" alt="Igniter CMS Logo" width="500">
</p>

# CodeIgniter 4 CMS
Igniter CMS is a light but powerful, versatile Content Management System built on the robust CodeIgniter 4 framework. It offers a comprehensive solution for website management, content creation, and digital presence optimization.


## Features
* User Authentication System
    * Registration and Login
    * Password Recovery
    * Updating Account Details and Password Change

* Admin Panel
    * User and Role Management
    * Activity Logging
    * Backend Module Search
    * Configurations Settings

* Media & File Management
    * File uploads, handling, and media management

* General Enhancements
    * Activity Logging
    * Global Exception Handling
    * Easily Customizable Settings
    * Emailing Service Integration
    * **PHP Zip Extension:** Ensure the PHP zip extension is enabled. In your `php.ini` file, uncomment the line `extension=zip` (or `extension=php_zip.dll` on Windows) and restart your web server.

* **Comprehensive CMS:**  Manage various website content, including blogs, pages, categories, navigations, events, portfolios, services, partners, counters, social links, pricings, teams, testimonials, FAQs, donation causes, popups, and policies.
* **E-commerce Module:** Basic e-commerce functionality with product and category management.
* **Resume Module:** Manage resumes, experiences, education, and skills.
* **File Manager:** Upload and manage files for use in the application.
* **User Management:**  Admin panel for managing users and permissions.
* **Settings:** Configure application settings, including account details and password.
* **API:** Fetch-only RESTful API for retrieving CMS data.
* **Themes:**  Support for managing and switching between website themes.
* **Translations:** Manage Google translations for different languages.
* **Data Backup:** Export database and project assets.
* **Customizable:**  Easily customize app messages, activity types, and more.

## Getting Started
1. **Requirements:**
    * PHP 8.0 or higher
    * Composer
    * MySQL (or other supported database)
    * Web server (Apache, Nginx, etc.)

2. **Steps:**
    * Clone the repository: `git clone https://github.com/akassama/igniter-cms` (Replace with your actual repo URL)
    * Navigate to the project folder: `cd igniter-cms`
    * Install dependencies: `composer install`
    * **Configure Database Connection:**
        * The database configuration is managed via a `.env` file. If you don't have one, create a `.env` file in the root directory of your project.
        * Add the following database configuration settings to your `.env` file, replacing the placeholder values with your actual database credentials:
        ```
        database.default.hostname = localhost
        database.default.database = igniter_db
        database.default.username = root
        database.default.password = 
        database.default.DBDriver = MySQLi
        database.default.DBPrefix = 
        database.default.port = 3306
        ```
        * Alternatively, you can directly edit the database configuration in `app/Config/Database.php`:
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
    * Create the Database: Using your database management system (e.g., PhpMyAdmin), create a new database with the same name specified in `Database.php`.
    * Set Up Base URL: Edit the configuration file located in `app/Config/App.php`
    * Make sure to have the environment variable `CI_ENVIRONMENT = development` in the .env file. 
    * Run migrations: `php spark migrate`. This command will execute all available migrations, creating the necessary database tables.
    * Start the Application
      Ensure that your local server (e.g., Apache, Nginx) is running, then navigate to the base URL you set earlier:
    ```
    https://localhost/igniter-cms
    ```
    * Default Admin Login

        You can log in using the default Admin credentials:
        * Email: admin@example.com
        * Password: Admin@1
      
        To modify the default Admin login, go to the migration file located at `app/Database/Migrations/2024-08-27-210112_Users.php` and update the `$data[]` array accordingly.
3. **Permissions:** Ensure `writable` and `public/uploads` directories are writable by the web server.

4. **Email Configuration:** To enable email functionality, you need to configure your Mailjet settings in `/account/admin/configurations` page:
    ```
    MailjetApiKey = 'your-mailjet-api-key';
    MailjetApiSecret = 'your-mailjet-api-secret';
    ```

## How to Customize System Features?
### Customizing Notification Messages
To customize system messages:
* Edit `app/Config/CustomConfig.php` to modify existing messages or add new ones.

### Customizing Activity Logging
To update activity log types:
* See  `app/Constants/ActivityTypes.php`
* Update the value or add new constants, for example
```
const PUSH_NOTIFICATION = 'push_notification';
```

* Add the description in the function
```
public static function getDescription($type)
{
    $descriptions = [
        self::PUSH_NOTIFICATION => 'Push Notification Sent',
        // Add more descriptions as needed
    ];

    return $descriptions[$type] ?? 'Unknown Activity';
}
```

## Usage Examples in Controllers
To see how configurations are used, review the code in AdminController or other controllers located in the `app/Controllers` directory.

### Helper Functions
There is a global helper with several functions available to ease the development process:
* Global Functions Helpers: `app/Helpers/global_functions_helper.php`

### Usage
Refer to the detailed documentation for information on using the application's features, API endpoints, and development guidelines.  The documentation is available here: [Igniter CMS Documentation](https://igniter-cms.aktools.net/docs)

### API
The application includes a fetch-only RESTful API.  Refer to the documentation for available endpoints and usage instructions.  API keys may be required for authentication.

### File Upload System
The application has a built-in file upload system for handling various types of files:
* Supported Types: Docs (`.doc, .docx, .pdf, .txt, .rtf, .odt.`), Images (`jpg, png, gif, jpeg`), Audios (`.mp3, .wav, .ogg`) and Videos (`.mp4, .avi, .mov.`)
* Maximum File Size: 5MB. You can modify this value in `Configurations (MaxUploadFileSize)` 
* Validation and configuration can be updated in the relevant controller handling file uploads.

### Other Features Summary

* User & Admin Module: Management for different user roles and actions.
* Search Module: Backend search capabilities to easily navigate records.
* Global Exception Handling: Handle application-wide exceptions gracefully.
* Easily Customizable: The application structure is modular to facilitate easy updates and modifications.

### License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

### Contributing
If you would like to contribute to this project, please fork the repository and submit a pull request.