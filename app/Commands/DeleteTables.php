<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class DeleteTables extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'delete:tables';
    protected $description = 'Deletes all tables from the connected database.';

    public function run(array $params)
    {
        // Get the database forge instance
        $db = Database::connect();
        $forge = Database::forge();

        // Fetch all the tables from the database
        $tables = $db->listTables();

        if (empty($tables)) {
            CLI::write('No tables found in the database.', 'yellow');
            return;
        }

        // Ask for confirmation
        $confirm = CLI::prompt('Are you sure you want to delete ALL tables? Type "yes" to confirm', '', 'required');

        if (strtolower($confirm) !== 'yes') {
            CLI::write('Operation canceled.', 'red');
            return;
        }

        CLI::write('Deleting all tables from the database...', 'red');

        // Loop through each table and drop it
        foreach ($tables as $table) {
            try {
                $forge->dropTable($table, true); // The second argument "true" forces the drop
                CLI::write("Dropped table: {$table}", 'green');
            } catch (\Exception $e) {
                CLI::write("Failed to drop table: {$table}. Error: " . $e->getMessage(), 'red');
            }
        }

        // Delete cached CSS and JS files
        $this->clearCacheFiles();

        CLI::write('All tables have been deleted.', 'green');
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
