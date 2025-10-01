<?php

try {
    /*
     *---------------------------------------------------------------
     * CHECK IF INSTALLED
     *---------------------------------------------------------------
     */
    // Check if .env and /install/index.php exist
    if (!file_exists(__DIR__ . '/.env') && file_exists(__DIR__ . '/install/index.php')) {
        header("Location: install/");
        exit;
    }

    /*
     *---------------------------------------------------------------
     * CHECK PHP VERSION
     *---------------------------------------------------------------
     */
    $minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
    if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
        $message = sprintf(
            'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
            $minPhpVersion,
            PHP_VERSION,
        );

        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo $message;
        exit(1);
    }

    /*
     *---------------------------------------------------------------
     * SET THE CURRENT DIRECTORY
     *---------------------------------------------------------------
     */
    // Path to the front controller (this file)
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

    // Ensure the current directory is pointing to the front controller's directory
    if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
        chdir(FCPATH);
    }

    /*
     *---------------------------------------------------------------
     * BOOTSTRAP THE APPLICATION
     *---------------------------------------------------------------
     * This process sets up the path constants, loads and registers
     * our autoloader, along with Composer's, loads our constants
     * and fires up an environment-specific bootstrapping.
     */

    // LOAD OUR PATHS CONFIG FILE
    // This is the line that might need to be changed, depending on your folder structure.
    require FCPATH . 'app/Config/Paths.php';
    // ^^^ Change this line if you move your application folder

    $paths = new Config\Paths();

    // LOAD THE FRAMEWORK BOOTSTRAP FILE
    require $paths->systemDirectory . '/Boot.php';

    exit(CodeIgniter\Boot::bootWeb($paths));
} catch (\Throwable $e) {
    // Friendly message and basic error info for user and admin
    header('HTTP/1.1 500 Internal Server Error', true, 500);
    echo '<h1>Application Error</h1>';
    echo '<p>An unexpected error occurred: ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p>Please make sure you have completed the installation by running the <strong>/install</strong> setup routine.</p>';
    echo '<pre>' . htmlspecialchars($e) . '</pre>'; // Optionally display stack trace during development
    exit(1);
}
