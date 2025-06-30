<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;
use CodeIgniter\Commands\Database\Migrate;

class RecreateTables extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'recreate:tables';
    protected $description = 'Deletes all tables from the database and re-runs all migrations. Also clears specific cached asset files.';

    public function run(array $params)
    {
        // Connect to the database and get forge
        $db = Database::connect();
        $forge = Database::forge();

        // Fetch all existing tables
        $tables = $db->listTables();

        if (empty($tables)) {
            CLI::write('No tables found. Proceeding to run migrations...', 'yellow');
        } else {
            // Confirm user intention
            $confirm = CLI::prompt('This will DELETE ALL tables and run all migrations. Type "yes" to confirm', '', 'required');
            if (strtolower($confirm) !== 'yes') {
                CLI::write('Operation cancelled.', 'red');
                return;
            }

            CLI::write('Deleting all tables...', 'red');
            foreach ($tables as $table) {
                try {
                    $forge->dropTable($table, true);
                    CLI::write("Dropped: {$table}", 'green');
                } catch (\Exception $e) {
                    CLI::error("Failed to drop {$table}: " . $e->getMessage());
                }
            }
        }

        // Delete cached CSS and JS files
        $this->clearCacheFiles();

        // Now run all migrations
        CLI::write('Running all migrations...', 'blue');

        // Simulate calling `php spark migrate`
        $runner = new \CodeIgniter\Commands\Database\Migrate($this->logger, $this->commands);
        $runner->run([]);
    }

    /**
     * Deletes all CSS and JS cache files from specific directories.
     */
    protected function clearCacheFiles()
    {
        $directories = [
            FCPATH . 'cache/assets/css/',
            FCPATH . 'cache/assets/js/',
        ];

        foreach ($directories as $dir) {
            CLI::write("Looking in: {$dir}", 'yellow'); // Debug log

            if (!is_dir($dir)) {
                CLI::write("Directory not found: $dir", 'red');
                continue;
            }

            $files = glob($dir . '*.{css,js}', GLOB_BRACE);
            if (empty($files)) {
                CLI::write("No cache files found in: $dir", 'yellow');
                continue;
            }

            foreach ($files as $file) {
                if (is_file($file)) {
                    try {
                        unlink($file);
                        CLI::write("Deleted cache file: " . basename($file), 'cyan');
                    } catch (\Exception $e) {
                        CLI::error("Failed to delete file {$file}: " . $e->getMessage());
                    }
                }
            }
        }

        CLI::write('Cache cleared.', 'green');
    }

}
